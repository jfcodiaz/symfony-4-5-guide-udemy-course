<?php

namespace App\Services;

use Psr\Log\LoggerInterface;

class GiftsService {
    
    private $gifts = ['flowers', 'car', 'piano', 'money'];

    private $loger;

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;    
        $this->randomize();
    }

    public function setGifts($gifts) {
        $this->gifts = $gifts;
        $this->randomize();
    }

    private function randomize() {
        $this->logger->info("Gifts were randomized!");
        shuffle($this->gifts);
    }
    
    public function __invoke() {
        return $this->gifts;
    }
        
}