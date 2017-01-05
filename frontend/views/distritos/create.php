<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Distritos */

$this->title = 'Create Distritos';
$this->params['breadcrumbs'][] = ['label' => 'Distritos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="distritos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
