<?php
namespace api\models;

use yii\db\ActiveRecord;

class CarpayHistory extends ActiveRecord
{
    public static $table;

    public function __construct($preTable = null, array $config = [])
    {
        if ($preTable) {
            self::$table = $preTable . 'carpay_history';
        }
        parent::__construct($config);
    }

    public static function tableName()
    {
        return '{{%' . self::$table . '}}';
    }

    public static function find($preTable = '')
    {
        self::$table = $preTable . 'carpay_history';

        return parent::find();
    }

    public static function createHistory($preTable, $params)
    {
        $carpayHistory = new self($preTable);

        foreach ($params as $key => $param) {
            $carpayHistory->$key = $param;
        }

        return $carpayHistory->save();
    }

    public static function updateHistory($preTable, $conditions, $params)
    {
        $carpayHistory = self::find($preTable)->where($conditions)->one();

        foreach ($params as $key => $param) {
            $carpayHistory->$key = $param;
        }

        return $carpayHistory->save();
    }
}
