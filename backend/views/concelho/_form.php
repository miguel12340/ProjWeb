<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Concelhos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="concelhos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome_concelhos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ce_id_distritos')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
