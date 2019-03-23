<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Entries');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entry-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Entry'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
                    return Html::img('@web/uploads/'.$model->image,
                        ['width'=>'100px','height'=>'100px'],['class' => 'pull-left img-responsive']);
                },
            ],

            [

                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, $model, $key, $index) {
                return Url::to(['entry/'.$action, 'fname' => $model->fname]);

                }
            ],
        ],
    ]); ?>
</div>
