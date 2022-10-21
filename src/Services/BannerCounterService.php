<?php

namespace App\Services;

use App\Repositories\BannerCounterRepository;

class BannerCounterService
{

    private $bannerCounterRepository;

    public function __construct(BannerCounterRepository $bannerCounterRepository)
    {
        $this->bannerCounterRepository = $bannerCounterRepository;
    }

    public function increment(): void {
        
    }
}
