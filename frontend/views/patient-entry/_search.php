<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PatientEntrySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-entry-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'patient_name') ?>

    <?= $form->field($model, 'patient_age') ?>

    <?= $form->field($model, 'gender') ?>

    <?= $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'template_names') ?>

    <?php // echo $form->field($model, 'template_ids') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'typist_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
