<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Distritos */

$this->title = 'Update Distritos: ' . $model->id_distritos;
$this->params['breadcrumbs'][] = ['label' => 'Distritos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_distritos, 'url' => ['view', 'id' => $model->id_distritos]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="distritos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
