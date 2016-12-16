<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Concelhos */

$this->title = 'Create Concelhos';
$this->params['breadcrumbs'][] = ['label' => 'Concelhos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="concelhos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
