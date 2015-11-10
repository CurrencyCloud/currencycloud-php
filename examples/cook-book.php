#!/usr/bin/env php
<?php

use CurrencyCloud\CurrencyCloud;
use CurrencyCloud\Model\Beneficiary;
use CurrencyCloud\Model\Conversion;
use CurrencyCloud\Model\Payment;
use CurrencyCloud\Session;

require_once __DIR__ . '/../vendor/autoload.php';

$session = new Session(
    Session::ENVIRONMENT_DEMONSTRATION,
    '<user-id>',
    '<api-key>'
);

$currencyCloud = CurrencyCloud::createDefault($session);

//Note that there is no direct call to authenticate api
$detailedRate = $currencyCloud->rates()->detailed('EUR', 'GBP', 'buy', '10000.00');

var_dump($detailedRate);

$conversion = Conversion::create('EUR', 'GBP', 'buy');
$conversion = $currencyCloud->conversions()->create($conversion, '10000.00', 'Invoice Payment', true);

var_dump($conversion);

$beneficiaryRequiredDetails = $currencyCloud->reference()->beneficiaryRequiredDetails('EUR', 'DE');

var_dump($beneficiaryRequiredDetails);

$beneficiary = Beneficiary::create('Acme GmbH', 'DE', 'EUR', 'John Doe')
    ->setBeneficiaryCountry('DE')
    ->setBicSwift('COBADEFF')
    ->setIban('DE89370400440532013000');

$beneficiary = $currencyCloud->beneficiaries()->create($beneficiary);

var_dump($beneficiary);

$payment = Payment::create('EUR', $beneficiary->getId(), '10000', 'Invoice Payment', 'Invoice 1234')
    ->setPaymentType('regular')
    ->setConversionId($conversion->getId());

$payment = $currencyCloud->payments()->create($payment);

var_dump($payment);
