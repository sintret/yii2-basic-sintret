<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Chat */

$this->title = 'Create Chat';
$this->params['breadcrumbs'][] = ['label' => 'Chats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chat-create">

    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
