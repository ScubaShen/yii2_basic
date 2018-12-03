<?php
namespace api\models;

use yii\db\ActiveRecord;

class CarpayBanner extends ActiveRecord
{
    public static $table;

    public function __construct($preTable = null, array $config = [])
    {
        if ($preTable) {
            self::$table = $preTable . 'carpay_banner';
        }
        parent::__construct($config);
    }

    public static function tableName()
    {
        return '{{%' . self::$table . '}}';
    }

    public static function find($preTable = '')
    {
        self::$table = $preTable . 'carpay_banner';

        return parent::find();
    }

    public static function createBanner($preTable, $params)
    {
        $carpayBanner = new self($preTable);

        foreach ($params as $key => $param) {
            $carpayBanner->$key = $param;
        }

        return $carpayBanner->save();
    }

    public static function updateBanner($preTable, $conditions, $params)
    {
        $carpayBanner = self::find($preTable)->where($conditions)->one();

        foreach ($params as $key => $param) {
            $carpayBanner->$key = $param;
        }

        return $carpayBanner->save();
    }
}
