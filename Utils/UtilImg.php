<?php
/**
 * @Name: UtilImg.php
 * @Author: yashuai
 */

namespace HugCode\PhpUnits\Utils;

class UtilImg
{

    /**
     * @Desc 图片url转base64
     * @param string $url
     * @return string
     * @throws \Exception
     * @author yashuai
     */
    public function imgUrlToBase64($url = '')
    {
        try {
            $imageInfo = getimagesize($url);
            $mime      = UtilArray::arrayField($imageInfo, 'mime', 'jpg');
            return 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($url));
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @Desc base64保存图片
     * @param $base64
     * @param string $rootPath
     * @param string $fileDir
     * @param bool $fileName
     * @return bool|string
     * @author yashuai
     */
    public function base64ToImg($base64, $rootPath='/', $fileDir='/', $fileName=false)
    {
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64, $result)) {
            UtilFile::mkdir($rootPath . $fileDir);
            $fileName    = $fileName ? $fileName : UtilString::randomString(32) . '.' . $result[2];
            $filePath    = $fileDir . $fileName;
            $fileContent = base64_decode(str_replace($result[1], '', $base64));
            if (file_put_contents($rootPath . $filePath, $fileContent)) {
                return $filePath;
            }
            return false;
        }
        return false;
    }

}
