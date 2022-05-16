<?php
namespace Services\AirHub\Migration;

use Airlance\Framework\Db\Migration;

/**
 * Class m220513_181802_hub_timeline
 */
class m220513_181802_hub_timeline extends Migration
{
    protected $table = "{{%hub_timeline}}";

    public function up()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey()->comment('ID'),
            'description' => $this->string()->notNull()->comment('Description'),
            'object' => $this->char(255)->notNull()->comment('Object'),
            'object_id' => $this->integer()->defaultValue(0)->comment('Object ID'),
            'created_at' => $this->integer()->comment('Created At'),
            'updated_at' => $this->integer()->comment('Updated At')
        ], $this->tableOptions);

        $this->createIndex('hub_timeline_object', $this->table, 'object');
        $this->createIndex('hub_timeline_object_id', $this->table, 'object_id');
    }
}
