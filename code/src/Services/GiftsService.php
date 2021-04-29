<?php

namespace App\Services;

class GiftsService {
    
    private $gifts = ['flowers', 'car', 'piano', 'money'];

    public function __construct() {
        shuffle($this->gifts);
    }

    public function setGift($gift) {
        $this->gift = $gift;
    }
    
    public function __invoke() {
        return $this->gifts;
    }
        
}