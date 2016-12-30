<?php

	/* @var $this yii\web\View */
	/* @var $form yii\bootstrap\ActiveForm */
	/* @var $model \frontend\models\SearchForm */

	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;

	use yii\helpers\ArrayHelper;
	use yii\helpers\Url;
	use app\models\Distritos;

	$this->title = 'Qwartus - Procurar';
	$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid site-search">

	<h1>Procura aqui o teu Quarto!!</h1>

<?php // Inicio do Formulario ?>
	<br><br>
	<div class="container-fluid">
		<div class="row">
			<?php $form = ActiveForm::begin(['id' => 'form-search',
											 'options' => [
											 	'class' => 'form-inline']
											]); ?>
				<div class="col-lg-5">
					<div class="form-group">
						<?= $form->field($model, 'distritos')->dropDownList(
													ArrayHelper::map(Distritos::find()->all(), 'id_distritos', 'nome_distritos'), 
													[
														'prompt' => '--- Seleciona o Distrito ---',
														'onchange' => '
															$.post("index.php?r=pesquisa/concelho&id='.'"+$(this).val(), function(data){
																$("select#searchform-concelhos").html(data);
															});'
													]); ?>
					</div>			
				</div>
				<div class="col-lg-5">
					<div class="form-group">
						<?= $form->field($model, 'concelhos')->dropDownList(array(),array('prompt' => '--- Seleciona o Concelho ---')); ?>
					</div>
				</div>
				<div class="form-group">
					<?= Html::submitButton('Procurar', ['class' => 'btn btn-primary', 'name' => 'search-button']) ?>
				</div>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
<?php // Fim do Formulario ?>
<br><br>
<?php // Inicio dos resultados ?>
		<div class="container-fluid">
			<h1>Resultados</h1>
			<div class="row">
				<ul>
				<?php if (isset($anunciosp)) { ?>
					<?php foreach ($anunciosp as $anunciop) { ?>
	                    	<div class="col-sm-6 col-md-4">
	                            <div class="thumbnail">
	                                	<?php //Html::img('data:image/png;base64,'.$anuncio->imagem0) ?>
	                                    <img src="data:image/png;base64,'.$anuncio->imagem0.'" alt="'.$anunciop->asunto.'">
	                                    <div class="caption">
	                                        <h3><?= $anunciop->asunto ?></h3>
	                                        <p><?= Html::encode("{$anunciop->descricao}") ?></p>
	                                        <p>
	                                            <a href="#" class="btn btn-primary" role="button">Ver Mais</a>
	                                            <a href="#" class="btn btn-default" role="button">Ver Contacto</a>
	                                        </p>
	                                    </div>
	                                </div>
	                            </div>
					<?php } ?>
				<?php }else { ?>
					<?php foreach ($anuncios as $anuncio) {
						echo '<div class="col-sm-6 col-md-4">
								<div class="thumbnail">
									<img src="data:image/png;base64,'.$anuncio->imagem0.'" alt="'.$anuncio->asunto.'">
									<div class="caption">
										<h3>'.$anuncio->asunto.'</h3>
										<p>'.Html::encode("{$anuncio->descricao}").'</p>
										<p>
											<a href="#" class="btn btn-primary" role="button">Ver Mais</a>
											<a href="#" class="btn btn-default" role="button">Ver Contacto</a>
										</p>
									</div>
								</div>
							</div>';
						}
					}
				 ?>

				</ul>
			</div>
		</div>
<?php // Fim dos resultados ?>

</div>
