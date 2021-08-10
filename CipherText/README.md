## Openssl
##### 生成公私钥
```text
openssl genrsa -out private.key 1024
openssl rsa -in private.key -pubout -out public.key
```
##### 实例
```text

$openssl = new Openssl();
$openssl->setPrivateKey('D:\website\private.key');
$openssl->setPublicKey('D:\website\pub.key');

// 公钥加密、私钥解密
$content = json_encode(['qq'=>1, 'ww'=>2]);
$publicEncrypt = $openssl->publicEncrypt($content);
var_dump($publicEncrypt);
$privateDecrypt = $openssl->privateDecrypt($publicEncrypt);
var_dump($privateDecrypt);

// 私钥加密、公钥解密
$contents = json_encode(['ee'=>1, 'rr'=>2]);
$privateEncrypt = $openssl->privateEncrypt($contents);
var_dump($privateEncrypt);
$publicDecrypt = $openssl->publicDecrypt($privateEncrypt);
var_dump($publicDecrypt);
```
