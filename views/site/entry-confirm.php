<?php
use yii\helpers\Html;
?>
<p>You have entered the following information:</p>
<ul>
<li><label>First Name</label>: <?= Html::encode($model->fname) ?></li>
<li><label>Last Name</label>: <?= Html::encode($model->lname) ?></li>
<li><label>Email</label>: <?= Html::encode($model->email) ?></li>
<li><label>Marks</label>: <?= Html::encode($model->marks) ?></li>
<li><label>Status</label>: <?= Html::encode($model->status) ?></li>
</ul>