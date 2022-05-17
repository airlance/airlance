<?php
namespace Services\AirHub\Model\Resource;

use Airlance\Framework\Db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * Timeline
 *
 * @property int $id
 * @property string $object
 * @property string $structure
 * @property string $description
 * @property string $duration
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
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false
            ]
        ];
    }

    public function rules()
    {
        return [
            [['description', 'structure', 'object'], 'required'],
            [['description', 'object', 'structure', 'duration'], 'string'],
        ];
    }
}