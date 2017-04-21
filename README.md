[![Build Status](https://travis-ci.org/CurrencyCloud/currencycloud-php.png?branch=master)](https://travis-ci.org/CurrencyCloud/currencycloud-php)

# Currencycloud API v2 PHP client

## Version: 0.9.0

This is the official PHP SDK for the Currencycloud API. Additional documentation 
for each API endpoint can be found at [developer.currencycloud.com](https://developer.currencycloud.com/documentation/getting-started/introduction/). 

If you have any queries or you require support, please contact our sales team at sales@currencycloud.com.  Please quote your login id in any correspondence as this makes
it simpler for us to locate your account and give you the support you need.

## Prerequisites

### Composer (optional, but highly recommended)

CurrencyCloud-PHP is a Composer project. While using Composer is not strictly required, 
it will be far easier to simply make use of Composer to do the dependency management and autoloading for you.


### Supported PHP version

This library aims to support and is tested against PHP 5.5 and greater.

## Installation

The recommended way to install Currencycloud SDK is through
[Composer](http://getcomposer.org).

If you do not have composer installed check [Composer installation guide](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx).

Assuming you have composer installed globally you can require Currencycloud SDK into you project by executing:

```bash
composer require currency-cloud/client
```

After installing, you need to require Composer's autoloader if you did not require it before:

```php
require 'vendor/autoload.php';
```

# Usage

You can register for demo API key at [developer.currencycloud.com](https://developer.currencycloud.com/api-register/). 

An example in PHP 5.5:

```php
use CurrencyCloud\CurrencyCloud;
use CurrencyCloud\Session;

require_once __DIR__ . '/vendor/autoload.php';

$session = new Session(
    Session::ENVIRONMENT_DEMONSTRATION,
    '<user-id>',
    '<api-key>'
);

$client = CurrencyCloud::createDefault($session);

//Authenticate
$client->authenticate()
    ->login();

//Get available currencies
$currencies =
    $client->reference()
        ->availableCurrencies();

echo "Supproted currencies:\n";

foreach ($currencies as $currency) {
    printf(
        "Currency: %s; Code: %s; Decimal places: %d\n",
        $currency->getName(),
        $currency->getCode(),
        $currency->getDecimalPlaces()
    );
}

echo "Balances:\n";

//Find balances
$balances =
    $client->balances()
        ->find();

foreach ($balances->getBalances() as $balance) {
    printf(
        "Balance ID: %s; Currency: %s; Amount: %s\n",
        $balance->getId(),
        $balance->getCurrency(),
        $balance->getAmount()
    );
}

//Close session
$client->authenticate()->close();
```

For a slightly longer example, see [cook-book.php](/examples/cook-book.php), which is an implementation of the [Cookbook](https://developer.currencycloud.com/documentation/getting-started/cookbook/) from the documentation.

## Common Patterns

### Reusing client for multiple requests

Authentication tokens are long-livedand are meant to be reused for multiple requests. This will improve performance of calls through the api. 

## On Behalf Of

If you want to make calls on behalf of another user (e.g. someone who is your end-client), you 
can execute certain commands 'on behalf of' the user's contact id. Here is an example:

```php
$client->onBehalfOf('c6ece846-6df1-461d-acaa-b42a6aa74045', function (CurrencyCloud $client) {
    $balances =
        $client->balances()
            ->find();

    foreach ($balances->getBalances() as $balance) {
        printf(
            "Balance ID: %s; Currency: %s; Amount: %s\n",
            $balance->getId(),
            $balance->getCurrency(),
            $balance->getAmount()
        );
    }
});
```

Each of the above transactions will be executed in scope of the limits for that contact and linked to that contact. Note that the real user who executed the transaction will also be stored.

## Errors
When an error occurs in the API, the library aims to give us much information
as possible. A `CurrencyCloudException` will be thrown that contains much useful information
that you can access via its methods.
When the exception converted to string, it will provide information such as the following:

```yaml
BadRequestException
---
platform: 'PHP 5.6.14-1+deb.sury.org~trusty+1'
request:
    parameters: {  }
    verb: get
    url: 'https://devapi.currencycloud.com/v2/rates/detailed?buy_currency=EUR&sell_currency=GBP&fixed_side=buy&amount=10000.00'
response:
    status_code: 400
    date: 'Sun, 06 Nov 2015 18:22:47 GMT'
    request_id: '2915002181730358306'
errors:
    -
        field: base
        code: rate_could_not_be_retrieved
        message: 'Rate could not be retrieved'
        params: {  }
```

This is split into 5 sections:

1. Error Type: In this case `BadRequestException` represents an HTTP 400 error
2. Platform: The PHP implementation that was used in the client
3. Request: Details about the HTTP request that was made, e.g. the POST parameters
4. Response: Details about the HTTP response that was returned, e.g. HTTP status code
5. Errors: A list of errors that provide additional information

The final section contains valuable information:

- Field: The parameter that the error is linked to
- Code: A code representing this error
- Message: A human readable message that explains the error
- Params: A map that contains dynamic parts of the error message for building custom error messages

When troubleshooting API calls with Currencycloud support, including the full
error in any correspondence can be very helpful.

# Development

## Testing

Test cases can be run with `vendor/bin/phpunit`. 

## Dependencies

* [Guzzle](https://github.com/guzzle/guzzle)
* [Symfony YAML](https://github.com/symfony/yaml)
* [Symfony event dispatcher](https://github.com/symfony/event-dispatcher)


# Versioning

This project uses [semantic versioning](http://semver.org/). You can safely
express a dependency on a major version and expect all minor and patch versions
to be backwards compatible.

# Copyright

Copyright (c) 2016 Currencycloud. See [LICENSE](/LICENSE.md) for details.
