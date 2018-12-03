<?php
namespace api\models;

use yii\db\ActiveRecord;

class CarpayOrder extends ActiveRecord
{
    public static $table;

    public function __construct($preTable = null, array $config = [])
    {
        if ($preTable) {
            self::$table = $preTable . 'carpay_test';
        }
        parent::__construct($config);
    }

    public static function tableName()
    {
        return '{{%' . self::$table . '}}';
    }

    public static function find($preTable = '')
    {
        self::$table = $preTable . 'carpay_test';

        return parent::find();
    }

    public static function createOrder($preTable, $params)
    {
        $carpayOrder = new self($preTable);

        foreach ($params as $key => $param) {
            $carpayOrder->$key = $param;
        }

        return $carpayOrder->save();
    }

    public static function updateOrder($preTable, $conditions, $params)
    {
        $carpayOrder = self::find($preTable)->where($conditions)->one();

        foreach ($params as $key => $param) {
            $carpayOrder->$key = $param;
        }

        return $carpayOrder->save();
    }
}
