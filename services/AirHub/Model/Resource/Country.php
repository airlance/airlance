<?php
namespace Services\AirHub\Model\Resource;

use Airlance\Framework\Db\ActiveRecord;
use Airlance\Framework\Resource\ResourceInterface;
use Services\AirHub\Model\Resource\Country\Query;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * Country
 *
 * @property int $id
 * @property string $name
 * @property string $country_code
 *
 * @author ReSoul <roberts.mark1985@gmail.com>
 * @since 1.0
 */
class Country extends ActiveRecord implements ResourceInterface
{
    public static function tableName()
    {
        return '{{%hub_country}}';
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
            [['name', 'country_code'], 'required'],
            [['name'], 'string', 'min' => 2, 'max' => 128],
            [['country_code'], 'string'],
        ];
    }

    public static function find()
    {
        return Yii::createObject(Query::class, [get_called_class()]);
    }
}