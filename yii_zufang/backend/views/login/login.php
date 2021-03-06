<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\url;

$cookie = \Yii::$app->request->cookies;
/*$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;*/
?>
<!DOCTYPE html>
<html class="login-bg">
<head>
    <title>Detail Admin - Sign in</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- bootstrap -->
    <link href="static/css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="static/css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="static/css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="static/css/layout.css" />
    <link rel="stylesheet" type="text/css" href="static/css/elements.css" />
    <link rel="stylesheet" type="text/css" href="static/css/icons.css" />

    <!-- libraries -->
    <link rel="stylesheet" type="text/css" href="static/css/lib/font-awesome.css" />

    <!-- this page specific styles -->
    <link rel="stylesheet" href="static/css/compiled/signin.css" type="text/css" media="screen" />

    <!-- open sans font -->
    <link href='http://fonts.useso.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>
<!-- background switcher -->
<div class="bg-switch visible-desktop">
    <div class="bgs">
        <a href="#" data-img="landscape.jpg" class="bg active">
            <img src="static/img/bgs/landscape.jpg" />
        </a>
        <a href="#" data-img="blueish.jpg" class="bg">
            <img src="static/img/bgs/blueish.jpg" />
        </a>
        <a href="#" data-img="7.jpg" class="bg">
            <img src="static/img/bgs/7.jpg" />
        </a>
        <a href="#" data-img="8.jpg" class="bg">
            <img src="static/img/bgs/8.jpg" />
        </a>
        <a href="#" data-img="9.jpg" class="bg">
            <img src="static/img/bgs/9.jpg" />
        </a>
        <a href="#" data-img="10.jpg" class="bg">
            <img src="static/img/bgs/10.jpg" />
        </a>
        <a href="#" data-img="11.jpg" class="bg">
            <img src="static/img/bgs/11.jpg" />
        </a>
    </div>
</div>

<?= Html::beginForm(['login/index'], 'post', ['enctype' => 'multipart/form-data']) ?>

<div class="row-fluid login-wrapper">
    <a href="index.html">
        <img class="logo" src="static/img/logo-white.png" />
    </a>

    <div class="span4 box">
        <div class="content-wrap">
            <h6>Log in</h6>
            <input class="span12" type="text" name="name" placeholder="用户名" />
            <input class="span12" type="password" name="pwd" placeholder="密码" />
            <a href="#" class="forgot">Forgot password?</a>
            <div class="remember">
                <input id="remember-me" name="jizhu" type="checkbox" />
                <label for="remember-me">Remember me</label>
            </div>
            <?= Html::submitButton('Log in', ['class' => 'btn-glow primary login']) ?>
        </div>
    </div>

    <div class="span4 no-account">
        <p>Don't have an account?</p>
        <a href="signup.html">Sign up</a>
    </div>
</div>

<?= Html::endForm() ?>

<!-- scripts -->
<script src="static/js/jquery-latest.js"></script>
<script src="static/js/bootstrap.min.js"></script>
<script src="static/js/theme.js"></script>

<!-- pre load bg imgs -->
<script type="text/javascript">
    $(function () {
        // bg switcher
        var $btns = $(".bg-switch .bg");
        $btns.click(function (e) {
            e.preventDefault();
            $btns.removeClass("active");
            $(this).addClass("active");
            var bg = $(this).data("img");

            $("html").css("background-image", "url('static/img/bgs/" + bg + "')");
        });

    });
</script>

</body>
</html>