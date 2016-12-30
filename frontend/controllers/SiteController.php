<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

    use frontend\models\SearchForm;
    use yii\data\Pagination;
    use app\models\Anuncio;
    use app\models\Anuncios;
    use app\models\Distritos;
    use app\models\Concelhos;
    use yii\helpers\Html;

    use frontend\models\CreateAnuncio;
    use frontend\models\UpdateAnuncio;
    use frontend\models\UpdateUser;
    use yii\web\UploadedFile;

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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest){
            return $this->render('index');
        }else {
            //Busca os anuncios do utilizador
            $anuncios = Anuncio::find()
                            ->where(['ce_id_user' => Yii::$app->user->identity->id])
                            ->all();

            $update = new UpdateUser();
            $create = new CreateAnuncio();
            $update_anuncio = new UpdateAnuncio();
            if ($update->load(Yii::$app->request->post())) {
                $update->imagem = UploadedFile::getInstance($update, 'imagem');// --> Busca a imagem que foi uploaded
                if ($update->updateUser()) {
                    Yii::$app->session->setFlash('success', 'Atualizou o Perfil com Sucesso!!.');
                    return $this->refresh();
                }else {
                    Yii::$app->session->setFlash('error', 'Alguma Coisa Correu Mal, Por Favor Contate-nos.');
                }
            }
            if ($create->load(Yii::$app->request->post())) {
                $create->imagens = UploadedFile::getInstances($create, 'imagens');
                if ($create->createAnuncio()) {
                    Yii::$app->session->setFlash('success', 'Parabéns Criou um Novo Anuncio.');
                    return $this->refresh();
                }else {
                    Yii::$app->session->setFlash('error', 'Alguma Coisa Correu Mal, Por Favor Contate-nos.');
                }
            }
            if ($update_anuncio->load(Yii::$app->request->post())) {
                $update_anuncio->imagens = UploadedFile::getInstances($update_anuncio, 'imagens');
                if ($update_anuncio->updateAnuncio()) {
                    Yii::$app->session->setFlash('success', 'Parabéns o Anuncio foi Atualizado.');
                    return $this->refresh();
                }else {
                    Yii::$app->session->setFlash('error', 'Alguma Coisa Correu Mal, Por Favor Contate-nos.');
                }
            }

            return $this->render('index',[
                    'anuncios' => $anuncios,
                    'update' => $update,
                    'create' => $create,
                    'update_anuncio' => $update_anuncio,
                ]);
        }

    }

    /**
     * Logs in a user.
     *
     * @return mixed
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
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Displays search page.
     *
     * @return mixed
     */
    public function actionSearch()
    {

        $model = new SearchForm();
        if ($model->load(Yii::$app->request->post())) {

            $anunciosp = Anuncio::find()
                            ->where(['id_distrito' => $model->distritos])
                            ->andWhere(['id_concelho' => $model->concelhos])
                            ->andWhere(['status' => 'not suspended'])
                            ->all();

            return $this->render('search', [
                'model' => $model,
                'anunciosp' => $anunciosp,
            ]);

        }else {

            $anuncios = Anuncio::find()
                            ->where(['status'=>'not suspended'])
                            ->all();

            return $this->render('search', [
                'model' => $model,
                'anuncios' => $anuncios,
            ]);

        }
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }


}
