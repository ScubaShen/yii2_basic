<?php
namespace api\models;

use yii\db\ActiveRecord;

class TotalStatic extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%total_static}}';
    }
}
