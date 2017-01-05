<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

    $this->title = 'Qwartus - Home';
?>

<div class="site-index">

    <div class="jumbotron">
        <h1>Qwartus</h1>
        <p>Onde os quartos estão á distância de um click!</p>
    </div>

    <div class="body-content" align="center">
        <div class="row">
            <div class="col-md-6">
                <p><?= Html::a('Regista-te', ['/site/signup'], ['class' => 'btn btn-primary btn-lg']) ?></p>
            </div>
            <div class="col-md-6">
                <p><?= Html::a('Pesquisa', ['/site/search'], ['class' => 'btn btn-primary btn-lg']) ?></p>
            </div>
        </div>
    </div>
</div>
