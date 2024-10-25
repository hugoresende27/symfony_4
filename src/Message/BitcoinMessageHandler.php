<?php


namespace App\Message;

use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;



/**
 * @AsMessageHandler
 */
class BitcoinMessageHandler implements MessageHandlerInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(BitcoinMessage $message)
    {
        // Process the message
        $this->logger->info('Processing Bitcoin message: ' . $message->__toString());

        try {
            echo $message->__toString();
        } catch (\Throwable $e) {
            // Log the error or handle it
            error_log($e->getMessage());
            throw $e; // Rethrow if you want to nack the message
        }
  
    }


}