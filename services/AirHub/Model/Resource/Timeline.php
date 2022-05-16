<?php
namespace Services\AirHub\Model\Resource;

use Airlance\Framework\Db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * Timeline
 *
 * @property int $id
 * @property int $operator_id
 * @property int $status
 * @property int $score
 * @property string $description
 * @property string $arrival
 *
 * @author ReSoul <roberts.mark1985@gmail.com>
 * @since 1.0
 */
class Timeline extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%hub_timeline}}';
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
            [['description', 'status', 'score'], 'required'],
            [['operator_id', 'status', 'score'], 'integer'],
            [['description', 'arrival'], 'string'],
        ];
    }
}