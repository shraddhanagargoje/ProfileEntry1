<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\entry */

$this->title = Yii::t('app', 'Update Entry: {name}', [
    'name' => $model->fname,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Entries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fname, 'url' => ['view', 'fname' => $model->fname]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="entry-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,$model->image
    ]) ?>

</div>
