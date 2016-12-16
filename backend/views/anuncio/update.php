<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Anuncio */

$this->title = 'Update Anuncio: ' . $model->id_anuncio;
$this->params['breadcrumbs'][] = ['label' => 'Anuncios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_anuncio, 'url' => ['view', 'id' => $model->id_anuncio]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="anuncio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
