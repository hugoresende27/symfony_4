<?php


namespace App\Message;

use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;



/**
 * @AsMessageHandler
 */
class BitcoinMessageHandler
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(string $message)
    {
        // Process the message
        $this->logger->info('Processing Bitcoin message: ' . $message);

        // Add your business logic here
    }


}