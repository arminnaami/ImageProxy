# ImageProxy
图片代理服务器的URL生成器。

## 用法 
```php
$root = "http://hk.xyh.io/image";
$secret = "secret";
$image = "http://images.neimanmarcus.com/ca/1/product_assets/X/3/P/3/4/NMX3P34_mk.jpg";

$ImageProxyURLGenerator = new \rayful\Tool\ImageProxyURLGenerator($root, $secret);
$URL = $ImageProxyURLGenerator->build($image, 1000, 1000);
```
必须配合图片代理服务器。（需要自行编写，西洋汇已经写好）
本类仅生成需要的URL。
一般可以通过依赖注入去把配置注入使用。
