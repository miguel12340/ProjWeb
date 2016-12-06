<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class HomeCest
{
    public function checkOpen(FunctionalTester $I)
    {
        $I->amOnPage(\Yii::$app->homeUrl);
        $I->see('Qwartus');
        $I->seeLink('About');
        $I->click('About');
        $I->see('é o website que lhe permite encontrar o seu quarto ao melhor preço.');
    }
}