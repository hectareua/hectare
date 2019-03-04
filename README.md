Hectare mobile app backend
============================

Based on [Yii 2](http://www.yiiframework.com/)

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      data/               contains flat data storage (json)
      mail/               contains view files for e-mails
      models/             contains model classes
      modules/            contains app modules
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      web/                contains the entry script and Web resources

INSTALLATION
------------

### Install via Composer

```shell
composer global require "fxp/composer-asset-plugin:~1.1.1"
composer install
```

CONFIGURATION
-------------

### Local configuration files

config/web-local.php
```php
return [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
    ],
];
```

config/main-local.php
```php
return [
    'components' => [
        'db' => [
            'dsn' => 'mysql:host=localhost;dbname=hectare',
            'username' => 'root',
            'password' => '',
        ],
    ],
];
```

INITIALIZATION
-------------

### Initialize application

This step combines running migrations, seeding database tables with lookup values and importing values from original Joomla database table dumps


```
#!shell
./init
```