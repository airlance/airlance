<?php
namespace Services\AirHub\Model\Resource;

use Airlance\Framework\Db\ActiveRecord;
use Airlance\Framework\Resource\ResourceInterface;
use Services\AirHub\Model\Resource\Route\Query;
use Yii;

/**
 * Route
 *
 * @property int $id
 * @property int $operator_id
 * @property int $status
 * @property int $score
 * @property string $departure
 * @property string $arrival
 *
 * @author ReSoul <roberts.mark1985@gmail.com>
 * @since 1.0
 */
class Route extends ActiveRecord implements ResourceInterface
{
    public static function tableName()
    {
        return '{{%hub_route}}';
    }

    public function rules()
    {
        return [
            [['operator_id', 'status', 'score'], 'required'],
            [['operator_id', 'status', 'score'], 'integer'],
            [['departure', 'arrival'], 'string', 'min' => 3, 'max' => 3],
        ];
    }

    public static function find()
    {
        return Yii::createObject(Query::class, [get_called_class()]);
    }
}