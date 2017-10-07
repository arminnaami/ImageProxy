<?php
/**
 * Created by PhpStorm.
 * User: berry
 * Date: 2017/8/8
 * Time: 17:02
 */

namespace rayful\Tool;


class ImageProxyURLGenerator
{
    private $root;

    private $secret;

    public function __construct($root, $secret)
    {
        $this->root = $root;
        $this->secret = $secret;
    }

    public function build($url, $width = null, $height = null)
    {
        if($width)
            $query['width']  = $width;
        if($height)
            $query['height'] = $height;

        $query['ue']     = $this->XOREncrypt($url);

        return $this->root . '?' . http_build_query($query);
    }

    private function XOREncrypt($url)
    {
        $encodedText = base64_decode($this->secret);
        $ml = strlen($url);
        $kl = strlen($encodedText);
        $encrypt = "";

        for ($i = 0; $i < $ml; $i++) {
            $encrypt .= $url[$i] ^ $encodedText[$i % $kl];
        }
        $encrypt = str_replace(array('+', '/'), array('-', '_'), base64_encode($encrypt));
        $encrypt = rtrim($encrypt,"=");
        return $encrypt;
    }
}