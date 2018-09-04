<?php

// global login ID
// e.g. david.thomas@example.com
define('LOGIN_ID', getenv('LOGIN_ID'));
define('API_KEY', getenv('API_KEY'));


// e.g. developmnet+authroisation@example.com
// this account will require payments created to be authorised
// define('SDK_NEEDING_AUTHORISATION_LOGIN_ID', getenv('SDK_NEEDING_AUTHORISATION_LOGIN_ID'));
// define('SDK_NEEDING_AUTHORISATION_API_KEY', getenv('SDK_NEEDING_AUTHORISATION_API_KEY'));
define('SDK_NEEDING_AUTHORISATION_LOGIN_ID', 'development+authorisation@currencycloud.com');
define('SDK_NEEDING_AUTHORISATION_API_KEY', 'deadbeefdeadbeefdeadbeefdeadbeefdeadbeefdeadbeefdeadbeefdeadbeef');

// e.g. developmnet+authroisation2@example.com
// this account allows payment authorisations to be completed
// define('SDK_CAN_AUTHORISE_LOGIN_ID', getenv('SDK_CAN_AUTHORISE_LOGIN_ID'));
// define('SDK_CAN_AUTHORISE_API_KEY', getenv('SDK_CAN_AUTHORISE_API_KEY'));

define('SDK_CAN_AUTHORISE_LOGIN_ID', 'development+authorisation2@currencycloud.com');
define('SDK_CAN_AUTHORISE_API_KEY', 'deadbeefdeadbeefdeadbeefdeadbeefdeadbeefdeadbeefdeadbeefdeadbeef');

// keys to use for redaction
define('REDACTED_LOGIN_ID', getenv('REDACTED_LOGIN_ID'));
define('REDACTED_API_KEY', getenv('REDACTED_API_KEY'));

?>
