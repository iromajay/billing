<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Franchises */

$this->title = 'Create Franchises';
$this->params['breadcrumbs'][] = ['label' => 'Franchises', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="franchises-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
