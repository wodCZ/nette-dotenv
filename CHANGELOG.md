# Changelog

All Notable changes to `nette-dotenv` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## [2.0.0] - 2017-04-11
- Complete rewrite of extension because of issue #2
### Changed
- Changed installation instructions
- Syntax changed from `%ENV.KEY%` to `@env::get('key', 'default')`
- Changed source from `$_SERVER` variable to `getenv()` function
### Added
- Support for default value
- Support for `local_only` env variables (PHP 7 only, see [getenv()](http://php.net/getenv).)
### Fixed
- No-longer regenerates container on each request
