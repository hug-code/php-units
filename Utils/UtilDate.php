<?php
/**
 * @Name: UtilFile.php
 * @Author: hug-code
 */

namespace HugCode\PhpUnits\Utils;

class UtilDate
{

    /**
     * @Desc 计算两个日期相差时间
     * @param int $start
     * @param int $end
     * @param int $type 0:天数  1:小时数  2:分钟数 3:秒数 4:秒数
     * @return float|int
     */
    public static function diffBetweenDays($start, $end, $type = 0)
    {
        $interval = [86400, 3600, 60, 0];
        $type     = $interval[$type] ?? $interval[0];
        $res      = strtotime($end) - strtotime($start);
        return $type ? (int)$res / $type : $res;
    }

    /**
     * @Desc 当前微秒值
     * @return float
     */
    public static function microsecond()
    {
        return (float)sprintf('%.0f', (microtime(TRUE)) * 1000);
    }

    /**
     * @Desc 格式化
     * @param $time
     * @return string
     */
    public static function format($time)
    {
        // 定义最终返回的结果字符串。
        $interval = null;
        $second   = time() - $time;
        if ($second <= 0) {
            $second = 0;
        }
        if ($second == 0) {
            $interval = "刚刚";
        } else if ($second < 30) {
            $interval = $second . "秒以前";
        } else if ($second >= 30 && $second < 60) {
            $interval = "半分钟前";
        } else if ($second >= 60 && $second < 60 * 60) { // 大于1分钟 小于1小时
            $minute   = $second / 60;
            $interval = $minute . "分钟前";
        } else if ($second >= 60 * 60 && $second < 60 * 60 * 24) { // 大于1小时 小于24小时
            $hour = ($second / 60) / 60;
            if ($hour <= 3) {
                $interval = $hour . "小时前";
            } else {
                $interval = "今天" . date('H:i', $time);
            }
        } else if ($second >= 60 * 60 * 24 && $second <= 60 * 60 * 24 * 2) { // 大于1D 小于2D
            $interval = "昨天" . date('H:i', $time);
        } else if ($second >= 60 * 60 * 24 * 2 && $second <= 60 * 60 * 24 * 7) { // 大于2D小时 小于 7天
            $day      = (($second / 60) / 60) / 24;
            $interval = $day . "天前";
        } else if ($second <= 60 * 60 * 24 * 365 && $second >= 60 * 60 * 24 * 7) { // 大于7天小于365天
            $interval = date('m-d H:i', $time);
        } else if ($second >= 60 * 60 * 24 * 365) { // 大于365天
            $interval = date('Y-m-d H:i:s', $time);
        }
        return $interval;
    }

}
