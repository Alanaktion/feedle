[![Build Status](https://travis-ci.org/Alanaktion/feedle.svg?branch=master)](https://travis-ci.org/Alanaktion/feedle)

Feedle
======
*A self-hosted RSS/Atom feed reader*

# Requirements

PHP 7.2 or higher with the SimpleXML extension, and a MySQL database. NPM is required to compile the static assets.

# Setup

Start by copying `.env.example` to `.env` and adding your site/database info. Then:

```bash
composer install
php artisan key:generate
php artisan migrate
npm ci
npm run prod
```

To have your server check for new posts, simply add a cron job that runs the scheduler every minute:

```bash
* * * * * php artisan schedule:run
```

This will ensure new feeds are checked every 15 minutes. In the future, it will allow individual subscriptions to have different update frequencies.
