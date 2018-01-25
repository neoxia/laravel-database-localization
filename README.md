[![Latest Stable Version](http://img.shields.io/github/release/neoxia/laravel-database-localization.svg)](https://packagist.org/packages/neoxia/laravel-database-localization)

## Laravel Database Localization

This package allows the storage of Laravel translations in a database instead of files. It is not opinionated about how you store your data (any database, any schema) or how you edit this data. It only overwrite the default translation loading by using a Laravel model that can be specified in the configuration.

## Installation

Require this package with composer using the following command:

```
composer require neoxia/laravel-database-localization
```

Go to `config/app.php`, remove the original service provider

```PHP
Illuminate\Translation\TranslationServiceProvider::class,
```

And replace it by this one.

```PHP
Neoxia\DatabaseLocalization\DatabaseTranslationServiceProvider::class,
```

## Configuration

You can publish a default config file by runnning the artisan command
`php artisan vendor:publish`.

Update the configuration with you model class name. This model has to implement the `Neoxia\DatabaseLocalization\Translatable` interface.
