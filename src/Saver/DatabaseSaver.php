<?php

namespace App\Saver;

use Exception;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Factory\ItemFactory;

class DatabaseSaver implements Saver
{
    public function __construct(
        protected EntityManagerInterface $entityManager,
        protected LoggerInterface $logger,
    ) {}

    /**
     * @throws Exception
    */
    public function save(array $itemArray): void
    {
        $this->logger->info("DatabaseSaver: persisting into database.");

        try {
            foreach ($itemArray as $itemDto){
                $this->entityManager->persist(ItemFactory::createItemEntity($itemDto));
            }
            
            $this->entityManager->flush();
        } catch (Exception $e) {
            $this->logger->error(
                'DatabaseSaver: save items failed.',
                [
                    'exception'      => get_class($e),
                    'message'        => $e->getMessage(),
                ]
            );

            throw $e;
        }

        $this->logger->info('DatabaseSaver: save items successful.');
    }
}
