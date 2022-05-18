<?php
namespace Services\AirHub\Model\Resource;

use Airlance\Framework\Db\ActiveRecord;
use Hashids\Hashids;
use yii\behaviors\TimestampBehavior;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Json;

/**
 * Timeline
 *
 * @property int $id
 * @property string $object
 * @property string $structure
 * @property string $description
 * @property string $duration
 *
 * @author ReSoul <roberts.mark1985@gmail.com>
 * @since 1.0
 */
class Timeline extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%hub_timeline}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false
            ]
        ];
    }

    public function rules()
    {
        return [
            [['description', 'structure', 'object'], 'required'],
            [['description', 'object', 'structure', 'duration'], 'string'],
        ];
    }

    public function getObjectStructure()
    {
        return Yii::createObject($this->object, Json::decode($this->structure));
    }

    public function createJsonFile($structure)
    {
        $hashids = new Hashids();
        $id = $hashids->encode($this->getPrimaryKey());

        $runtime = Yii::getAlias('@runtime');
        $path = '/structures/' . substr($id, 0, 1);
        $file = $path . "/$id.json";

        FileHelper::createDirectory($runtime . $path);
        file_put_contents($runtime . $file, Json::encode($structure));

        $this->setAttribute('structure', $file);
        $this->update(false);
    }
}