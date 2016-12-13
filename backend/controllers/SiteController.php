<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

use app\models\User;
use backend\models\UpdateUserForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'musers'],
                        'allow' => true,
                        'roles' => ['@'],// -> o '@' significa só os users autenticados
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionMusers()
    {
        $users = User::find()->all();

        $modelUpdateUser = new UpdateUserForm();
        if ($modelUpdateUser->load(Yii::$app->request->post()) && $modelUpdateUser->validate()) {
            if ($modelUpdateUser->update()) {
                Yii::$app->session->setFlash('success', '1 User foi Actualizado com sucesso!!');

                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Erro, 1 User não foi Actualizado.');
            }
        }

        return $this->render('musers', [
                'users' => $users,
                'modelUpdateUser' => $modelUpdateUser,
            ]);

    }

}
