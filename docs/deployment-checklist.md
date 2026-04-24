# Deployment Checklist

## 1. Preparar el servidor

- Subir el proyecto completo, incluida la carpeta `config/`.
- No subir tu `.env` local tal cual.
- Crear un `.env` propio en el servidor tomando como base `.env.production.example`.
- Revisar permisos de:
  - `storage/`
  - `bootstrap/cache/`
  - si sigues con SQLite, tambien `database/database.sqlite`

## 2. Rellenar `.env` de produccion

Minimo:

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=https://tu-dominio`
- `DB_*` reales del servidor
- `MAIL_*` reales
- `CONTACT_INQUIRIES_KEY`
- `ADMIN_TOOLS_KEY`
- `ADMIN_EMAIL`

## 3. Instalar dependencias

Si el servidor permite Composer:

```bash
composer install --no-dev --optimize-autoloader
```

## 4. Preparar Laravel

Si puedes usar shell:

```bash
php artisan migrate --force
php artisan config:cache
php artisan view:cache
```

Si no puedes usar shell:

- entra en `/admin/system-tools`
- ejecuta:
  - `Run Migrations`
  - `Config Cache`
  - `View Cache`

## 5. Verificaciones despues del despliegue

- Abrir la home
- Abrir `/about`
- Abrir una ficha de propiedad
- Probar el formulario de contacto
- Revisar `/admin/contact-inquiries`
- Revisar `/admin/system-tools`

## 6. Si algo falla

Orden de rescate recomendado:

1. `Optimize Clear`
2. `Config Clear`
3. `View Clear`
4. volver a `Config Cache`
5. volver a `View Cache`

## 7. Notas importantes

- No expongas scripts sueltos tipo `public/info.php` o `public/fixdb.php` en produccion.
- Usa el panel `/admin/system-tools` en su lugar.
- No copies nunca tu `.env` local al servidor.
- Cambiar el `.env` en produccion requiere volver a ejecutar `config:cache`.
