# SQLite a PostgreSQL

Esta guia esta adaptada al estado real de este proyecto en `2026-04-24`.

## Estado actual del proyecto

- La aplicacion usa `DB_CONNECTION=sqlite` en `.env`.
- La base activa es `database/database.sqlite`.
- Las migraciones versionadas son:
  - `2024_01_01_000001_create_properties_table.php`
  - `2024_01_01_000002_create_contact_inquiries_table.php`
  - `2024_01_01_000003_create_newsletter_subscribers_table.php`
  - `2026_03_26_072054_create_cache_table.php`
- El esquema real de SQLite tiene una columna extra no versionada:
  - `properties.airbnb_url`
- Ya se ha creado una migracion nueva para cubrir ese desajuste:
  - `2026_04_24_094500_add_airbnb_url_to_properties_table.php`

## Hallazgo importante antes de migrar

En este repo no existe `config/database.php`, pero si existe `bootstrap/cache/config.php`.

Eso significa que ahora mismo Laravel esta funcionando con configuracion cacheada. Antes de una migracion seria a PostgreSQL conviene:

1. Recuperar la carpeta `config/` desde una instalacion limpia de Laravel 11 del mismo proyecto.
2. Versionarla en git.
3. Verificar especialmente `config/database.php`, `config/cache.php`, `config/queue.php` y `config/mail.php`.
4. Solo despues ejecutar `php artisan optimize:clear`.

Mientras no recuperes `config/`, no limpies la cache de configuracion a ciegas en produccion.

## Paso 1: sincronizar primero SQLite con el codigo

Antes de pensar en PostgreSQL, deja el esquema actual bien versionado:

```bash
php artisan migrate
```

Con esto quedara aplicada la migracion de `airbnb_url` en cualquier entorno SQLite que no la tenga.

## Paso 2: preparar PostgreSQL

Necesitas una base de datos PostgreSQL accesible desde el servidor donde corre Laravel.

Ejemplo de creacion:

```sql
CREATE ROLE casadeinobili_user WITH LOGIN PASSWORD 'cambia_esta_password';
CREATE DATABASE casadeinobili OWNER casadeinobili_user;
GRANT ALL PRIVILEGES ON DATABASE casadeinobili TO casadeinobili_user;
```

Si usas un proveedor gestionado, normalmente te dara:

- `host`
- `port`
- `database`
- `username`
- `password`
- a veces `sslmode=require`

## Paso 3: comprobar soporte PHP para PostgreSQL

En la maquina donde vayas a ejecutar Laravel:

```bash
php -m | grep pgsql
```

Deberias ver algo como:

- `pdo_pgsql`
- `pgsql`

Si no aparece, instala la extension de PostgreSQL para tu version de PHP antes de seguir.

## Paso 4: configurar `.env` para PostgreSQL

Sustituye la configuracion SQLite por esta:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=casadeinobili
DB_USERNAME=casadeinobili_user
DB_PASSWORD=tu_password_segura
```

Si el proveedor te exige SSL, anade tambien:

```env
DB_SSLMODE=require
```

Nota: en la configuracion cacheada actual ya existe una conexion `pgsql` con estos defaults:

- host `127.0.0.1`
- port `5432`
- search_path `public`
- sslmode `prefer`

## Paso 5: prueba local o staging antes de tocar produccion

Haz primero una prueba en una base PostgreSQL vacia:

```bash
php artisan migrate:fresh --seed
```

Objetivo de esta prueba:

- verificar que las migraciones corren en PostgreSQL,
- confirmar que no dependes de cosas especificas de SQLite,
- comprobar que los seeders siguen funcionando.

## Paso 6: migrar los datos actuales de SQLite a PostgreSQL

Como este proyecto tiene pocas tablas de negocio, la forma mas segura es mover solo estas:

- `properties`
- `contact_inquiries`
- `newsletter_subscribers`

No migres:

- `cache`
- `cache_locks`
- `migrations`

La forma recomendada es:

1. Hacer backup del archivo SQLite:

```bash
cp database/database.sqlite database/database.sqlite.backup
```

2. Levantar PostgreSQL vacio con las migraciones:

```bash
php artisan migrate
```

3. Exportar desde SQLite a CSV:

```bash
sqlite3 -header -csv database/database.sqlite "select id,name,slug,century,tagline,description,long_description,guests,bedrooms,bathrooms,image_url,airbnb_url,gallery_images,amenities,location,is_published,is_coming_soon,sort_order,created_at,updated_at from properties order by id;" > /tmp/properties.csv

sqlite3 -header -csv database/database.sqlite "select id,name,email,phone,property_id,arrival_date,departure_date,guests,message,inquiry_type,status,ip_address,notes,created_at,updated_at from contact_inquiries order by id;" > /tmp/contact_inquiries.csv

sqlite3 -header -csv database/database.sqlite "select id,email,is_active,subscribed_at,unsubscribed_at,created_at,updated_at from newsletter_subscribers order by id;" > /tmp/newsletter_subscribers.csv
```

4. Importar en PostgreSQL:

```bash
psql -h 127.0.0.1 -U casadeinobili_user -d casadeinobili -c "\\copy properties(id,name,slug,century,tagline,description,long_description,guests,bedrooms,bathrooms,image_url,airbnb_url,gallery_images,amenities,location,is_published,is_coming_soon,sort_order,created_at,updated_at) FROM '/tmp/properties.csv' CSV HEADER"

psql -h 127.0.0.1 -U casadeinobili_user -d casadeinobili -c "\\copy contact_inquiries(id,name,email,phone,property_id,arrival_date,departure_date,guests,message,inquiry_type,status,ip_address,notes,created_at,updated_at) FROM '/tmp/contact_inquiries.csv' CSV HEADER"

psql -h 127.0.0.1 -U casadeinobili_user -d casadeinobili -c "\\copy newsletter_subscribers(id,email,is_active,subscribed_at,unsubscribed_at,created_at,updated_at) FROM '/tmp/newsletter_subscribers.csv' CSV HEADER"
```

5. Ajustar secuencias de PostgreSQL para que el siguiente `id` no choque:

```sql
SELECT setval('properties_id_seq', COALESCE((SELECT MAX(id) FROM properties), 1), true);
SELECT setval('contact_inquiries_id_seq', COALESCE((SELECT MAX(id) FROM contact_inquiries), 1), true);
SELECT setval('newsletter_subscribers_id_seq', COALESCE((SELECT MAX(id) FROM newsletter_subscribers), 1), true);
```

## Paso 7: validacion funcional

Despues de importar:

1. Abre la home y el listado de propiedades.
2. Abre una ficha de propiedad.
3. Envia un formulario de contacto.
4. Revisa que el alta de newsletter siga funcionando.
5. Comprueba que las consultas a `properties.airbnb_url` no fallen.

## Paso 8: despliegue en produccion

Orden recomendado:

1. Backup de la base SQLite actual.
2. Confirmar que el codigo con la migracion `airbnb_url` esta desplegado.
3. Configurar variables PostgreSQL en el entorno.
4. Ejecutar migraciones en PostgreSQL.
5. Importar datos.
6. Cambiar la app a `DB_CONNECTION=pgsql`.
7. Reiniciar PHP-FPM o el proceso de la app.
8. Probar formularios, detalle de propiedades y admin.

## Pool de conexiones

Puedes arrancar sin pool si el trafico es bajo o medio.

Cuando quieras endurecer produccion, anade `PgBouncer`.

Escenario recomendado:

- PostgreSQL como base principal
- `PgBouncer` delante para pool de conexiones
- Laravel apuntando a `PgBouncer` en vez de abrir conexiones directas a PostgreSQL

## Evaluacion de facilidad en este proyecto

El cambio a PostgreSQL aqui es razonablemente sencillo porque:

- solo hay 3 tablas de negocio,
- el esquema es pequeno,
- no hay procedimientos complejos ni triggers,
- los campos JSON de Laravel (`gallery_images`, `amenities`) encajan bien en PostgreSQL.

Los dos riesgos reales ahora mismo son:

1. Tienes cambios manuales en SQLite fuera de migraciones.
   Ya se ha detectado y cubierto `properties.airbnb_url`.

2. Falta la carpeta `config/` en el repo.
   Antes de una migracion seria, conviene restaurarla para no depender de `bootstrap/cache/config.php`.
