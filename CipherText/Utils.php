<?php
/**
 * @Name: Utils.php
 * @Author: hug-code
 */

namespace HugCode\PhpUnits\CipherText;

class Utils
{

    /**
     * @Desc base64 编码
     * @param $data
     * @return string
     */
    public static function base64UrlEncode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /**
     * @Desc base64 解码
     * @param $data
     * @return string
     */
    public static function base64UrlDecode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

    /**
     * @Desc 字符串加密解密
     * @param string $string 待加密、解密的字符串
     * @param string $operation 'ENCODE':加密   'DECODE':解密
     * @param string $key
     * @return false|string|string[]
     */
    public static function authCode($string, $operation = 'ENCODE', $key = '4e892e5a7c3')
    {
        $key           = md5($key);
        $key_length    = strlen($key);
        $string        = $operation == 'DECODE' ?
            base64_decode($string) :
            substr(md5($string . $key), 0, 8) . $string;
        $string_length = strlen($string);
        $rndkey        = $box = array();
        $result        = '';
        for ($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($key[$i % $key_length]);
            $box[$i]    = $i;
        }
        for ($j = $i = 0; $i < 256; $i++) {
            $j       = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp     = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }
        for ($a = $j = $i = 0; $i < $string_length; $i++) {
            $a       = ($a + 1) % 256;
            $j       = ($j + $box[$a]) % 256;
            $tmp     = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result  .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }
        if ($operation == 'DECODE') {
            if (substr($result, 0, 8) == substr(md5(substr($result, 8) . $key), 0, 8)) {
                return substr($result, 8);
            } else {
                return '';
            }
        } else {
            return str_replace('=', '', base64_encode($result));
        }
    }

}
