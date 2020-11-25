<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Typist */

$this->title = 'Create Typist';
$this->params['breadcrumbs'][] = ['label' => 'Typists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="typist-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
