<?php
namespace HugCode\PhpUnits\Yii;

use yii\db\ActiveQuery;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use HugCode\PhpUnits\InstanceTool;

class BaseModel extends \yii\db\ActiveRecord
{

    use InstanceTool;

    /**
     * @desc: 批量插入
     *        注意： 数据是二维数组并且列整齐
     *        $data = [
     *             ['field1'=>value, 'field2'=>value, 'field3'=>value],
     *             ['field1'=>value, 'field2'=>value, 'field3'=>value],
     *             ['field1'=>value, 'field2'=>value, 'field3'=>value],
     *        ];
     * @param array $data
     * @throws \yii\db\Exception
     */
    public function batchInsert($data=[])
    {
        \Yii::$app->db->createCommand()
            ->batchInsert(self::tableName(), array_keys($data[0]), $data)
            ->execute();
    }

    /**
     * @Desc 插入数据并返回ID
     * @param array $data
     * @return mixed|null
     */
    public function insertGetId($data=[])
    {
        $className = get_called_class();
        $model = new $className;
        $model->load($data, '');
        $model->save(false);
        return $model->id;
    }

    /**
     * @Desc 获取完整表名
     * @return string
     */
    public static function getTableName()
    {
        $tablePrefix = \Yii::$app->getComponents()['db']['tablePrefix'] ?? '';
        return $tablePrefix.Inflector::camel2id(StringHelper::basename(get_called_class()), '_');
    }

    /**
     * @Desc 获取query查询
     * BaseModel::query($tableName)->where()->asArray()->all();
     * @param $table
     * @return mixed
     */
    public static function query($table)
    {
        return \Yii::createObject(ActiveQuery::className(), [get_called_class(), ['from' => [$table]]]);
    }


}
