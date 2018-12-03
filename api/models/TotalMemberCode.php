<?php
namespace api\models;

use yii\db\ActiveRecord;

class TotalMemberCode extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%total_member_code}}';
    }
}
