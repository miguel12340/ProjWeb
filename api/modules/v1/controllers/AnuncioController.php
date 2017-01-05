<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;

class AnuncioController extends ActiveController
{
    public $modelClass = 'common\models\Anuncio';
}