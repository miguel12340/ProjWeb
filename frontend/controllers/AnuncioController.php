<?php 

	namespace frontend\controllers;

	use Yii;
	use yii\web\Controller;

	use yii\helpers\Html;

	use app\models\Anuncio;
	use app\models\Distritos;
	use app\models\Concelhos;
	use common\models\User;

	/**
	* 
	*/
	class AnuncioController extends Controller
	{
		/**
		 * Suspender Anuncio
		 */
		public function actionSuspender($id_anuncio)
		{
			
			// -> Busca o anuncio
				$anuncio = Anuncio::findOne($id_anuncio);

			// -> Altera o campo satus para - suspended
				$anuncio->status = 'suspended';

			if ($anuncio->save()) {
				Yii::$app->session->setFlash('success', 'O Anuncio foi suspendido!!');
				return $this->redirect(['/site/perfil']);
			}else {
				Yii::$app->session->setFlash('error', 'Alguma Coisa Correu Mal, Por Favor Contate-nos.');
				return $this->redirect(['/site/perfil']);
			}

		}
		/**
		 * Ativar Anuncio
		 */
		public function actionAtivar($id_anuncio)
		{
			
			// -> Busca o anuncio
				$anuncio = Anuncio::findOne($id_anuncio);

			// -> Altera o campo satus para - suspended
				$anuncio->status = 'not suspended';

			if ($anuncio->save()) {
				Yii::$app->session->setFlash('success', 'O Anuncio foi Ativado!!');
				return $this->redirect(['/site/perfil']);
			}else {
				Yii::$app->session->setFlash('error', 'Alguma Coisa Correu Mal, Por Favor Contate-nos.');
				return $this->redirect(['/site/perfil']);
			}

		}
		/**
		 * Eliminar Anuncio
		 */
		public function actionEliminar($id_anuncio)
		{
			
			// -> Busca o anuncio
				$anuncio = Anuncio::findOne($id_anuncio);

			if ($anuncio->delete()) {	//-> Apaga o Anuncio
				Yii::$app->session->setFlash('success', 'O Anuncio foi Eliminado!!');
				return $this->redirect(['/site/perfil']);
			}else {
				Yii::$app->session->setFlash('error', 'Alguma Coisa Correu Mal, Por Favor Contate-nos.');
				return $this->redirect(['/site/perfil']);
			}

		}
		/**
		 * Vai para a página do Anúncio
		 */
		public function actionVer($id_anuncio)
		{			
				$anuncio = Anuncio::findOne($id_anuncio);			//->Busca o Anuncio
				$dis = Distritos::findOne($anuncio->id_distrito);	//->Busca o Distrito
				$con = Concelhos::findOne($anuncio->id_concelho);	//->Busca o Concelho
				$user = User::findOne($anuncio->ce_id_user);		//->Busca o User

			return $this->render('ver',[
					'anuncio'=>$anuncio,
					'dis'=>$dis,
					'con'=>$con,
					'user'=>$user,
				]);
		}

	}


 ?>