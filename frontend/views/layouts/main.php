<?php

    /* @var $this \yii\web\View */
    /* @var $content string */

    use yii\helpers\Html;
    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;
    use yii\widgets\Breadcrumbs;
    use frontend\assets\AppAsset;
    use common\widgets\Alert;

    AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

    <?php if (Yii::$app->user->isGuest) { ?>
            <div class="wrap">
    <?php }else { ?>
            <div class="wrap-user">
    <?php } ?>
        <?php
        NavBar::begin([
            'brandLabel' => Html::img('../web/images/qwartus.png', array('height'=>'30'), ['alt'=>Yii::$app->name]),
            'brandUrl' => Yii::$app->user->isGuest ? Yii::$app->homeUrl : ['/site/perfil'],
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        if (Yii::$app->user->isGuest) {
            $menuItems = [
                ['label' => 'Inicio', 'url' => ['/site/index']],
                ['label' => 'Procurar', 'url' => ['/site/search']],
                ['label' => 'About', 'url' => ['/site/about']],
                ['label' => 'Contact', 'url' => ['/site/contact']],
                ['label' => 'Sign Up', 'url' => ['/site/signup']],
                ['label' => 'Login', 'url' => ['/site/login']],
            ];
        }else {
            $menuItems = [
                ['label' => 'Perfil', 'url' => ['/site/perfil']],
                ['label' => 'Procurar', 'url' => ['/site/search']],
                ['label' => 'Contact', 'url' => ['/site/contact']],
            ];
            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
    
    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; Qwartus <?= '2016 - '.date('Y') ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
