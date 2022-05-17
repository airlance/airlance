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
            'structure' => $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext')->comment('Structure'),
            'duration' => $this->char(32)->null()->comment('Duration'),
            'created_at' => $this->integer()->comment('Created At')
        ], $this->tableOptions);

        $this->createIndex('hub_timeline_object', $this->table, 'object');
    }
}
