<?php

declare(strict_types=1);

require_once 'PaymentApiClient.php';

/**
 * Authentication Credentials
 */
$credentials = require_once 'credentials.php';
define("ACCOUNT_LOGIN", $credentials['login']); // stage
define("ACCOUNT_PASSWORD", $credentials['password']); // stage
define("ACCOUNT_SECURE_KEY", $credentials['secureKey']); // stage
unset($credentials);