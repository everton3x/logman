# LogMan

**Advanced PHP log manager.**

## Purpose

Implementing logging in our applications is very important, but it can be a tedious and complicated task at times.

With that in mind, LogMan was developed to offer the developer a simple to use interface, yet powerful in resources.

With LogMan it is possible to implement different levels of log in different formats, and still meet the PSR-3.

For details on the PSR-3 specification, please refer to the [specification website](https://www.php-fig.org/psr/psr-3/).

## Requiriments

For installing and using LogMan you will need:

- [PHP7.4.5+](https://php.net)
- [Composer](https://getcomposer.org) (optional)

Detailed requirements can be found at [composer.json](https://github.com/everton3x/logman/blob/master/composer.json)

## Installation

The best way to install LogMan is through Composer:

```sh

composer require everton3x/logman

```

You can also clone the repository and install the dependencies with the composer:

```sh

git clone https://github.com/everton3x/logman.git

composer install

```

Or you can do everything manually. If you are willing to do that, it means you know how to do it;)

## Usage

For usage examples, please refer to the [examples directory](https://github.com/everton3x/logman/tree/master/examples)

## Documentation

The source code is all commented out. Documentation in other formats is on the way.

## Changelog

**next version**

- Logger on files
- PHPUnit tests
- More examples

**version 0.1.0**

- Initial release
- Default Messenger
- Logger for PHP STDOUT

## How to contribute

Contributions are always welcome, whether with issues, with a pull request or a coffee. However to organize the mess a little, if you want to contribute with code, please follow the workflow:

- Fork the repository.
- Create a new branch for each feature or correction;
- Submit a pull request.

Thank you!

## Author

[Everton da Rosa](https://everton3x.github.com)
