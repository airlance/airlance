<?php
namespace Services\AirHub\Model\Resource\Route;

use yii\db\ActiveQuery;

class Query extends ActiveQuery
{
    public function connection($operator, $departure, $arrival = [])
    {
        $this->where(['=', 'operator_id', $operator])
            ->andWhere(['in', 'arrival', $arrival])
            ->andWhere(['=', 'departure', $departure]);

        return $this;
    }

    public function route($departure, $arrival, $operator)
    {
        $this->where(['=', 'departure', $departure])
            ->andWhere(['=', 'arrival', $arrival])
            ->andWhere(['=', 'operator_id', $operator]);

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