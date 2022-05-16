<?php
namespace Services\AirHub\Model\Resource;

use Airlance\Framework\Db\ActiveRecord;
use Airlance\Framework\Resource\ResourceInterface;
use yii\behaviors\TimestampBehavior;

class Operator extends ActiveRecord implements ResourceInterface
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
            [['name', 'status', 'score'], 'required'],
            [['route', 'route_active', 'status', 'score'], 'integer'],
            [['name', 'website', 'country'], 'string', 'min' => 2, 'max' => 128],
        ];
    }
}