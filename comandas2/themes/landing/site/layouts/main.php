<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

$bundle = \app\assets\LandingAsset::register($this);

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <?= Html::csrfMetaTags() ?>
    <title><?php echo Html::encode(Yii::$app->name); ?></title>
    <?php $this->head() ?>

    <script type="text/javascript" src="<?= $bundle->baseUrl?>/js/modernizr.custom.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body data-spy="scroll" data-offset="0" data-target="#navbar-main">

<?php $this->beginBody() ?>
<div id="navbar-main">
    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <a class="navbar-brand" href="#home"><i class="fa fa-leaf"></i> <?php echo Html::encode(Yii::$app->name); ?></a> </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li> <a href="#home" class="smoothScroll">Inicio</a></li>
                    <li> <a href="#about" class="smoothScroll">Nosotros</a></li>
                    <li> <a href="#services" class="smoothScroll">¿De qué se trata?</a></li>
                    <li> <a href="#team" class="smoothScroll">Equipo</a></li>
                    <li> <a href="#contact" class="smoothScroll">Contacto</a></li>
                    <li> <a href="/admin/user/login">Login</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>

<?= $content; ?>

<div id="footerwrap">
    <div class="container">
        <div class="row">
            <div class="col-md-8"> <span  class="copyright">Copyright &copy; 2018 Software desarrollado por <a href="http://www.sofar.com.ar" target="_blank" rel="nofollow">SoFar Desarrollos</a></span> </div>
            <div class="col-md-4">
                <ul class="list-inline social-buttons">
                    <li><a href="https://www.facebook.com/sofar.desarrollos/" target="_blank"><i class="fa fa-facebook"></i></a> </li>
                    <li><a href="https://www.linkedin.com/company/25053610/" target="_blank"><i class="fa fa-linkedin"></i></a> </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>