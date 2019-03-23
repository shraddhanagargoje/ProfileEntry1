<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
 <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>


<?= $form->field($model, 'fname') ?>
<?= $form->field($model, 'lname') ?>
<?= $form->field($model, 'email') ?>
<?= $form->field($model, 'imageFile')->fileInput() ?>
<?= $form->field($model, 'marks') ?>
<?= $form->field($model, 'status') ?>


<div class="form-group">
<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>