<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model app\models\entry */

$this->title = $model->fname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Entries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="entry-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'fname' => $model->fname], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'fname' => $model->fname], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,

        'attributes' => [
            'fname',
            'lname',
            'email:email',
            'marks',
            [
                'attribute'=>'status',
                // 'format' =>['html'],
                'value' => function ($model) {
                    $tmp= $model->status;
                    if($tmp==0){
                        return 'Active';
                    }
                    else {
                        return 'Inactive';
                    }
                },
            ],

            [
                'attribute'=>'image',
                 'format' =>['html'],
                'value' => function ($model) {
                  // $imgJpeg= $model->fname.'.'.'jpg';
                    return Html::img('@web/uploads/'.$model->image,
                    ['width'=>'100px','height'=>'100px'],['class' => 'pull-left img-responsive']);
                },
            ],

         ],

    ]) ?>

</div>