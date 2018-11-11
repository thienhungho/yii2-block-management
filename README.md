Yii2 Block Management System
====================
Block Management System for Yii2

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist thienhungho/yii2-block-management "*"
```

or add

```
"thienhungho/yii2-block-management": "*"
```

to the require section of your `composer.json` file.

### Migration

Run the following command in Terminal for database migration:

```
yii migrate/up --migrationPath=@vendor/thienhungho/Block/migrations
```

Or use the [namespaced migration](http://www.yiiframework.com/doc-2.0/guide-db-migrations.html#namespaced-migrations) (requires at least Yii 2.0.10):

```php
// Add namespace to console config:
'controllerMap' => [
    'migrate' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationNamespaces' => [
            'thienhungho\Block\migrations\namespaced',
        ],
    ],
],
```

Then run:
```
yii migrate/up
```

Config
------------

Add module BlockManage to your `AppConfig` file.

```php
...
'modules'          => [
    ...
    /**
     * Block Manage
     */
    'block-manage' => [
        'class' => 'thienhungho\Block\modules\BlockManage\BlockManage',
    ],
    ...
],
...
```

Modules
------------

[BlockBase](https://github.com/thienhungho/yii2-block-management/tree/master/src/modules/BlockBase), [BlockManage](https://github.com/thienhungho/yii2-block-management/tree/master/src/modules/BlockManage)

Functions
------------

[Core](https://github.com/thienhungho/yii2-block-management/tree/master/src/functions/core.php)

Models
------------

[Block](https://github.com/thienhungho/yii2-block-management/tree/master/src/models/Block.php)