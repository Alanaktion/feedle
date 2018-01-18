Feedle
======
*A self-hosted alternative to Feeder*

# Requirements

PHP 7.1 or higher with the SimpleXML extension, and a MySQL database. Yarn/NPM is required to compile the static assets.

# Setup

Start by copying `.env.example` to `.env` and adding your site/database info. Then:

```bash
composer install
php artisan key:generate
php artisan migrate
yarn
yarn prod
```

To have your server check for new posts, simply add a cron job that runs the scheduler every minute:

```bash
* * * * * php artisan schedule:run
```

This will ensure new feeds are checked every 15 minutes. In the future, it will allow individual subscriptions to have different update frequencies.
