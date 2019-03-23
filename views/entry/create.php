<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\entry */
/* @var $form ActiveForm */
?>
<div class="entry-create">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])  ?>

        <?= $form->field($model, 'fname') ?>
        <?= $form->field($model, 'lname') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'image')->fileInput() ?>
        <?= $form->field($model, 'marks') ?>
    <?= $form->field($model, 'status')->dropDownList(["Active","Inactive"])?>

    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- entry-create -->
