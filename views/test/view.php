<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Test */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-view no-print">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
                <?= Html::a('Create', ['create'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
                <?= Html::a('Print Qrcode', ['id' => 'print'], ['id' => 'print', 'class' => 'btn btn-default']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            ['attribute' => 'image','format' => 'image','value' => $model->thumbnailTrue],
                    'description:html',
                     [
                'attribute' => 'userCreate',
                'value' => Yii::$app->util->getUserId($model->userCreate)->username,
            ],
                    [
                'attribute' => 'userUpdate',
                'value' => Yii::$app->util->getUserId($model->userUpdate)->username,
            ],
            
                    [
                'attribute' => 'createDate',
                'value' => $model->createDate,
            ],
            
                    [
                'attribute' => 'updateDate',
                'value' => $model->updateDate,
            ],
                
                ]]) ;?>

</div>

<img id="imgqr" style="display: none" alt="Embedded Image" src="http://sintret.com/site/qrcode?text=<?php  echo $model->id; ?>&size=300&font-size=16&label=<?php  echo $this->title   ; ?>" />
<?php  $this->registerJs('$("#print").on("click", function(event ){
    $("#imgqr").show();
    event.preventDefault();
window.print();
});'); ?>