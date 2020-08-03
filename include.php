<?php

declare(strict_types=1);

require_once 'PaymentApiClient.php';

/**
 * Authentication Credentials
 */
$credentials = require_once 'credentials.php';
define("ACCOUNT_LOGIN", $credentials['login']);
define("ACCOUNT_PASSWORD", $credentials['password']);
define("ACCOUNT_SECURE_KEY", $credentials['secureKey']);
unset($credentials);