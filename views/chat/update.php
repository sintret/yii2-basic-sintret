<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Chat */

$this->title = 'Update Chat: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Chats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="chat-update">

    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
