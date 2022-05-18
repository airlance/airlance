<?php
namespace Services\AirHub\Model\Resource;

use Airlance\Framework\Db\ActiveRecord;

/**
 * RouteConnectingFlight
 *
 * @property int $id
 * @property int $route_id
 * @property string $connecting
 *
 * @author ReSoul <roberts.mark1985@gmail.com>
 * @since 1.0
 */
class RouteConnectingFlight extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%hub_route_connecting_flight}}';
    }

    public function rules()
    {
        return [
            [['route_id', 'connecting'], 'required'],
            [['route_id'], 'integer'],
            [['connecting'], 'string', 'min' => 3, 'max' => 3],
        ];
    }
}