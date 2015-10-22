<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "log_upload".
 *
 * @property integer $id
 * @property integer $userId
 * @property string $title
 * @property string $filename
 * @property string $fileori
 * @property string $params
 * @property string $values
 * @property string $warning
 * @property string $keys
 * @property integer $type
 * @property integer $userCreate
 * @property integer $userUpdate
 * @property string $updateDate
 * @property string $createDate
 */
class LogUpload extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log_upload';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'type', 'userCreate', 'userUpdate'], 'integer'],
            [['params', 'values', 'warning', 'keys'], 'string'],
            [['updateDate', 'createDate'], 'safe'],
            [['title', 'filename', 'fileori'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => 'User ID',
            'title' => 'Title',
            'filename' => 'Filename',
            'fileori' => 'Fileori',
            'params' => 'Params',
            'values' => 'Values',
            'warning' => 'Warning',
            'keys' => 'Keys',
            'type' => 'Type',
            'userCreate' => 'User Create',
            'userUpdate' => 'User Update',
            'updateDate' => 'Update Date',
            'createDate' => 'Create Date',
        ];
    }
    
        
}
