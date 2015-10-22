<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "my_session".
 *
 * @property integer $id
 * @property integer $expire
 * @property string $data
 */
class MySession extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'my_session';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['expire'], 'integer'],
            [['data'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'expire' => 'Expire',
            'data' => 'Data',
        ];
    }
    
        
}
