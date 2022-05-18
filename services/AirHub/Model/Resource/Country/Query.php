<?php
namespace Services\AirHub\Model\Resource\Country;

use Services\AirHub\Model\Resource\Airport\CodeInterface;
use yii\db\ActiveQuery;

class Query extends ActiveQuery implements CodeInterface
{
    public function inCode($code): Query
    {
        $this->where(['in', 'country_code', $code]);

        return $this;
    }

    public function notInCode($code): Query
    {
        $this->where(['not in', 'country_code', $code]);

        return $this;
    }
}