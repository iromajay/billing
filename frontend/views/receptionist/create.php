<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Receptionist */

$this->title = 'Create Receptionist';
$this->params['breadcrumbs'][] = ['label' => 'Receptionists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="receptionist-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
