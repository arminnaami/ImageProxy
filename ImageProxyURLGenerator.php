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

    const NO_TRIM_HOSTS = [
        'aliyun-cdn.hypebeast.cn',  // HBX 的 App 图片
        'image-cdn.hypb.st',        // HBX 的 网页版图片
    ];

    public function __construct($root, $secret)
    {
        $this->root = $root;
        $this->secret = $secret;
    }

    public function build($url, $width = null, $height = null)
    {
        if ($width) {
            $query['width'] = $width;
        }

        if ($height) {
            $query['height'] = $height;
        }

        $query['ue'] = $this->XOREncrypt($url);

        if ($this->shouldNotTrim($url)) {
            $query['notrim'] = 1;
        }

        return $this->root . '?' . http_build_query($query);
    }

    private function shouldNotTrim($url)
    {
        $parseUrl = parse_url($url);
        $host = $parseUrl['host'] ?: "";

        if (in_array($host, self::NO_TRIM_HOSTS)) {
            return true;
        }
        return false;

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
        $encrypt = rtrim($encrypt, "=");
        return $encrypt;
    }
}