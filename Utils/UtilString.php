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


}
