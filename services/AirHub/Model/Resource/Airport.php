<?php
namespace Services\AirHub\Model\Resource;

use Airlance\Framework\Db\ActiveRecord;
use Airlance\Framework\Resource\ResourceInterface;
use Services\AirHub\Model\Resource\Airport\Query;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * Airport
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $country_code
 * @property string $score
 * @property string $city
 * @property string $longitude
 * @property string $latitude
 *
 * @author ReSoul <roberts.mark1985@gmail.com>
 * @since 1.0
 */
class Airport extends ActiveRecord implements ResourceInterface
{
    public static function tableName()
    {
        return '{{%hub_airport}}';
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
            [['name', 'code', 'score'], 'required'],
            [['score'], 'integer'],
            [['longitude', 'latitude', ], 'number'],
            [['name', 'city'], 'string', 'min' => 2, 'max' => 128],
            [['code'], 'string', 'min' => 3, 'max' => 3],
            [['country_code'], 'string'],
        ];
    }

    public static function find()
    {
        return Yii::createObject(Query::class, [get_called_class()]);
    }
}