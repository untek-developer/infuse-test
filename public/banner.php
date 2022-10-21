<?php

$bannerFile = __DIR__ . '/images/banner.jpg';
header('Content-Type: image/jpeg');
readfile($bannerFile);

$bannerCounterService = new \App\Services\BannerCounterService();
$bannerCounterService->increment();
