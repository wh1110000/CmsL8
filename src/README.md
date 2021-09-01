# Install

Follow the steps below:

1. Edit your `composer.json` file:

```php
"require": {
	// [...]
  "111-0000/articles": "dev-master",
},

```
```php

"repositories": [
// [...],
  {
      "type": "vcs",
      "url" : "https://github.com/111-0000/Articles"
  }
    ]
```

2. Install the package via composer;

```php
composer install
```

3. Run migrations;

```php
php artisan migrate
```

4. To add new post type (as example **archive**) you can use:

`php artisan workhouse:install archives`

**Note:** name should be always in plural.
