<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PatientEntry */

$this->title = 'Update Patient Details: ' . $model->patient_name;
// $this->params['breadcrumbs'][] = ['label' => 'Patient Entries', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="patient-entry-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <br><br>
    <?= $this->render('_form', [
    'model' => $model,
    'templates' => $templates,
    'typists'=>$typists,
    ]) ?>

</div>
