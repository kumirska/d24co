<?php

declare(strict_types=1);

require_once 'include.php';
	
$paymentApiClient = new PaymentApiClient(ACCOUNT_LOGIN, ACCOUNT_PASSWORD, ACCOUNT_SECURE_KEY);

$cashoutId = '111111';

$paymentApiClient->cashoutStatus($cashoutId);

exit;