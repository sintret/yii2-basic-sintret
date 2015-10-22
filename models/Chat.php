<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chat".
 *
 * @property integer $id
 * @property integer $userId
 * @property string $message
 * @property string $updateDate
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId'], 'required'],
            [['userId'], 'integer'],
            [['message'], 'string'],
            [['updateDate'], 'safe']
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
            'message' => 'Message',
            'updateDate' => 'Update Date',
        ];
    }
    
        
}
