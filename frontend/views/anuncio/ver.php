<?php

	/* @var $this yii\web\View */

	use yii\helpers\Html;
	use yii\bootstrap\Collapse;

	use yii2mod\google\maps\markers\GoogleMaps;
	use yii2mod\google\maps\LatLng;

	$this->title = 'Qwartus - Anuncio';
	//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anuncio-ver">
	<div class="container-fluid">
		<div class="panel panel-default">
			<div class="panel-body">
				<h3><?= $anuncio->asunto.' em '.$dis->nome_distritos.', '.$con->nome_concelhos.' por '.$anuncio->preco.'€' ?></h3>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<?= Html::img('data:image/jpg;base64,'.$anuncio->imagem0,['width'=>'600','class'=>'img-thumbnail']) ?>
				<br><br>
				<?php $location = GoogleMaps::widget([
													'userLocations' => [
														[
															'location' => [
																'lat' => 39.336250, 'lng' => -9.352833
																//'address' => 'Peniche',
																//'country' => 'Portugal',
												            ],
												        ],
												    ],
												    'googleMapsUrlOptions' => [
												        'key' => 'AIzaSyCwO_vToMdvKeev6-Z6McsTOXLcSbi_yGQ',
												        'language' => 'id',
												        'version' => '3.1.18',
												    ],
												    'googleMapsOptions' => [
												        'mapTypeId' => 'roadmap',
												        'tilt' => 45,
												        'center' => ['lat' => 39.336250, 'lng' => -9.352833],
												        'zoom' => 16,
												    ],
												]); ?>
				<?=
					Collapse::widget([
					    'items' => [
					        // equivalent to the above
					        [
					            'label' => 'Contato do Anunciante',
					            'content' => [$user->contacto],
					            // open its content by default
					            'contentOptions' => ['class' => 'in'],
					            'options' => ['class' => 'panel panel-primary'],
					        ],
					        // another group item
					        [
					            'label' => '<span class="glyphicon glyphicon-map-marker"></span> Mostrar no Mapa',
					            'content' => Html::encode($location),
					            //'contentOptions' => [...],
					            'options' => ['class' => 'panel panel-primary'],
					        ],
					    ]
					]);
				 ?>
			</div>
			<div class="col-xs-6">
				<br>
				<p><b>Tipo: </b><?= $anuncio->asunto ?></p>
				<p><b>Nº de Pessoas Pretendidas: </b><?= $anuncio->n_pessoas ?></p>
				<p><b>Preço: </b><?= $anuncio->preco ?>€</p>
				<p><b>Distrito: </b><?= $dis->nome_distritos ?></p>
				<p><b>Concelho: </b><?= $con->nome_concelhos ?></p>
				<p><b>Descrição: </b><?= $anuncio->descricao ?></p>
				<p><b>Imagens: </b></p>
				<?php $imagens = array($anuncio->imagem0,$anuncio->imagem1,$anuncio->imagem2,$anuncio->imagem3) ?>
				<?php foreach ($imagens as $key => $imagem) { ?>
					<?php $campo = 'imagem'.$key ?>
					<?php if ($anuncio->$campo != '') { ?>
						<?= Html::img('data:image/jpg;base64,'.$anuncio->$campo,['width'=>'250','class'=>'img-thumbnail']) ?>
					<?php } ?>
				<?php } ?>
			</div>
		</div>		
	</div>
</div>
