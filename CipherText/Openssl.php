<?php
/**
 * @Name: Openssl.php
 * @Author: hug-code
 */

namespace HugCode\PhpUnits\CipherText;

class Openssl
{

    /**
     * @var
     */
    public $private_key = null;

    /**
     * @var
     */
    public $public_key = null;

    /**
     * @Desc 获取私钥
     * @param string $keyPath
     * @author hug-code
     */
    public function setPrivateKey($keyPath = '')
    {
        if (file_exists($keyPath)) {
            $this->private_key = openssl_pkey_get_private(file_get_contents($keyPath));
        }
    }

    /**
     * @Desc 获取公钥
     * @param string $keyPath
     * @author hug-code
     */
    public function setPublicKey($keyPath = '')
    {
        if (file_exists($keyPath)) {
            $this->public_key = openssl_pkey_get_public(file_get_contents($keyPath));
        }
    }

    /**
     * @Desc 私钥解密
     * @param $encrypted
     * @return string
     * @author hug-code
     */
    public function privateDecrypt($encrypted)
    {
        if(empty($this->private_key)){
            return '';
        }
        $crypto = '';
        foreach (str_split(Utils::base64UrlDecode($encrypted), 128) as $chunk) {
            openssl_private_decrypt($chunk, $decryptData, $this->private_key, OPENSSL_PKCS1_PADDING);
            $crypto .= $decryptData;
        }
        return $crypto;
    }

    /**
     * @Desc 私钥加密
     * @param $data
     * @return string|string[]
     * @author hug-code
     */
    public function privateEncrypt($data)
    {
        if(empty($this->private_key)){
            return '';
        }
        $crypto = '';
        foreach (str_split($data, 117) as $chunk) {
            openssl_private_encrypt($chunk, $decryptData, $this->private_key, OPENSSL_PKCS1_PADDING);
            $crypto .= $decryptData;
        }
        return Utils::base64UrlEncode($crypto);
    }

    /**
     * @Desc 公钥解密
     * @param $encrypted
     * @return string
     * @author hug-code
     */
    public function publicDecrypt($encrypted)
    {
        if(empty($this->public_key)){
            return '';
        }
        $crypto = '';
        foreach (str_split(Utils::base64UrlDecode($encrypted), 128) as $chunk) {
            openssl_public_decrypt($chunk, $decryptData, $this->public_key, OPENSSL_PKCS1_PADDING);
            $crypto .= $decryptData;
        }
        return $crypto;
    }

    /**
     * @Desc 公钥加密
     * @param $data
     * @return string|string[]
     * @author hug-code
     */
    public function publicEncrypt($data)
    {
        if(empty($this->public_key)){
            return '';
        }
        $crypto = '';
        foreach (str_split($data, 117) as $chunk) {
            openssl_public_encrypt($chunk, $decryptData, $this->public_key, OPENSSL_PKCS1_PADDING);
            $crypto .= $decryptData;
        }
        return Utils::base64UrlEncode($crypto);
    }

}



