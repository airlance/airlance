<?php
namespace Services\AirHub\Migration;

use Airlance\Framework\Db\Migration;

/**
 * Class m220513_181908_hub_operator
 */
class m220513_181908_hub_operator extends Migration
{
    protected $table = "{{%hub_operator}}";

    public function up()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey()->comment('ID'),
            'name' => $this->char(128)->notNull()->comment('Name'),
            'website' => $this->char(128)->notNull()->comment('Website'),
            'route' => $this->integer()->defaultValue(0)->comment('Route'),
            'route_active' => $this->integer()->defaultValue(0)->comment('Route Active'),
            'status' => $this->smallInteger(1)->defaultValue(1)->comment('Status'),
            'country' => $this->char(32)->null()->comment('Country'),
            'created_at' => $this->integer()->comment('Created At'),
            'updated_at' => $this->integer()->comment('Updated At')
        ], $this->tableOptions);
    }
}
