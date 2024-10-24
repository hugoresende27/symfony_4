<?php

namespace App\Controller\API;



use App\Entity\Bitcoin;
use App\Repository\BitcoinRepository;
use App\Services\Web\BpiAPI;
use DateTimeImmutable;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class BitcoinAPIController
{

    public function __construct(
        protected BpiAPI $api, 
        protected BitcoinRepository $repository)
    {

    }



    public function bitcoin(): JsonResponse
    {
        $bitcoinData = $this->api->getBitcoinValue();

     

        $updatedTime = $bitcoinData['time']['updated']; // Example: "Oct 24, 2024 20:21:20 UTC"

        // Convert the string to DateTimeImmutable
        $dateTimeImmutable = DateTimeImmutable::createFromFormat('M d, Y H:i:s e', $updatedTime);


        if (!$dateTimeImmutable) {
            throw new Exception("Invalid date format: " . $updatedTime);
        }

        $bitcoin = new Bitcoin();
        $bitcoin->setCreatedAt( $dateTimeImmutable);
        $bitcoin->setEUR($bitcoinData['bpi']['EUR']['rate_float']);
        $bitcoin->setGBP($bitcoinData['bpi']['GBP']['rate_float']);
        $bitcoin->setUSD($bitcoinData['bpi']['USD']['rate_float']);
  
        $this->repository->add($bitcoin);
        // Wrap the result in a JsonResponse
        return new JsonResponse($bitcoinData);
    }





    public function getBitcoinValuesHistory(): JsonResponse
    {
        $bitcoins = $this->repository->findAll();

        return new JsonResponse($bitcoins);
    }
}
