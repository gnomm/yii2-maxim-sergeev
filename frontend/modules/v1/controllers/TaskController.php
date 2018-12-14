<?php
/**
 * Created by PhpStorm.
 * User: gnom
 * Date: 11.12.2018
 * Time: 15:01
 */

namespace frontend\modules\v1\controllers;


use common\models\tables\Tasks;
use yii\rest\ActiveController;

class TaskController extends ActiveController
{
    public $modelClass = Tasks::class;
}