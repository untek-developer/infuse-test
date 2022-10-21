<?php

$bannerFile = __DIR__ . '/images/banner.jpg';
header('Content-Type: image/jpeg');
readfile($bannerFile);

