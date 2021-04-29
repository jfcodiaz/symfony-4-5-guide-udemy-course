<?php

namespace App\Services;

class GiftsService {
    
    private $gifts = ['flowers', 'car', 'piano', 'money'];

    public function __construct() {
        shuffle($this->gifts);
    }

    public function setGifts($gifts) {
        $this->gifts = $gifts;
        shuffle($this->gifts);
    }

    public function __invoke() {
        return $this->gifts;
    }
        
}