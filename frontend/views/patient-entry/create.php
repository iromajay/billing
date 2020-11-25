<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PatientEntry */

$this->title = 'Add Patient Details';
// $this->params['breadcrumbs'][] = ['label' => 'Patient Entries', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-entry-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <br><br>
    <?= $this->render('_form', [
        'model' => $model,
        'templates' => $templates,
        'typists'=>$typists,
        // 'role'=>$role,
        // 'centers'=>$centers
    ]) ?>

</div>
