<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'admin_sex')->textInput() ?>

    <?= $form->field($model, 'admin_nickname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'admin_status')->textInput() ?>

    <?= $form->field($model, 'admin_tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_wechat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_alipay')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'admin_pass')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'admin_type')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
