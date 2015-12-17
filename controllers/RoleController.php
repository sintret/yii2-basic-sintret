<?php

namespace app\controllers;

use Yii;
use app\models\Role;
use app\models\RoleSearch;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use sintret\gii\models\LogUpload;
use sintret\gii\components\Util;

/**
 * RoleController implements the CRUD actions for Role model.
 */
class RoleController extends CController {

    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
//                    [
//                        'allow' => true,
//                        'actions' => ['index','view','sample','parsing-log','excel'],
//                        'roles' => ['viewer']
//                    ],
//                    [
//                        'allow' => true,
//                        'actions' => ['create','parsing'],
//                        'roles' => ['author']
//                    ],
//                    [
//                        'allow' => true,
//                        'actions' => ['update'],
//                        'roles' => ['editor']
//                    ],
//                    [
//                        'allow' => true,
//                        'actions' => ['delete', 'delete-all'],
//                        'roles' => ['admin']
//                    ],
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $methods = Role::$methods;
        $fields = Role::accessFilter();
        $controllers = Role::$controllers;

        $roleId = isset($_GET['roleId']) == null ? 1 : $_GET['roleId'];
        $model = $this->findModel($roleId);
        $model->role_name = $roleId;

        //echo '<pre>';print_r($_POST['Roles']); exit(0);
        if ($model->load(Yii::$app->request->post())) {
            \app\models\Access::deleteAll('roleId = :roleId', [':roleId' => $roleId]);
            foreach ($_POST['Roles'] as $keys => $values) {
                foreach ($values as $k => $v) {
                    //if($v=='on')
                    $sql .= ' INSERT INTO access (roleId,controller,method) values ("' . $roleId . '","' . $keys . '","' . $k . '"); ';
                }
            }

            if ($sql) {
                Yii::$app->db->createCommand($sql)->execute();
                Yii::$app->session->setFlash('success', 'Successfully, Update access role!');
            }
        }

        return $this->render('index', [
                    'model' => $model,
                    'methods' => $methods,
                    'fields' => $fields,
                    'controllers' => $controllers,
                    'roleId' => $roleId
        ]);
    }

    /**
     * Lists all Role models.
     * @return mixed
     */
    public function actionIndex2() {
        $grid = 'grid-' . self::className();
        $reset = Yii::$app->getRequest()->getQueryParam('p_reset');
        if ($reset) {
            \Yii::$app->session->set($grid, "");
        } else {
            $rememberUrl = Yii::$app->session->get($grid);
            $current = Url::current();
            if ($rememberUrl != $current && $rememberUrl) {
                Yii::$app->session->set($grid, "");
                $this->redirect($rememberUrl);
            }
            if (Yii::$app->getRequest()->getQueryParam('_pjax')) {
                \Yii::$app->session->set($grid, "");
                \Yii::$app->session->set($grid, Url::current());
            }
        }

        $searchModel = new RoleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Role model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Role model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Role();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Well done! successfully to save data!  ');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Role model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Well done! successfully to update data!  ');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Role model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Well done! successfully to deleted data!  ');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Role model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Role the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Role::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSample() {

        //$objPHPExcel = new \PHPExcel();
        $template = Util::templateExcel();
        $model = new Role;
        $date = date('YmdHis');
        $name = $date . 'Role';
        //$attributes = $model->attributeLabels();
        $models = Role::find()->all();
        $excelChar = Util::excelChar();
        $not = Util::excelNot();

        foreach ($model->attributeLabels() as $k => $v) {
            if (!in_array($k, $not)) {
                $attributes[$k] = $v;
            }
        }

        $objReader = \PHPExcel_IOFactory::createReader('Excel5');
        $objPHPExcel = $objReader->load(Yii::getAlias($template));

        return $this->render('sample', ['models' => $models, 'attributes' => $attributes, 'excelChar' => $excelChar, 'not' => $not, 'name' => $name, 'objPHPExcel' => $objPHPExcel]);
    }

    public function actionParsing() {
        $num = 0;
        $fields = [];
        $values = [];
        $log = '';
        $route = '';
        $model = new LogUpload;

        $date = date('Ymdhis') . Yii::$app->user->identity->id;

        if (Yii::$app->request->isPost) {
            $model->fileori = UploadedFile::getInstance($model, 'fileori');

            if ($model->validate()) {
                $fileOri = Yii::getAlias(LogUpload::$imagePath) . $model->fileori->baseName . '.' . $model->fileori->extension;
                $filename = Yii::getAlias(LogUpload::$imagePath) . $date . '.' . $model->fileori->extension;
                $model->fileori->saveAs($filename);
            }
            $params = Util::excelParsing(Yii::getAlias($filename));
            $model->params = \yii\helpers\Json::encode($params);
            $model->title = 'parsing Role';
            $model->fileori = $fileOri;
            $model->filename = $filename;


            if ($params)
                foreach ($params as $k => $v) {
                    foreach ($v as $key => $val) {
                        if ($num == 0) {
                            $fields[$key] = $val;
                            $max = $key;
                        }

                        if ($num >= 3) {
                            $values[$num][$fields[$key]] = $val;
                        }
                    }
                    $num++;
                }
            if (in_array('id', $fields)) {
                $model->type = LogUpload::TYPE_UPDATE;
            } else {
                $model->type = LogUpload::TYPE_INSERT;
            }
            $model->keys = \yii\helpers\Json::encode($fields);
            $model->values = \yii\helpers\Json::encode($values);
            if ($model->save()) {
                $log = 'log_Role' . Yii::$app->user->id;
                Yii::$app->session->setFlash('success', 'Well done! successfully to Parsing data, see log on log upload menu! Please Waiting for processing indicator if available...  ');
                Yii::$app->session->set($log, $model->id);
                $notification = new \sintret\gii\models\Notification;
                $notification->title = 'parsing Role';
                $notification->message = Yii::$app->user->identity->username . ' parsing Role ';
                $notification->params = \yii\helpers\Json::encode(['model' => 'Role', 'id' => $model->id]);
                $notification->save();
            }
        }
        $route = 'role/parsing-log';

        return $this->render('parsing', ['model' => $model, 'log' => $log, 'route' => $route]);
    }

    public function actionParsingLog($id) {
        $mod = LogUpload::findOne($id);
        $type = $mod->type;
        $keys = \yii\helpers\Json::decode($mod->keys);
        $values = \yii\helpers\Json::decode($mod->values);
        $modelAttribute = new Role;
        $not = Util::excelNot();

        foreach ($values as $value) {
            if ($type == LogUpload::TYPE_INSERT)
                $model = new Role;
            else
                $model = Role::findOne($value['id']);

            foreach ($keys as $v) {
                $model->$v = $value[$v];
            }

            $e = 0;
            if ($model->save()) {
                $model = NULL;
                $pos = NULL;
            } else {
                $error[] = \yii\helpers\Json::encode($model->getErrors());
                $e = 1;
            }
        }

        if ($error) {
            foreach ($error as $err) {
                if ($err) {
                    $er[] = $err;
                    $e+=1;
                }
            }
            if ($e) {
                $mod->warning = \yii\helpers\Json::encode($er);
                $mod->save();
                echo '<pre>';
                print_r($er);
            }
        }
    }

    public function actionExcel() {
        $searchModel = new RoleSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $modelAttribute = new Role;
        $not = Util::excelNot();
        foreach ($modelAttribute->attributeLabels() as $k => $v) {
            if (!in_array($k, $not)) {
                $attributes[$k] = $v;
            }
        }

        $models = $dataProvider->getModels();
        $objReader = \PHPExcel_IOFactory::createReader('Excel5');
        $objPHPExcel = $objReader->load(Yii::getAlias(Util::templateExcel()));
        $excelChar = Util::excelChar();
        return $this->render('_excel', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'attributes' => $attributes,
                    'models' => $models,
                    'objReader' => $objReader,
                    'objPHPExcel' => $objPHPExcel,
                    'excelChar' => $excelChar
        ]);
    }

    public function actionDeleteAll() {
        $pk = Yii::$app->request->post('pk'); // Array or selected records primary keys
        $explode = explode(",", $pk);
        if ($explode)
            foreach ($explode as $v) {
                if ($v)
                    $this->findModel($v)->delete();
            }
        echo 1;
    }

}
