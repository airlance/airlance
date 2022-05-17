<?php
namespace Services\AirHub\Migration;

use Airlance\Framework\Db\Migration;

/**
 * Class m220513_141226_hub_country
 */
class m220513_141226_hub_country extends Migration
{
    protected $table = "{{%hub_country}}";

    public function up()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey()->comment('ID'),
            'name' => $this->char(128)->notNull()->comment('Name'),
            'country_code' => $this->char(3)->null()->comment('Country Code'),
            'created_at' => $this->integer()->comment('Created At'),
            'updated_at' => $this->integer()->comment('Updated At')
        ], $this->tableOptions);

        $this->createIndex('hub_country_country_code', $this->table, 'country_code', true);
    }
}