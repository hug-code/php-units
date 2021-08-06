<?php
/**
 * @Name: UtilFile.php
 * @Author: hug-code
 */

namespace HugCode\PhpUnits\Utils;

class UtilFile
{

    /**
     * @Desc 生成目录
     * @param $dir
     * @return bool
     */
    public static function mkdir($dir)
    {
        if (is_dir($dir)) {
            return true;
        }
        if (!mkdir($dir, 0755, true)) {
            return false;
        }
        @chmod($dir, 0755);
        return true;
    }

    /**
     * @Desc 删除文件
     * @param $filename
     */
    public static function deleteFile($filename)
    {
        if (file_exists($filename)) {
            unlink($filename);
        }
    }

    /**
     * @Desc Desc 格式化字节大小
     * @param number $size 字节数
     * @param string $delimiter 数字和单位分隔符
     * @return string            格式化后的带单位的大小
     */
    public static function formatBytes($size, $delimiter = '')
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
        for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
        return round($size, 2) . $delimiter . $units[$i];
    }

}
