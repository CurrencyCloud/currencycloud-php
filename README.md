[![Build Status](https://travis-ci.org/CurrencyCloud/currencycloud-php.png?branch=master)](https://travis-ci.org/CurrencyCloud/currencycloud-php)

# Currencycloud API v2 PHP client
## Version: 1.5.2

This is the official PHP SDK for the Currencycloud API. Additional documentation 
for each API endpoint can be found at [developer.currencycloud.com](https://developer.currencycloud.com/documentation/getting-started/introduction/). 

If you have any queries or you require support, please contact our development team at development@currencycloud.com.  Please quote your login id in any correspondence as this makes
it simpler for us to locate your account and give you the support you need.

## Prerequisites
### Composer (optional, but highly recommended)

CurrencyCloud-PHP is a Composer project. While using Composer is not strictly required, 
it will be far easier to simply make use of Composer to do the dependency management and autoloading for you.


### Supported PHP version
This library aims to support and is tested against PHP 7.1 and greater.

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

An example in PHP 7:

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

echo "Supported currencies:\n";

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

Authentication tokens are long-lived and are meant to be reused for multiple requests. This will improve performance of calls through the api. 

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
platform: 'PHP 7.1.11-1+deb.sury.org~trusty+1'
request:
    parameters: {  }
    verb: get
    url: 'https://devapi.currencycloud.com/v2/rates/detailed?buy_currency=EUR&sell_currency=GBP&fixed_side=buy&amount=10000.00'
response:
    status_code: 400
    date: 'Tue, 13 Nov 2018 13:40:00 GMT'
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

# Contributing
**We welcome pull requests from everyone!** Please see [CONTRIBUTING][contr]. Our sincere thanks for [helping us][hof] create the best API for moving money anywhere around the world!

# Versioning
This project uses [semantic versioning](http://semver.org/). You can safely
express a dependency on a major version and expect all minor and patch versions to be backwards compatible.

## Deprecation Policy
Technology evolves quickly and we are always looking for better ways to serve our customers. From time to time we need to make room for innovation by removing sections of code that are no longer necessary. We understand this can be disruptive and consequently we have designed a Deprecation Policy that protects our customers' investment and that allows us to take advantage of modern tools, frameworks and practices in developing software.

Deprecation means that we discourage the use of a feature, design or practice because it has been superseded or is no longer considered efficient or safe but instead of removing it immediately, we mark it as **@deprecated** to provide backwards compatibility and time for you to update your projects. While the deprecated feature remains in the SDK for a period of time, we advise that you replace it with the recommended alternative which is explained in the relevant section of the code.

We remove deprecated features after **three months** from the time of announcement.

The security of our customers' assets is of paramount importance to us and sometimes we have to deprecate features because they may pose a security threat or because new, more secure, ways are available. On such occasions we reserve the right to set a different deprecation period which may range from **immediate removal** to the standard **three months**. 

Once a feature has been marked as deprecated, we no longer develop the code or implement bug fixes. We only do security fixes.

### List of features being deprecated
```
(No features are currently being deprecated)
```
# Support
We actively support the latest version of the SDK. We support the immediate previous version on best-efforts basis. All other versions are no longer supported nor maintained.

# Copyright
Copyright (c) 2015-2019 Currencycloud. See [LICENSE][license] for details.

[license]:   LICENSE.md
[contr]:     CONTRIBUTING.md
[hof]:       HALL_OF_FAME.md
