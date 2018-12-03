<?php
namespace api\models;

use yii\db\ActiveRecord;

class Mem extends ActiveRecord
{
    public static $table;

    public function __construct($preTable = null, array $config = [])
    {
        if ($preTable) {
            self::$table = $preTable . 'mem';
        }
        parent::__construct($config);
    }

    public static function tableName()
    {
        return '{{%' . self::$table . '}}';
    }

    public static function find($preTable = '')
    {
        self::$table = $preTable . 'mem';

        return parent::find();
    }

    public static function createMember($preTable, $params)
    {
        $Member = new self($preTable);

        foreach ($params as $key => $param) {
            $Member->$key = $param;
        }

        return $Member->save();
    }

    public static function updateMember($preTable, $conditions, $params)
    {
        $Member = self::find($preTable)->where($conditions)->one();

        foreach ($params as $key => $param) {
            $Member->$key = $param;
        }

        return $Member->save();
    }
}
