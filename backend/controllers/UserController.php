<?php
    namespace backend\controllers;

    use Yii;
    use yii\web\Controller;
    use yii\filters\VerbFilter;
    use yii\filters\AccessControl;

    use app\models\User;
    use backend\models\UpdateUserForm;

    /**
     * Site controller
     */
    class UserController extends Controller
    {

        /**
         * Delete User by id
         */
        public function actionDelete($id)
        {
            $user = User::findOne($id);
            $user->delete();

            $this->redirect('index.php?r=site/musers');

        }

    }
