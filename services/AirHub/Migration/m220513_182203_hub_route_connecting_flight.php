<?php
namespace Services\AirHub\Migration;

use Airlance\Framework\Db\Migration;

/**
 * Class m220513_182203_hub_route_connecting_flight
 */
class m220513_182203_hub_route_connecting_flight extends Migration
{
    protected $table = "{{%hub_route_connecting_flight}}";

    protected $refTable = "{{%hub_route}}";

    public function up()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey()->comment('ID'),
            'route_id' => $this->integer()->comment('Operator ID'),
            'connecting' => $this->char(3)->notNull()->comment('Connecting')
        ], $this->tableOptions);

        $this->addForeignKey(
            'hub_route_connecting_flight_route_id',
            $this->table,
            'route_id',
            $this->refTable,
            'id',
            'CASCADE',
            'CASCADE'
        );
    }
}
