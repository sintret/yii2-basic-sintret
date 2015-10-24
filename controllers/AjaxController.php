<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class AjaxController extends Controller {

    public $enableCsrfValidation = false;

    public function actionSendChat() {
        if (!empty($_POST)) {
            echo \sintret\chat\ChatRoom::sendChat($_POST);
            $message = Yii::$app->user->identity->username . ' : ' . $_POST['message'];
            $pos = strpos($message, "@");
            $setting = \app\models\Setting::findOne(1);
            if ($pos !== FALSE) {
               // $w = new WhatsApp($number, $app, $password);
                $usernameSendgrid = $setting->sendgridUsername;
                $passwordSendgrid = $setting->sendgridPassword;
                $users = \app\models\User::find()->where(['status' => \app\models\User::STATUS_ACTIVE])->all();
                foreach ($users as $model) {
                    $aprot = '@' . strtolower($model->username);
                    if (strpos($message, $aprot) !== false) {
                        $sendgrid = new \SendGrid($usernameSendgrid, $passwordSendgrid, array("turn_off_ssl_verification" => true));
                        $email = new \SendGrid\Email();
                        $email->addTo($model->email)->
                                setFrom($setting->emailSupport)->
                                setSubject('Chat from ' . $setting->applicationName)->
                                setHtml($message);
                        $sendgrid->send($email);
                    } else {
                        
                    }
                }
            }
        }
    }

    public function actionTodolist() {
        $id = (int) $_POST['id'];
        $title = $_POST['title'];
        $type = (int) $_POST['type'];
        if ($id) {
            $model = \sintret\todolist\models\ToDoList::findOne($id);
            $model->status = 1;
            $model->save();
        } elseif ($title) {
            $model = new \sintret\todolist\models\ToDoList();
            $model->title = $title;
            $model->userId = Yii::$app->user->id;
            if ($model->save()) {
                echo $model->data();
            }
        } elseif (isset($_POST['type'])) {
            $model = new \sintret\todolist\models\ToDoList();
            echo $model->data($type);
        } else {
            $model = new \sintret\todolist\models\ToDoList();
            echo $model->data();
        }
    }
}
