<?php

declare(strict_types=1);

require_once 'include.php';
	
$paymentApiClient = new PaymentApiClient(ACCOUNT_LOGIN, ACCOUNT_PASSWORD, ACCOUNT_SECURE_KEY);

//external_id          ( string (max length: 100), Cashout identification at the merchant site )
//document_id          ( https://developers.directa24.com/?php#x_cpf-document_id )                  ! show only D_IDs for Colombia
//country              ( https://developers.directa24.com/?php#x_country-country-and-currencies )   ! only Colombia
//currency             ( https://developers.directa24.com/?php#x_country-country-and-currencies )   ! only COP
//amount               ( number (multiple of: 0.01) )
//bank_code            ( https://developers.directa24.com/?php#colombia-payment-methods )
//bank_account         ( string (max length: 30), Beneficiary's bank account number )
//account_type         ( C: checkings, S: savings )
//beneficiary_name     ( string (max length: 100), Beneficiary name or company )
//beneficiary_lastname ( string (max length: 100), Beneficiary surname )
//email                ( https://developers.directa24.com/?php#x_email-email )
//document_type        ( https://developers.directa24.com/#x_cpf-document_id )
//address              ( string (maxLength: 200), Address of the beneficiary )

$externalId = 'test_' . time();
$documentId = '947628398';
$documentType = 'CE';
$beneficiaryName = 'Carlos';
$beneficiaryLastName = 'Sena';
$country = 'CO';
$amount = 10;
$currency = 'USD';
$email = 'carlossena4@mail.com';
$bankCode = '003';
$bankAccount = '93873631';
$accountType = 'C';
$address = 'He, by 19';

$paymentApiClient->cashout(
    $externalId,
    $documentId,
    $documentType,
    $beneficiaryName,
    $beneficiaryLastName,
    $country,
    $amount,
    $currency,
    $email,
    $bankCode,
    $bankAccount,
    $accountType,
    $address
);

exit;