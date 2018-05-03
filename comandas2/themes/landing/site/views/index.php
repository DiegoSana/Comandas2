<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

\app\assets\AppAsset::register($this);
$bundle = \app\assets\LandingAsset::register($this);
?>
<!-- ==== HEADERWRAP ==== -->
<div id="headerwrap" name="home">
    <iframe id="background" src="https://www.youtube.com/embed/wo2k24rJl30?rel=0&amp;controls=0&amp;showinfo=0&autoplay=1&mute=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    <!--<iframe id="background" src="https://www.youtube.com/embed/wo2k24rJl30?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>-->
    <!--<video autoplay loop muted poster="screenshot.jpg" controls="true" id="background">
        <source src="https://youtu.be/wo2k24rJl30" type="video/mp4">
    </video>-->
</div>
<!-- /headerwrap -->

<!-- ==== ABOUT ==== -->
<div id="about" name="about">
    <div class="container">
        <div class="row white">
            <h2 class="centered">Sobre nosotros</h2>
            <hr>
            <div class="col-md-6"> <img class="img-responsive" src="<?= $bundle->baseUrl?>/img/about/about1.jpg" align=""> </div>
            <div class="col-md-6">
                <h3>¿Quiénes somos?</h3>
                <p>Somos una empresa joven con un equipo experimentado. Creemos en el poder del mundo digital y sabemos como manejarlo. Esta aplicación es uno de los tantos trabajos que realizamos en <a href="http://www.sofar.com.ar">SofAr Desarrollos</a>. Te invitamos a que nos visites.</p>
                <h3>¿Por qué elegirnos?</h3>
                <p>Nuestra política de trabajo es de mejoras continuas y creamos soluciones a medida evaluando las necesidades de cada establecimiento en particular.</p>
            </div>
        </div>
        <!-- row -->
    </div>
</div>
<!-- container -->

<!-- ==== SERVICES ==== -->
<div id="services" name="services">
    <div class="container">
        <div class="row">
            <h2 class="centered">¿De qué se trata?</h2>
            <hr>
            <div class="col-lg-10 col-lg-offset-1">
                <h3 class="large">La aplicación, le permite a tus comensales ver el menú en sus dispositivos móbiles. En este momento los invitamos a segirte en las redes sociales y compartir lo que estan disfrutando en tu establecimiento.</b></h3>
                <h3 class="large">Ganá seguidores y luego ellos verán tus posteos en las redes y recordarán tu lugar.<h3/>
            </div>
            <hr>
            <div class="col-lg-3 callout"> <i class="fa fa-gears fa-3x"></i>
                <h3>Autoadministrable</h3>
                <p>Accediendo a la plataforma, podrás configurar tu menú (categorías, productos, fotos, videos, precios, etc.) asi como las características de diseño, imágenes y videos que quieras mostrar.</p>
            </div>
            <div class="col-lg-3 callout"> <i class="fa fa-share-alt fa-3x"></i>
                <h3>Redes sociales</h3>
                <p>Cada sección de la aplicación, tiene un llamados a integración con redes sociales. Tanto para que compartan lo que estan disfrutando como para invitarlos a seguirte en tus redes sociales.</p>
            </div>
            <div class="col-lg-3 callout"> <i class="fa fa-globe fa-3x"></i>
                <h3>No requiere instalación</h3>
                <p>La aplicación no requiere instalación por parte de los comensales. Solo basta con tener acceso a internet y entrar a la web de tu establecimiento. Por ejemplo: menu.tuestablecimiento.com</p>
            </div>
            <div class="col-lg-3 callout"> <i class="fa fa-dot-circle-o fa-3x"></i>
                <h3>Mejora continua</h3>
                <p>Actualmente el sistema se encuentra en una etapa inicial. Estamos desarrollando nuevas funcionalidades como cupones de descuento por cantidad de consumo y pedidos desde la aplicación.</p>
            </div>

        </div>
        <!-- row -->
    </div>
</div>
<!-- container -->


<!-- ==== TEAM MEMBERS ==== -->
<div id="team" name="team">
    <div class="container">
        <div class="row centered">
            <h2 class="centered">Nuestro equipo</h2>
            <hr>
            <div class="col-lg-6 centered"> <img class="img img-circle" src="<?= $bundle->baseUrl?>/img/team/team02.jpg" height="120px" width="120px" alt="">
                <h4>Diego Sanabria</h4>
                <p>Fundador y responsable tecnico.</p>
                <a href="https://www.linkedin.com/in/diegohsanabria/" target="_blank"><i class="fa fa-linkedin"></i></a> </div>
            <div class="col-lg-6 centered"> <img class="img img-circle" src="<?= $bundle->baseUrl?>/img/team/team01.jpg" height="120px" width="120px" alt="">
                <h4>María Pia Sanabria</h4>
                <p>Responsable del area de arte e imágen</p>
                <a href="https://www.linkedin.com/in/p%C3%ADa-sanabria-12b29311b/" target="_blank"><i class="fa fa-linkedin"></i></a>
            </div>
        </div>
    </div>
    <!-- row -->
</div>
<!-- container -->

<!-- ==== CONTACT ==== -->
<div id="contact" name="contact">
    <div class="container">
        <div class="row">
            <h2 class="centered">Contactanos</h2>
            <hr>
            <div class="col-md-4 centered"> <i class="fa fa-map-marker fa-2x"></i>
                <p>San Carlos de Bariloche<br>
                    Río Negro, Argentina</p>
            </div>
            <div class="col-md-4"> <i class="fa fa-envelope-o fa-2x"></i>
                <p>info.comandas@gmail.com</p>
            </div>
            <div class="col-md-4"> <i class="fa fa-phone fa-2x"></i>
                <p> +54 911 6105 6636</p>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 centered">
                <?php \yii\widgets\Pjax::begin()?>
                <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

                    <div class="alert alert-success">
                        Gracias por contactarse con nosotros. Le responderemos a la brevedad
                    </div>

                <?php else: ?>

                    <p>Dejanos tus dudas o comentarios y nos pondremos en contacto con tigo</p>

                    <?php $form = ActiveForm::begin(['id' => 'contact-form', 'action' => '/site/contact', 'options' => ['data-pjax' => true]]); ?>

                    <?= $form->field($model, 'name')->textInput(['placeholder' => 'Nombre'])->label(false) ?>

                    <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email'])->label(false) ?>

                    <?= $form->field($model, 'subject')->textInput(['placeholder' => 'Asunto'])->label(false) ?>

                    <?= $form->field($model, 'body')->textarea(['rows' => 6, 'placeholder' => 'Mensaje'])->label(false) ?>

                    <?= $form->field($model, 'reCaptcha')->widget(
                        \himiklab\yii2\recaptcha\ReCaptcha::className(),
                        ['siteKey' => '6LfsHFUUAAAAAPtsZCGchb25fSUmzTtgL6-alorR']
                    )->label(false) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary pull-right', 'name' => 'contact-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                <?php endif; ?>
                <?php \yii\widgets\Pjax::end();?>
            </div>
        </div>
    </div>
</div>
<!-- container -->