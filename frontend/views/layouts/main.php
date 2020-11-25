<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use app\models\AuthAssignment;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<section class="content">
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    // $menuItems = [
    //     ['label' => 'Home', 'url' => ['/site/index']],
    //     ['label' => 'Template', 'url' => ['/template']],
    //     ['label' => 'Center', 'url' => ['/template']],
    //     ['label' => 'Pricing', 'url' => ['/pricing']],
    //     ['label' => 'Patient Entry', 'url' => ['/patient-entry']],
    // ];
    if (Yii::$app->user->isGuest) {
        // $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
         $authAssignment = new AuthAssignment();
         $role = $authAssignment->getRole();
         if($role == "Admin") {
            $menuItems = [
            // ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Patient Entries', 'url' => ['/patient-entry']],
            ['label' => 'Templates', 'url' => ['/template']],
            ['label' => 'Centers', 'url' => ['/center']],
            ['label' => 'Franchises', 'url' => ['/franchises']],
            ['label' => 'Pricing', 'url' => ['/pricing']],
            ['label' => 'Users', 'url' => ['/employee']],
            // ['label' => 'Reports', 'url' => ['/report/options']],
            ['label' => 'Reports', 'items' => [
                                ['label' => 'Franchise Reports', 'url' => ['/report/index']],
                                ['label' => 'Typist Reports', 'url' => ['/report/typist']],
                            ]
            ],
            // ['label' => 'T Reports', 'url' => ['/report/typist']],
            
        ];
        
    }
        else
        $menuItems = [
            // ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Patient Entry', 'url' => ['/patient-entry']],
            ['label' => 'Report', 'url' => ['/report']],

            // ['label' => 'Template', 'url' => ['/template']],
            // ['label' => 'Center', 'url' => ['/center']],
            // ['label' => 'Pricing', 'url' => ['/pricing']],
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
</section>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right">
            <!-- <?//= Yii::powered() ?> -->
            Powered By: <a href="#"> GRATICARE </a>
        </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<style>
    /* footer {
       position: absolute;
       bottom: 0;
        } */
</style>