<?php
/**
 * @Name: UtilString.php
 * @Author: hug-code
 */

namespace HugCode\PhpUnits\Utils;

class UtilValidator
{

    /**
     * @Desc 是否为url
     * @param $value
     * @return bool
     */
    public static function isUrl($value)
    {
        if (empty($value)) {
            return false;
        }
        if (false === filter_var($value, FILTER_VALIDATE_URL)) {
            return false;
        }
        return true;
    }

    /**
     * @Desc 是否为邮箱
     * @param $value
     * @return bool
     */
    public static function isEmail($value)
    {
        if (empty($value)) {
            return false;
        }
        if (false === filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }


    /**
     * @Desc 判断是否为身份证格式
     * @param $value
     * @return bool
     */
    public static function isCardCode($value)
    {
        $pattern = '/^[0-9a-zA-Z]{15}$|^[0-9a-zA-Z]{18}$/iu';
        return preg_match($pattern, $value) ? true : false;
    }

    /**
     * @Desc 判断是否为手机号码
     * @param $value
     * @return bool
     */
    public static function isMobile($value)
    {
        $pattern = '/^1\d{10}$/';
        return preg_match($pattern, $value) ? true : false;
    }

    /**
     * @Desc 长度是否在范围   中文UTF8占3个字符
     * @param string $value
     * @param integer $min
     * @param integer $max
     * @return bool
     */
    public static function isLength($value, $min, $max)
    {
        if (empty($value)) {
            return false;
        }
        $len = strlen($value);
        if ($len < $min || $len > $max) {
            return false;
        }
        return true;
    }

    /**
     * @Desc 判断是否为纯数字
     * @param $value
     * @return bool
     */
    public static function isNum($value)
    {
        $pattern = '/^\d*$/';
        return preg_match($pattern, $value) ? true : false;
    }

    /**
     * @Desc 判断是否为纯英文
     * @param $value
     * @return bool
     */
    public static function isEng($value)
    {
        $pattern = '/^[a-z]*$/i';
        return preg_match($pattern, $value) ? true : false;
    }

    /**
     * @Desc 是否为邮编
     * @param $value
     * @return bool
     */
    public static function isZipCode($value)
    {
        $pattern = '/^[1-9][0-9]{5}$/i';
        return preg_match($pattern, $value) ? true : false;
    }

}
