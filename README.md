# Install

Follow the steps below:

1. Edit your `composer.json` file:

```php
"require": {
	// [...]
  "111-0000/workhouse": "dev-master"
},

```
```php

"repositories": [
  {
      "type": "vcs",
      "url" : "https://github.com/111-0000/Workhouse"
  }
    ]
```

2. Install the package via composer:

```php
composer install
```

3. Run migrations:

```php
php artisan migrate
```

4. Run:

```php
php artisan vendor:publish --provider="RealRashid\SweetAlert\SweetAlertServiceProvider
```

# Log In

Admin Panel: `path_to_your_project/{locale}/admin/login`

Before you can login to admin panel, you should add first admin to database manually.

# Views

1. If you want to edit views use command below:

```php
php artisan vendor:publish --tag=tag_name
```

where `tag_name` is one of:
- account;
- welcome-modal;
- auth;
- homepage;
- content-internal;
- content-global;
- website-template;
- auth-template;

or if you have installed extra plugins then:
- testimonials;
- shops;
- faqs;

for custom post types:
- *post type name in plural*;

# Styles

1. Navigate to the src folder:

```php
cd vendor/111-000/Workhouse/src
```

2. Install node modules:

```php
npm install
```

3. Compile assets into dist:

```php
npm run dev
```

4. Return to project root and publish assets:

```php
cd ../../../.. && php artisan vendor:publish --tag=assets --force
```
