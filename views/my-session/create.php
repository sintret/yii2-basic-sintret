<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MySession */

$this->title = 'Create My Session';
$this->params['breadcrumbs'][] = ['label' => 'My Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="my-session-create">

    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
