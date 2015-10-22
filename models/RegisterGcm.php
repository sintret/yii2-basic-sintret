<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "register_gcm".
 *
 * @property integer $id
 * @property string $gcm_regid
 * @property string $name
 * @property string $email
 * @property string $updateDate
 */
class RegisterGcm extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'register_gcm';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['updateDate'], 'safe'],
            [['gcm_regid', 'name'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'gcm_regid' => 'Gcm Regid',
            'name' => 'Name',
            'email' => 'Email',
            'updateDate' => 'Update Date',
        ];
    }

    public static function ids($email = NULL) {
        $return = [];

        if ($email) {
            $models = static::find()->where(['email' => $email])->all();
        } else {
            $models = static::find()->all();
        }
        if ($models) {
            foreach ($models as $model) {
                $return[] = $model->gcm_regid;
            }
        }

        return $return;
    }

}
