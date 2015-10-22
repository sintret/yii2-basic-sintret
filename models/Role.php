<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property integer $id
 * @property string $name
 * @property string $params
 *
 * @property Access[] $accesses
 */
class Role extends \yii\db\ActiveRecord {

    public $role_name;
    public static $methods = ['create', 'update', 'index', 'view', 'parsing-log', 'excel', 'parsing','sample', 'delete', 'delete-all'];
    public static $controllers = [
        'Log-Upload', 'Setting', 'Notification', 'User','Chat','Role','Test'
    ];

    public static function accessFilter() {
        $return = [];
        foreach (self::$controllers as $v) {
            $return[$v] = self::$methods;
        }

        //custom filter using join array here...

        return $return;
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'role';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['params'], 'string'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'params' => 'Params',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccesses() {
        return $this->hasMany(Access::className(), ['roleId' => 'id']);
    }

    public static function dropdown() {
        $models = static::find()->all();
        foreach ($models as $model) {
            $dropdown[$model->id] = $model->name;
        }
        return $dropdown;
    }

}
