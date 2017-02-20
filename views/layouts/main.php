<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\FaAssets;

FaAssets::register($this);
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

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels'=>false,
        'items' => [
            ['label' => '<i class="fa fa-home" aria-hidden="true"></i> Home', 'url' => ['/site/index']],
            ['label' => ' <i class="fa fa-info" aria-hidden="true"></i> About', 'url' => ['/site/about']],
            ['label' => ' <i class="fa fa-phone" aria-hidden="true"></i> Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => '<i class="fa fa-sign-in" aria-hidden="true"></i> Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    '<i class="fa fa-sign-out" aria-hidden="true"></i> Logout (' . Yii::$app->user->identity->login_id . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container" style="width: 100%;">

        <div style="float:left; width: 20%">
            <?php
                echo Nav::widget([
                    'options' => ['class' =>'nav-stacked','data-spy'=>"affix"],
                    'items' => [
                        [
                            'label' => 'Home',
                            'url' => ['site/index'],
                            'linkOptions' => [""],
                        ],
                        [
                            'label' => 'Dropdown',
                        ],
                        ['label' =>'OPTION 1'],
                        ['label' =>'OPTION 2'],
                        ['label' =>'OPTION 3'],
                        ['label' =>'OPTION 4'],
                    ],
                ]);

            ?>
        </div>
        <div style="float:right; width: 80%">
            <?php echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>            
        </div>
        
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
