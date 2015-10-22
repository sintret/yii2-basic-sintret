<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use kartik\widgets\FileInput;
use kartik\widgets\SwitchInput;
use mihaildev\ckeditor\CKEditor;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Test */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="test-form">

    <?php     $form = ActiveForm::begin([
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'options' => ['enctype' => 'multipart/form-data']   // important, needed for file upload
    ]);?>


            <div class="row">
        <div class="col-md-6">
        <?php
                    $plugins = ["options"=>["accept"=>"image/*"]];
                    if ($model->image) {
                        $plugins = [
                                "options"=>["accept"=>"image/*"],
                                "pluginOptions" => ["initialPreview" => [kartik\helpers\Html::img($model->thumbnailTrue, ["class" => "file-preview-image"])]]
                                ];
                     }
                    echo $form->field($model, "image")->widget(FileInput::classname(),$plugins);
                    ?>        </div>

        <div class="col-md-6">
        
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, "description")->widget(CKEditor::className(), ["editorOptions" => [ "preset" => "full", "inline" => false]]);?>        </div>

    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

        <?php ActiveForm::end(); ?>

</div>
