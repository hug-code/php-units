<?php
/**
 * @Name: UtilString.php
 * @Author: hug-code
 */

namespace HugCode\PhpUnits\Utils;

class UtilString
{

    /**
     * @Desc 产生随机字串
     * @param int $len 长度
     * @param string $type 字串类型  0字母 1数字 2大写字母 3小写字母
     * @param string $addChars 额外字符
     * @return false|string
     */
    public static function randomString($len = 6, $type = '', $addChars = '')
    {
        switch ($type) {
            case 0:
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' . $addChars;
                break;
            case 1:
                $chars = str_repeat('0123456789', 3);
                break;
            case 2:
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' . $addChars;
                break;
            case 3:
                $chars = 'abcdefghijklmnopqrstuvwxyz' . $addChars;
                break;
            default:
                $chars = 'ABCDEFGHIJKMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz0123456789' . $addChars;
                break;
        }
        if ($len > 10) { //位数过长重复字符串一定次数
            $chars = $type == 1 ? str_repeat($chars, $len) : str_repeat($chars, 5);
        }
        $chars = str_shuffle($chars);
        return substr($chars, 0, $len);
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
     * CMF密码加密方法
     * @param string $password 要加密的字符串
     * @param string $key 加密秘钥
     * @return string
     */
    public static function generatePassword($password = '', $key = '')
    {
        return "###" . md5(md5($password . $key));
    }

    /**
     * 密码比较方法,所有涉及密码比较的地方都用这个方法
     * @param string $password 要比较的密码
     * @param string $passwordInDb 已经加密过的密码
     * @param string $key 加密秘钥
     * @return boolean 密码相同，返回true
     */
    public static function validatePassword($password = '', $passwordInDb = '', $key = '')
    {
        return self::generatePassword($password, $key) == $passwordInDb;
    }

}
