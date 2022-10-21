<?php

use App\Repositories\BannerCounterRepository;
use App\Services\BannerCounterService;

require_once __DIR__ . '/../vendor/autoload.php';

$bannerFile = __DIR__ . '/images/banner.jpg';
header('Content-Type: image/jpeg');
readfile($bannerFile);

$bannerCounterService = new BannerCounterService(new BannerCounterRepository());
$bannerCounterService->saveView($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'], $_SERVER['HTTP_REFERER']);
