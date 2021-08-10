<?php
/**
 * @Name: Password.php
 * @Author: hug-code
 */

namespace HugCode\PhpUnits\CipherText;

class Password
{

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
