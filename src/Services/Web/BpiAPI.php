<?php

namespace App\Services\Web;

use Exception;

class BpiAPI
{

    public function __construct(protected string $baseUrl)
    {

    }

    public function getBitcoinValue(): ?array
    {

        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => $this->baseUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            ));
    
            $response = curl_exec($curl);
    
            curl_close($curl);
            
            // Check for cURL errors
            if ($response === false) {
                throw new Exception('cURL error: ' . curl_error($curl));
            }

            // Get the HTTP status code
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($httpCode !== 200) {
                throw new Exception("HTTP error: Status code $httpCode");
            }

    
            return json_decode($response, true);

        } catch (Exception $e) {
            // Handle exception
            echo 'Error: ' . $e->getMessage();
            // You can log the error or perform additional error handling here
            return null; // Return null or handle error as needed
        }

    }
}
