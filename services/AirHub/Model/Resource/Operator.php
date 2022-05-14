<?php
namespace Services\AirHub\Model\Resource;

use Airlance\Framework\Db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Operator extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%hub_operator}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }

    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            [['route', 'route_active', 'status'], 'integer'],
            [['name', 'website', 'country'], 'string', 'min' => 2, 'max' => 128],
        ];
    }
}