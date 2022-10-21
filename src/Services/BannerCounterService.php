<?php

namespace App\Services;

use App\Entities\BannerCounterEntity;
use App\Exceptions\NotFoundException;
use App\Repositories\BannerCounterRepository;

class BannerCounterService
{

    private $bannerCounterRepository;

    public function __construct(BannerCounterRepository $bannerCounterRepository)
    {
        $this->bannerCounterRepository = $bannerCounterRepository;
    }

    public function increment(string $ipAddress, string $userAgent, string $pageUrl): void
    {
        try {
            $counterEntity = $this->bannerCounterRepository->findOneUnique($ipAddress, $userAgent, $pageUrl);
            $counterEntity->incrementViewsCount();
            $this->bannerCounterRepository->update($counterEntity);
        } catch (NotFoundException $e) {
            $counterEntity = new BannerCounterEntity();
            $counterEntity->setIpAddress($ipAddress);
            $counterEntity->setUserAgent($userAgent);
            $counterEntity->setPageUrl($pageUrl);
            $this->bannerCounterRepository->insert($counterEntity);
        }
    }
}
