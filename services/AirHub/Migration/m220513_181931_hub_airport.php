<?php
namespace Services\AirHub\Migration;

use Airlance\Framework\Db\Migration;

/**
 * Class m220513_181931_hub_airport
 */
class m220513_181931_hub_airport extends Migration
{
    protected $table = "{{%hub_airport}}";

    public function up()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey()->comment('ID'),
            'name' => $this->char(128)->notNull()->comment('Name'),
            'code' => $this->char(3)->notNull()->comment('iLata'),
            'latitude' => $this->decimal(16, 2)->defaultValue('0.00')->comment('Latitude'),
            'longitude' => $this->decimal(16, 2)->defaultValue('0.00')->comment('Longitude'),
            'created_at' => $this->integer()->comment('Created At'),
            'updated_at' => $this->integer()->comment('Updated At')
        ], $this->tableOptions);

        $this->createIndex('hub_airport_code', $this->table, 'code');
    }
}
