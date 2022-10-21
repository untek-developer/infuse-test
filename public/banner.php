<?php

require_once __DIR__ . '/../vendor/autoload.php';

$bannerFile = __DIR__ . '/images/banner.jpg';
header('Content-Type: image/jpeg');
readfile($bannerFile);

$bannerCounterService = new \App\Services\BannerCounterService();
$bannerCounterService->increment();
