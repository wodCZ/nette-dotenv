# nette-dotenv

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This little utility helps you to work with environment variables in config.neon.

Also, this parses the `.env` file - a feature known for Laravel users.

To be specific, it returns the `$_SERVER` variable (after populating it with .env variables).
To make values compatible with Nette, it replaces `%` with `%%`.

## Install

Via Composer

``` bash
$ composer require wodCZ/nette-dotenv
```

## Usage

```php
// in app/bootstrap.php file (or wherever you create \Nette\Configurator)
// add these lines

$parametersLoader = new \wodCZ\NetteDotenv\ParametersLoader(__DIR__.'/../'))
$configurator->addParameters($parametersLoader->getParameters());

```

Then, in your `config.neon` you can use any variable you configured in `.env` file.
Or use ENV variables inside your Docker container, or CI build, you have the idea...

```neon
parameters:
    someVariable: %ENV.DB_HOST%

database:
    default:
        dsn: "mysql:host=%ENV.DB_HOST%;dbname=%ENV.DB_NAME%"
        user: %ENV.DB_USER%
        password: %ENV.DB_PASSWORD%
```

Available `ParametersLoader` variables:
```php
new ParametersLoader(
    $directory, // Where your .env file is stored
    $fileName = '.env', // You may choose file name other than `.env` 
    $namespace = 'ENV', // Key, under which will be ENV variables saved to Nette parameters
    $overload = false // Controls whether .env file variables should override existing ENV variables
)
```

If you change `$namespace` parameter, for example to `ENVIRONMENT`, then in `config.neon`:

```neon
parameters:
	someVariable: %ENVIRONMENT.DB_HOST%
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email admin@ikw.cz instead of using the issue tracker.

## Credits

- [Martin Janecek][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/wodCZ/nette-dotenv.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/wodCZ/nette-dotenv/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/wodCZ/nette-dotenv.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/wodCZ/nette-dotenv.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/wodCZ/nette-dotenv.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/wodCZ/nette-dotenv
[link-travis]: https://travis-ci.org/wodCZ/nette-dotenv
[link-scrutinizer]: https://scrutinizer-ci.com/g/wodCZ/nette-dotenv/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/wodCZ/nette-dotenv
[link-downloads]: https://packagist.org/packages/wodCZ/nette-dotenv
[link-author]: https://github.com/wodCZ
[link-contributors]: ../../contributors
