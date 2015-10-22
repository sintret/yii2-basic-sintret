<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $description
 * @property integer $userCreate
 * @property integer $userUpdate
 * @property string $createDate
 * @property string $updateDate
 */
class Test extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'test';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['description'], 'string'],
            [['userCreate', 'userUpdate'], 'integer'],
            [['createDate', 'updateDate'], 'safe'],
            [['name', 'image'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'jpg,png,gif'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'image' => 'Image',
            'description' => 'Description',
            'userCreate' => 'User Create',
            'userUpdate' => 'User Update',
            'createDate' => 'Create Date',
            'updateDate' => 'Update Date',
        ];
    }

    public static $imagePath = '@webroot/images/test/';

    public function getImageTrue() {
        if ($this->image) {
            return Yii::getAlias($this->image);
        }
    }

    public function getThumbnailTrue() {
        if ($this->image) {
            $name = \yii\helpers\StringHelper::basename($this->image);
            $dir = \yii\helpers\StringHelper::dirname($this->image);
            return Yii::getAlias($dir . '/thumb/' . $name);
        }
    }

    public function getThumb() {
        if ($this->thumbnailTrue) {
            return \yii\helpers\Html::img($this->thumbnailTrue, ['width' => '100px']);
        }
    }

    public function behaviors() {
        return [
            'image' => [
                'class' => \sintret\gii\components\CropBehavior::className(),
                'paths' => self::$imagePath . '{id}/',
                'width' => 200,
            ],
        ];
    }

}
