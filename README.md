# Mondo Bank API

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Total Downloads][ico-downloads]][link-downloads]

A PHP client for interacting with Mondo Bank. Still in development.

## Install

Via Composer

``` bash
$ composer require jworksuk/mondo-bank-api
```

## Usage

``` php
$client = new JWorksUK\Mondo\Client('XXXXX');

$whoami = $client->whoAmI();
$accounts = $client->listAccounts();
$balance = $client->readBalance($accounts->accounts[0]->id);
$transactions = $client->listTransactions($accounts->accounts[0]->id);


```

## Testing

``` bash
$ composer test
```

## TODO

 - TESTS!!!
 - abstract model class
   - toArray, toString
 - More endpoints
   - Retrieve transaction
   - Annotate transaction
   - Create feed item
   - Webhooks
   - Attachemnts
   - Errors!!
 - OAuth2
 - Refresh Access Token
 - Better README
 - Pagination
 - Expanding

## Security

If you discover any security related issues, please email me@jworksuk.com instead of using the issue tracker.

## Credits

- [Jesse James][link-author]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/jworksuk/mondo-bank-api.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/jworksuk/mondo-bank-api-php/master.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/jworksuk/mondo-bank-api-php.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/jworksuk/mondo-bank-api
[link-travis]: https://travis-ci.org/jworksuk/mondo-bank-api-php
[link-downloads]: https://packagist.org/packages/jworksuk/mondo-bank-api
[link-author]: https://github.com/jworksuk
[link-contributors]: ../../contributors
