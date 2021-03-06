<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * CController base on all access controllers dynamic
 */
class CController extends Controller {

    public $user;

    public function init() {
        parent::init();
    }

    public function beforeAction($action) {
        $actionId = $action->id;
        $method = strtolower(Yii::$app->controller->id);
        $actionMethod = $method . '.' . $actionId;

        if (in_array($actionMethod, self::fieldsArray())) {
            if ($this->accessMenu($actionMethod))
                return true;
            else {
                if (Yii::$app->user->id) {
                    $this->redirect(Url::to(['webadmin/403']));
                    return false;
                    exit(0);
                } else {
                    $this->redirect(Url::to(['site/login']));
                }
            }
        } else {
            $this->redirect(Url::to(['site/login']));
        }
        parent::beforeAction($action);
    }

    public function accessMenu($name) {
        $parts = explode(".", $name);
        $access = self::checkAccess($name, Yii::$app->user->identity->roleId);

//        echo $access;
//        echo Yii::$app->user->identity->roleId; exit(0);
        if (Yii::$app->user->id) {
            if (Yii::$app->user->id == -1)
                return true;
            else
                return $access;
        } else
            return false;
    }

    public static function checkAccess($name, $roleId) {
        $parts = explode(".", $name);
        return \app\models\Access::find()->where([
                    'roleId' => $roleId,
                    'LOWER(controller)' => strtolower($parts[0]),
                    'LOWER(method)' => strtolower($parts[1])])->exists();
    }

    public static function accessTo($name) {
        return self::checkAccess($name, Yii::$app->user->identity->roleId);
    }

    public static function checkManyAccess($array, $roleId) {
        $return = 0;
        if ($array)
            foreach ($array as $v) {
                if (self::checkAccess($v, $roleId)) {
                    $return +=1;
                }
            }

        return $return;
    }

    public static function fieldsArray() {
        $fields = \app\models\Role::accessFilter();
        $return = [];
        foreach ($fields as $keys => $values) {
            foreach ($values as $k => $v) {
                $return[] = strtolower($keys) . '.' . $v;
            }
        }
        return $return;
    }

    public function accessUser($name) {
        if (Yii::$app->user->id) {
            $role = \yii\helpers\Json::decode(Yii::$app->user->identity->roles->params);
        } else
            return false;
    }

}
