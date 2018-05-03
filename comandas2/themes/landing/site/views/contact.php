<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'En contacto';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-contact" style="min-height: 100%;">
    <div id="contact" name="contact">
        <div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 centered">

            <h1><?= Html::encode($this->title) ?></h1>

            <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

                <div class="alert alert-success">
                    Gracias por contactarse con nosotros. Le responderemos a la brevedad.
                    <a href="/">Volver a la página principal</a>
                </div>

            <?php else: ?>

                <p>Dejanos tus dudas o comentarios y nos pondremos en contacto con tigo</p>

                        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                            <?= $form->field($model, 'name')->textInput(['placeholder' => 'Nombre'])->label(false) ?>

                            <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email'])->label(false) ?>

                            <?= $form->field($model, 'subject')->textInput(['placeholder' => 'Asunto'])->label(false) ?>

                            <?= $form->field($model, 'body')->textarea(['rows' => 6, 'placeholder' => 'Mensaje'])->label(false) ?>

                            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                            ])->label(false) ?>

                            <div class="form-group">
                                <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                            </div>

                        <?php ActiveForm::end(); ?>

            <?php endif; ?>
        </div>
    </div>
        </div>
    </div>
</div>
