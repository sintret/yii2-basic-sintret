<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MySession */

$this->title = 'Update My Session: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'My Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="my-session-update">

    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
