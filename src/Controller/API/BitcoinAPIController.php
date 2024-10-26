<?php

namespace App\Controller\API;



use App\Entity\Bitcoin;
use App\Message\BitcoinMessage;
use App\Repository\BitcoinRepository;
use App\Services\Web\BpiAPI;
use DateTimeImmutable;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Summary of BitcoinAPIController
 * routes in config/routes.yaml
 */
class BitcoinAPIController
{

    public function __construct(
        protected BpiAPI $api, 
        protected BitcoinRepository $repository,
        private MessageBusInterface $message,
        private LoggerInterface $logger)
    {

    }

    public function bitcoinMessage(): JsonResponse
    {
        $this->logger->info('bitcoinMessage');
        $data = new BitcoinMessage('updating bitcoin ...');
        $this->message->dispatch($data);
        return new JsonResponse(['status' => 'updated bitcoin value!']);
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
