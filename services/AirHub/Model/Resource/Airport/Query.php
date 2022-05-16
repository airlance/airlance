<?php
namespace Services\AirHub\Model\Resource\Airport;

use yii\db\ActiveQuery;

class Query extends ActiveQuery
{
    public function inCode($code)
    {
        $this->where(['in', 'code', $code]);

        return $this;
    }

    public function notInById($id, $operator)
    {
        $this->where(['not in', 'id', $id])
            ->andWhere(['=', 'operator_id', $operator])
            ->andWhere(['=', 'status', 1]);

        return $this;
    }
}