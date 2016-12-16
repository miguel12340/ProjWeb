<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Concelhos */

$this->title = $model->id_concelhos;
$this->params['breadcrumbs'][] = ['label' => 'Concelhos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="concelhos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_concelhos], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_concelhos], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_concelhos',
            'nome_concelhos',
            'ce_id_distritos',
        ],
    ]) ?>

</div>
