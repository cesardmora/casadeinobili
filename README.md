# Case dei Nobili — Laravel Website

Luxury heritage rental website for Case dei Nobili — four historic residences on the island of Korčula, Croatia.

---

## 🏛️ Features

- Responsive landing page with scroll animations, hover zoom effects, and smooth transitions
- Database-backed properties (SQLite default, MySQL ready)
- Contact form with validation, DB storage, and email notifications
- Newsletter subscription with AJAX
- Property detail pages with gallery and amenities
- About, Privacy Policy, and Terms pages
- Custom 403, 404, 500 error pages
- SEO: Open Graph, Twitter Cards, JSON-LD structured data, canonical URLs, sitemap.xml
- English language (primary)

---

## 📋 Requirements

| Tool | Version |
|------|---------|
| PHP | 8.2+ |
| Composer | latest |
| Node.js | 18+ |
| npm | 9+ |

---

## 🚀 Quick Start

### 1. Clone the repository

```bash
git clone <YOUR_REPO_URL> casadeinobili
cd casadeinobili
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install Node dependencies

```bash
npm install
```

### 4. Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Set up the database

**Option A — SQLite (easiest, recommended for development):**

```bash
touch database/database.sqlite
```

Make sure `.env` has `DB_CONNECTION=sqlite`.

**Option B — MySQL:**

Edit `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=casadeinobili
DB_USERNAME=root
DB_PASSWORD=your_password
```

Then create the database:

```sql
CREATE DATABASE casadeinobili CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 6. Run migrations + seeders

```bash
php artisan migrate --seed
```

This creates all tables and inserts the 4 properties.

### 7. Compile Tailwind CSS

```bash
npm run build
```

> **During development**, use `npm run dev` instead — it watches for changes and rebuilds automatically.

### 8. Start the development server

```bash
php artisan serve
```

Visit **http://localhost:8000**

---

## 📁 Project Structure

```
casadeinobili/
├── app/
│   ├── Http/
│   │   ├── Controllers/          # HomeController, PropertyController, etc.
│   │   └── Requests/             # Form request validation
│   ├── Mail/                     # Email notifications
│   └── Models/                   # Property, ContactInquiry, etc.
├── database/
│   ├── migrations/               # Database schema
│   └── seeders/                  # PropertySeeder (4 properties)
├── public/
│   ├── css/
│   │   ├── app.css               # Custom styles (variables, animations, etc.)
│   │   └── tailwind.css          # Compiled Tailwind (DO NOT edit directly)
│   ├── js/app.js                 # Frontend JavaScript
│   ├── images/                   # Site images
│   ├── robots.txt
│   └── index.php
├── resources/
│   ├── css/app.css               # Tailwind source (ONLY @tailwind directives)
│   └── views/
│       ├── layouts/app.blade.php # Main layout (head, meta, scripts)
│       ├── components/           # Reusable: navigation, footer, cards, forms
│       ├── pages/                # home, about, properties, legal pages
│       └── errors/               # 403, 404, 500 custom error pages
├── routes/
│   ├── web.php                   # All web routes
│   └── console.php               # Scheduled commands
├── tailwind.config.js            # Tailwind configuration
├── postcss.config.js             # PostCSS plugins
├── package.json                  # Node dependencies + scripts
├── composer.json                 # PHP dependencies
└── .env.example                  # Environment template
```

---

## 🌐 Routes

| Method | URL | Description |
|--------|-----|-------------|
| `GET` | `/` | Home / landing page |
| `GET` | `/about` | About page |
| `GET` | `/properties` | Property listing |
| `GET` | `/properties/{slug}` | Property detail |
| `POST` | `/contact` | Submit contact form |
| `GET` | `/contact/thanks` | Contact confirmation |
| `POST` | `/newsletter` | Subscribe to newsletter |
| `GET` | `/privacy-policy` | Privacy policy |
| `GET` | `/terms` | Terms & conditions |

---

## 🔧 Development Commands

### CSS / Tailwind

| Command | What it does |
|---------|-------------|
| `npm run dev` | Watch mode — rebuilds `public/css/tailwind.css` on every change |
| `npm run build` | One-time production build (minified) |

> **Never edit `public/css/tailwind.css` directly** — it gets overwritten on every build.  
> Edit `resources/css/app.css` for Tailwind source, or `public/css/app.css` for custom CSS.

### Laravel

| Command | What it does |
|---------|-------------|
| `php artisan serve` | Start local dev server (http://localhost:8000) |
| `php artisan migrate` | Run database migrations |
| `php artisan migrate --seed` | Migrate + insert sample data |
| `php artisan db:seed --class=PropertySeeder` | Re-seed properties only |
| `php artisan tinker` | Interactive PHP console |
| `php artisan cache:clear` | Clear application cache |
| `php artisan view:clear` | Clear compiled views |
| `php artisan route:list` | Show all registered routes |

---

## 🚀 Production Deployment

### 1. Install dependencies (optimized)

```bash
composer install --optimize-autoloader --no-dev
npm install
npm run build
```

### 2. Set up environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` with your production values:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_DATABASE=casadeinobili
DB_USERNAME=your_user
DB_PASSWORD=your_password

MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your_user
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS="info@casadeinobili.com"
```

### 3. Migrate + seed

```bash
php artisan migrate --seed
```

### 4. Cache everything

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 5. Set file permissions

```bash
chmod -R 755 storage bootstrap/cache
```

### 6. Point your web server

Apache: document root → `public/`  
Nginx: root → `public/`, index → `index.php`

---

## 🎨 Customization

### Change property data

Edit `database/seeders/PropertySeeder.php`, then re-run:

```bash
php artisan db:seed --class=PropertySeeder
```

### Change site-wide colors / fonts

Edit `public/css/app.css` — all CSS variables are defined in `:root`.

### Change Tailwind config

Edit `tailwind.config.js` (colors, spacing, etc.), then rebuild:

```bash
npm run build
```

### Change SEO metadata

Each view defines its own `@section('title')`, `@section('meta_description')`, etc.  
Defaults are set in `resources/views/layouts/app.blade.php`.

---

## 📝 License

Proprietary — Case dei Nobili © 2026




✅ Todo listo. Aquí los comandos para subir a GitHub:

Comandos para subir a GitHub
# 1. Ir al directorio del proyecto
cd "/Users/cesar/Documents/Desktop/2026 March/casadeinobili 2"

# 2. Añadir todos los archivos (el .gitignore filtra lo que no debe subir)
git add .

# 3. Primer commit
git commit -m "Initial commit: Case dei Nobili Laravel website"

# 4. Conectar con tu repositorio de GitHub (cambia la URL)
git remote add origin https://github.com/TU_USUARIO/casadeinobili.git

# 5. Subir a GitHub
git push -u origin main
Si main no existe, usa git branch -M main antes del push.

Cuando alguien descarga el proyecto, estos son los pasos:
# 1. Clonar
git clone https://github.com/TU_USUARIO/casadeinobili.git
cd casadeinobili

# 2. Instalar PHP dependencies
composer install

# 3. Instalar Node dependencies
npm install

# 4. Crear .env
cp .env.example .env

# 5. Generar APP_KEY
php artisan key:generate

# 6. Crear SQLite database
touch database/database.sqlite

# 7. Migrar + seed
php artisan migrate --seed

# 8. Compilar Tailwind CSS
npm run build

# 9. Iniciar servidor
php artisan serve
Visita http://localhost:8000

Lo que NO se sube a GitHub (.gitignore):
Ignorado	Razón
.env	Contiene contraseñas y claves secretas
vendor/	Se regenera con composer install
node_modules/	Se regenera con npm install
database/database.sqlite	Se crea con touch + migrate --seed
storage/* (excepto .gitkeep)	Logs, sesiones, caché — efímeros
.copia*, .bak	Archivos de respaldo basura
.qwen/, X_linux/, test.php	Ficheros locales del




Cómo acceder a cada archivo (con clave):
Archivo	URL de acceso
admin.php	https://casadeinobili.wantdsign.com/admin.php?key=Nobili2026Secure!
clear.php	https://casadeinobili.wantdsign.com/clear.php?key=Nobili2026Secure!
fix-db.php	https://casadeinobili.wantdsign.com/fix-db.php?key=Nobili2026Secure!
fixdb.php	https://casadeinobili.wantdsign.com/fixdb.php?key=Nobili2026Secure!
force-db.php	https://casadeinobili.wantdsign.com/force-db.php?key=Nobili2026Secure!
info.php	https://casadeinobili.wantdsign.com/info.php?key=Nobili2026Secure!
reseed.php	https://casadeinobili.wantdsign.com/reseed.php?key=Nobili2026Secure!
update-site.php	https://casadeinobili.wantdsign.com/update-site.php?key=Nobili2026Secure!

Sin ?key=... → aparece “Acceso denegado” con error 403.

Para producción, cambia la clave:
Busca y reemplaza Nobili2026Secure! por algo más secreto, ej: xC9#mKp2!vNobili

Los archivos que debes subir al servidor ahora son:

public/admin.php
public/clear.php
public/fix-db.php
public/fixdb.php
public/force-db.php
public/info.php
public/reseed.php
public/update-site.php
resources/views/layouts/app.blade.php
public/css/tailwind.css