<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\tables\Users */

$this->title = 'Update Users: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-update">

    <h1><?= Html::encode($this->title) ?></h1>
<?php //var_dump($model)?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
