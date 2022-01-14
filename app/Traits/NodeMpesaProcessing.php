<?php


namespace App\Traits;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

trait NodeMpesaProcessing
{
    /**
     * generate a security
     * credentials
     * @return string
     */
    public function generateSecurityCredentials(): string
    {
        $publicKey = File::get(public_path('certificate/production.cer'));
        $plaintext = config('m-pesa.keys.api_password');

        openssl_public_encrypt($plaintext, $encrypted, $publicKey, OPENSSL_PKCS1_PADDING);

        return base64_encode($encrypted);
    }

    /**
     * --------------------------------------
     * Make request to get the access token
     * -------------------------------------
     * @return mixed
     */
    private function getAccessToken()
    {
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($this->consumer_key . ':' . $this->consumer_secret),
            ],
        ];

        // check if cache is active
        if (Cache::has('m_pesa_access_token_' . $this->type)) {
            return Cache::get('m_pesa_access_token_' . $this->type);
        } else {
            // make the request
            $response = json_decode($this->processRequest(
                config('m-pesa.end_points.urls.access_token_url'),
                $options,
                'GET',
                true
            ));
            return $this->cacheAccessToken($response);
        }

    }

    /**
     * ---------------------------
     * cache access token here
     * @param $response
     * @return mixed
     * --------------------------
     */
    private function cacheAccessToken($response)
    {
        return Cache::remember('m_pesa_access_token_' . $this->type, now()->addSeconds($response->expires_in - 100), function () use ($response) {
            return $response->access_token;
        });
    }


    /**
     * -------------------------
     * create header details
     * for any request
     * -------------------------
     * @param array $data
     * @return array[]
     */
    public function setRequestOptions(array $data): array
    {
        return [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getAccessToken(),
            ],
            'json' => $data,
        ];
    }


    /**
     * ---------------------------------
     * process the request
     * @param string $requestUrl
     * @param string $method
     * @param array $data
     * @param bool $accessToken
     * @return string
     * ---------------------------------
     */
    public function processRequest(string $requestUrl, $data = [], string $method = 'POST', bool $accessToken = false)
    {
        try {
            // define the guzzle client
            $client = new Client([
                'base_uri' => $this->baseUri,
                'timeout' => config('mpesa.timeout'),
                'connect_timeout' => config('mpesa.connect_timeout'),
                'protocols' => ['http', 'https'],
            ]);

            // make the request
            if ($accessToken) {
                $response = $client->request($method, $requestUrl, $data);
            } else {
                $response = $client->request($method, $requestUrl, $this->setRequestOptions($data));
            }

            return ($response->getBody()->getContents());
        } catch (ClientException $clientException) {
            $exception = $clientException->getResponse()->getBody()->getContents();
            Log::critical('client-exception' . $clientException->getMessage());
            return $exception;
        } catch (ServerException $serverException) {
            $exception = $serverException->getResponse()->getBody()->getContents();
            Log::critical('server-exception' . $serverException->getMessage());
            return $exception;
        } catch (GuzzleException $guzzleException) {
            Log::critical('guzzle-exception' . $guzzleException->getMessage());
            return $guzzleException;
        }
    }
}
