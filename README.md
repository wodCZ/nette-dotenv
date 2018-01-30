# nette-dotenv

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This little extension helps you to work with environment variables in config.neon.
To make it even more convenient, this extension also variables from `.env` file - a feature well known to Laravel users.

## Install

Via Composer

```bash
$ composer require wodcz/nette-dotenv
```

Then register extension in your `config.neon`
```neon
extensions:
	env: wodCZ\NetteDotenv\DotEnvExtension
```

## Usage

You can access any environment variable using `@env.get('key', 'default')` syntax:

```neon
services:
    - App/MyConnection(@env::get('DB_HOST', '127.0.0.1'))
```

Environment variables are often set by a `docker`, `docker-compose`, or your CI server.
To make working with environment variables even easier, you can specify them in `.env` file
in root directory of your application. 

This file should be hidden from VCS using `.gitignore` or so,
because each developer/server could require different environment configuration. 
Furthermore, having `.env` file with credentials in repository would be a security risk.

This is an example on how your `.env` file might look like:

```
DB_HOST=192.168.0.10
DB_USER=myprojuser
DB_NAME=myproj
GOOGLE_API_KEY=my_own_key_used_for_development
```

Have a look at [vlucas/phpdotenv documentation](https://github.com/vlucas/phpdotenv) for more comprehensive examples.

## Configuration

You can change behavior of this extension using `neon` configuration. Here is a list of available options with their
default values.
```neon
env:
	directory: "%appDir%/../"
	fileName: ".env"
	overload: false
	localOnly: false
	prefix: false
	class: \wodCZ\NetteDotenv\EnvAccessor
```

| Option | Description |
|--------|-------------|
| `directory` | Where your `.env` file is located |
| `fileName` | Name of your `.env` file |
| `overload` | Whether options in the `.env` file should override existing environment variables |
| `localOnly` | [Set to true to only return local environment variables (set by the operating system or putenv).](http://php.net/getenv#refsect1-function.getenv-parameters) |
| `prefix` | Whether to prefix the service name with the extension name |
| `class` | Class used to access environment variables |

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

- [Martin Janeček][link-author]
- [Vašek Henzl](https://github.com/vhenzl)
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
