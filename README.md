# Antlers Translation Strings Exporter

This package extends the capabilities of the [kkomelin/laravel-translatable-string-exporter](https://github.com/kkomelin/laravel-translatable-string-exporter) package, allowing you to export translation strings for both Blade and Antlers templates.

## How to Install

This package can be installed by running the following command from the root of your project:

``` bash
composer require stillat/antlers-translation-strings-exporter --dev
```

## How to Use

Since this package adds additional functionality to [kkomelin/laravel-translatable-string-exporter](https://github.com/kkomelin/laravel-translatable-string-exporter), the usage steps (and configuration) guides are the same.

At a high level, you can export translation strings by running the following Artisan command from the root of your project:

```
php artisan translatable:export <lang>
```

For full usage and configuration steps, please refer to [kkomelin/laravel-translatable-string-exporter](https://github.com/kkomelin/laravel-translatable-string-exporter).

## Credits

This package simply adds additional functionality to the following package, which does all of the hard work:

https://github.com/kkomelin/laravel-translatable-string-exporter

## License

This package is free software released under the MIT License.
