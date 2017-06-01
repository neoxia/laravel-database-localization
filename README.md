# laravel-database-localization

Use a database source instead of files for localization in Laravel

## Installation

### 1. Add in Composer.json

"repositories": [
  ...,
  {
      "type": "vcs",
      "url": "https://github.com/neoxia/laravel-database-localization"
  }  
]

"require": {
  ...,
  "neoxia/laravel-database-localization": "master"
},

### 2. Run a composer update

### 3. Update your config/app.php

Remove
Illuminate\Translation\TranslationServiceProvider::class,

Add
App\Lib\Neoxia\DatabaseLocalization\DatabaseTranslationServiceProvider::class,

### 4. Configure the package

Use the artisan command
`php artisan vendor:publish`

Update the configuration with you model class name. This model has to implement the Neoxia\Translatable interface.
