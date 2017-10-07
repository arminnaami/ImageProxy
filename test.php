<?php
/**
 * Created by PhpStorm.
 * User: kingmax
 * Date: 2017/10/7
 * Time: 上午9:47
 */
require __DIR__ . "/ImageProxyURLGenerator.php";

$root = "http://img.xyh.io/image";
$secret = "secret";
$image = "http://images.neimanmarcus.com/ca/1/product_assets/X/3/P/3/4/NMX3P34_mk.jpg";

$ImageProxyURLGenerator = new \rayful\Tool\ImageProxyURLGenerator($root, $secret);
$URL = $ImageProxyURLGenerator->build($image, 1000, 1000);
echo $URL;