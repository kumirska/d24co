<?php

declare(strict_types=1);

class PaymentApiClient
{
    private string $login;
	private string $password;
	private string $secretKey;

    /**
     * Constructor
     *
     * @param string $login
     * @param string $password
     * @param string $secureKey
     */
	public function __construct(string $login, string $password, string $secureKey)
	{
		$this->login = $login;
		$this->password = $password;
		$this->secretKey = $secureKey;
	}

    /**
     * @param string $externalId
     * @param string $documentId
     * @param string $documentType
     * @param string $beneficiaryName
     * @param string $beneficiaryLastName
     * @param string $country
     * @param float $amount
     * @param string $currency
     * @param string $email
     * @param string $bankCode
     * @param string $bankAccount
     * @param string $accountType
     * @param string $address
     */
	public function cashout(
        string $externalId,
        string $documentId,
        string $documentType,
        string $beneficiaryName,
        string $beneficiaryLastName,
        string $country,
        float $amount,
        string $currency,
        string $email,
        string $bankCode,
        string $bankAccount,
        string $accountType,
        string $address
    ): void {
	     $payload = [
            'login' => $this->login,
            'pass' => $this->password,
            'external_id' => $externalId,
            'document_id' => $documentId,
            'document_type' => $documentType,
            'beneficiary_name' => $beneficiaryName,
            'beneficiary_lastname' => $beneficiaryLastName,
            'country' => $country,
            'amount' => (string) $amount,
            'currency' => $currency,
            'email' => $email,
            'bank_code' => $bankCode,
            'bank_account' => $bankAccount,
            'account_type' => $accountType,
            'address' => $address,
        ];

        $payloadSignature = $this->generateSignature($payload);

        print 'jsonPayload: ' . json_encode($payload) . PHP_EOL;
        print 'signature: ' . $payloadSignature . PHP_EOL;

        $result = $this->process('/v3/cashout', $payload, $payloadSignature);

        echo json_encode($result, JSON_PRETTY_PRINT) . PHP_EOL;
	}

    /**
     * @param string $cashoutId
     */
	public function cashoutStatus(string $cashoutId): void
    {
        $payload = [
            'login' => $this->login,
            'pass' => $this->password,
            'cashout_id' => $cashoutId,
        ];

        $payloadSignature = $this->generateSignature($payload);

        print 'jsonPayload: ' . json_encode($payload) . PHP_EOL;
        print 'signature: ' . $payloadSignature . PHP_EOL;

        $result = $this->process('/v3/cashout/status', $payload, $payloadSignature);

        echo json_encode($result, JSON_PRETTY_PRINT) . PHP_EOL;
    }

    /**
     * @param string $uri
     * @param mixed[] $payload
     * @param string $signature
     * @return array
     */
	protected function process($uri, $payload, $signature = null): array
	{
	    $curlHandler = curl_init();
        curl_setopt_array($curlHandler, array(
            CURLOPT_URL => "https://api-stg.directa24.com" . $uri,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLINFO_HEADER_OUT => 1,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                "Payload-Signature: {$signature}",
                'cache-control: no-cache',
            ],
        ));

        $response = curl_exec($curlHandler);

        $this->dumpCurlInfo($curlHandler);

        curl_close($curlHandler);

		return json_decode($response, true);
	}

    /**
     * @param array $payload
     * @return string
     */
	private function generateSignature(array $payload): string
    {
        return strtolower(
            hash_hmac(
                'sha256',
                pack('A*', json_encode($payload)),
                pack('A*', $this->secretKey)
            )
        );
    }

    /**
     * @param resource|false $curlHandler
     */
    private function dumpCurlInfo($curlHandler): void
    {
        // Dump request header
        $info = curl_getinfo($curlHandler);
        print '<HEADER>' . PHP_EOL;
        print_r($info['request_header']);
        print '</HEADER>' . PHP_EOL;

        // Dump error if exists
        $error = curl_error($curlHandler);

        if ($error) {
            print '<ERROR>' . PHP_EOL;
            print_r($error);
            print '</ERROR>' . PHP_EOL;
        }
    }
}