<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Concelhos */

$this->title = 'Update Concelhos: ' . $model->id_concelhos;
$this->params['breadcrumbs'][] = ['label' => 'Concelhos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_concelhos, 'url' => ['view', 'id' => $model->id_concelhos]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="concelhos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
