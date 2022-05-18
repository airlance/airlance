<?php
namespace Services\AirHub\Migration;

use Airlance\Framework\Db\Migration;

/**
 * Class m220513_181958_hub_route
 */
class m220513_181958_hub_route extends Migration
{
    protected $table = "{{%hub_route}}";

    protected $refTable = "{{%hub_operator}}";

    public function up()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey()->comment('ID'),
            'operator_id' => $this->integer()->comment('Operator ID'),
            'departure' => $this->char(3)->notNull()->comment('Departure'),
            'arrival' => $this->char(3)->notNull()->comment('Arrival'),
            'connecting_flight' => $this->smallInteger(1)->defaultValue(0)->comment('Connecting Flight'),
            'status' => $this->smallInteger(1)->defaultValue(1)->comment('Status'),
            'score' => $this->smallInteger(2)->defaultValue(1)->comment('Score')
        ], $this->tableOptions);

        $this->addForeignKey(
            'hub_route_operator_id',
            $this->table,
            'operator_id',
            $this->refTable,
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex('hub_route_departure', $this->table, 'departure');
        $this->createIndex('hub_route_arrival', $this->table, 'arrival');
    }
}
