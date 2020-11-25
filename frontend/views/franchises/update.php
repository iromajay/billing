<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Franchises */

$this->title = 'Update Franchises: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Franchises', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="franchises-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
