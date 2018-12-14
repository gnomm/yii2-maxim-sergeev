<?php
/**
 * Created by PhpStorm.
 * User: gnom
 * Date: 11.12.2018
 * Time: 14:35
 */

namespace common\models\search;


use yii\base\Model;
use yii\db\ActiveQuery;

class MessageFilter extends Model
{
    public function filter($filter, ActiveQuery $query )
    {
        $query->filterWhere([
            'user_id' => $filter['user_id']
        ]);
        return $query;
    }
}