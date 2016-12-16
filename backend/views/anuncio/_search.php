<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnuncioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anuncio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_anuncio') ?>

    <?= $form->field($model, 'ce_id_user') ?>

    <?= $form->field($model, 'asunto') ?>

    <?= $form->field($model, 'preco') ?>

    <?= $form->field($model, 'descricao') ?>

    <?php // echo $form->field($model, 'id_distrito') ?>

    <?php // echo $form->field($model, 'id_concelho') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
