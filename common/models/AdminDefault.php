<?php
namespace common\models;

use yii\base\Model;

class AdminDefault extends Model
{
    protected $preTable;

    public function setDefault($preTable)
    {
        $this->preTable = $preTable;
    }

    public function getDefault($functionName)
    {
        if ($this->isExistDefaultTable()) {
            $default = (new \yii\db\Query())
                ->from($this->preTable . 'default')
                ->where(['function_name' => $functionName])
                ->one();
            return $default;
        }
        $this->createDefaultTable();
    }

    protected function isExistDefaultTable()
    {
        if ((new \yii\db\Query())->createCommand('SHOW TABLES like "' . $this->preTable . 'default"')) {
            return true;
        }
        return false;
    }

    protected function createDefaultTable()
    {
        (new \yii\db\Query())->createCommand(
            "CREATE TABLE `" . $this->preTable . "default` (
                    `id` int(4) NOT NULL AUTO_INCREMENT COMMENT '索引id',
                    `customer_name` varchar(50) NOT NULL COMMENT '用途',
                    `function_name` text NOT NULL COMMENT '用途属性',
                    `description` varchar(150) DEFAULT '' COMMENT '描述',
                    PRIMARY KEY (`id`)
                 ) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='商户常量配置表'"
        );
    }
}
