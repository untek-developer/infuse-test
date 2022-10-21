<?php

namespace App\Entities;

class BannerCounterEntity
{

    private $id;
    private $ipAddress;
    private $userAgent;
    private $viewDate;
    private $pageUrl;
    private $viewsCount = 1;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    public function setIpAddress($ipAddress): void
    {
        $this->ipAddress = $ipAddress;
    }

    public function getUserAgent()
    {
        return $this->userAgent;
    }

    public function setUserAgent($userAgent): void
    {
        $this->userAgent = $userAgent;
    }

    public function getViewDate()
    {
        return $this->viewDate;
    }

    public function setViewDate($viewDate): void
    {
        $this->viewDate = $viewDate;
    }

    public function getPageUrl()
    {
        return $this->pageUrl;
    }

    public function setPageUrl($pageUrl): void
    {
        $this->pageUrl = $pageUrl;
    }

    public function getViewsCount(): int
    {
        return $this->viewsCount;
    }

    public function setViewsCount(int $viewsCount): void
    {
        $this->viewsCount = $viewsCount;
    }

    public function incrementViewsCount(): void
    {
        $this->viewsCount++;
    }
}
