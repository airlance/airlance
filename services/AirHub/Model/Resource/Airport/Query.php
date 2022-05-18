<?php
namespace Services\AirHub\Model\Resource\Airport;

use yii\db\ActiveQuery;

class Query extends ActiveQuery implements CodeInterface
{
    public function inCode($code): Query
    {
        $this->where(['in', 'code', $code]);

        return $this;
    }

    public function notInCode($code): Query
    {
        $this->where(['not in', 'code', $code]);

        return $this;
    }
}