<?php

    /* @var $this yii\web\View */
    use yii\helpers\Html;

    use yii\bootstrap\ActiveForm;
    use yii\bootstrap\Modal;
    use app\models\Anuncio;
    use yii\helpers\ArrayHelper;
    use app\models\Distritos;
    use app\models\Concelhos;

    $this->title = 'Qwartus - Perfil';
?>

<div class="site-perfil">

    <div class="body-content" align="left">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4" align="center">
                    <div>
                        <?= Html::img('data:image/jpg;base64,'.Yii::$app->user->identity->imagem,['width'=>'210','class'=>'img-thumbnail']) ?>
                    </div>
                    <br>

                <?php //-> Inicio do form atualizar-user ?>
                    <?php Modal::begin([
                            'header' => '<h2>Atualizar Perfil</h2>',
                                               'toggleButton' => ['label' => '<span class="glyphicon glyphicon-pencil"></span> Atualizar Perfil',
                                               'class' => 'btn btn-success btn-xs',
                                              ],
                        ]); ?>
                        <?php $form = ActiveForm::begin(['id' => 'form-update'],
                                                        ['options' => ['enctype' => 'multipart/form-data']]); ?>

                            <?= $form->field($update,'username')->textInput(['value'=>Yii::$app->user->identity->username]) ?>
                            <?= $form->field($update,'email')->textInput(['value'=>Yii::$app->user->identity->email]) ?>
                            <?= $form->field($update,'primeiro_nome')->textInput(['value'=>Yii::$app->user->identity->primeiro_nome]) ?>
                            <?= $form->field($update,'ultimo_nome')->textInput(['value'=>Yii::$app->user->identity->ultimo_nome]) ?>
                            <?= $form->field($update,'contacto')->textInput(['value'=>Yii::$app->user->identity->contacto]) ?>
                            <?= $form->field($update,'imagem')->fileInput() ?>

                            <?= Html::submitButton('Atualizar', ['class' => 'btn btn-primary', 'name' => 'update-button']) ?>

                        <?php ActiveForm::end(); ?>

                    <?php Modal::end(); ?>
                <?php //-> Fim do form atualizar-user ?>

                </div>
                <div class="col-md-4">
                    <br>
                    <p><b>Username: </b><?= Yii::$app->user->identity->username ?></p>
                    <p><b>Nome: </b>
                        <?= Yii::$app->user->identity->primeiro_nome ?>
                        <?= Yii::$app->user->identity->ultimo_nome ?>
                    </p>
                    <p><b>Email: </b><?= Yii::$app->user->identity->email ?></p>
                </div>
                <div class="col-md-4">
                    <br>
                    <p><b>Contacto: </b><?= Yii::$app->user->identity->contacto ?></p>
                </div>
            </div>
        </div>
        <br>
        <div class="container-fluid">
            <h1>Meus Anuncios</h1>

            <?php //-> Inicio do form criar-anuncio ?>
                <?php Modal::begin(['header' => '<h2>Novo Anuncio</h2>',
                                    'toggleButton' => ['label' => 'Criar Novo Anuncio',
                                                       'class' => 'btn btn-success',
                                                      ],
                                   ]); ?>

                    <?php $form = ActiveForm::begin(['id' => 'form-create'],
                                                    ['options' => ['enctype' => 'multipart/form-data']]); ?>

                        <?= $form->field($create,'asunto')->dropDownList(['T0'=>'T0','T1'=>'T1','T2'=>'T2','T3'=>'T3','T4'=>'T4'],
                                                                         ['prompt'=>'--- Seleciona o Tipo de Apartamento ---']) ?>
                        <?= $form->field($create,'n_pessoas')->dropDownList(['1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4'],
                                                                            ['prompt'=>'--- Seleciona o Numero de Pessoas ---'])
                                                             ->label('Nº de Pessoas Pretendidas') ?>
                        <?= $form->field($create,'descricao')->textarea(['rows' => 6])
                                                             ->hint('Aqui pode descrever tudo o que o apartamento têm, Exemplo(net, fogão, lava-loiça, mobilia, etc...)') ?>
                        <?= $form->field($create,'cordenadas')->hint('Ex.. 39°20&#039;10.5"N 9°21&#039;10.2"W') ?>
                        <?= $form->field($create,'preco')->hint('Preço: exemplo(135)') ?>
                        <?= $form->field($create,'distritos')->dropDownList(
                                                            ArrayHelper::map(Distritos::find()->all(), 'id_distritos', 'nome_distritos'), 
                                                            [
                                                                'prompt' => '--- Seleciona o Distrito ---',
                                                                'onchange' => '
                                                                    $.post("index.php?r=pesquisa/concelho&id='.'"+$(this).val(), function(data){
                                                                        $("select#createanuncio-concelhos").html(data);
                                                                    });'
                                                            ]); ?>
                        <?= $form->field($create,'concelhos')->dropDownList(array(),array('prompt' => '--- Seleciona o Concelho ---')); ?>
                        <?= $form->field($create,'imagens[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

                        <?= Html::submitButton('Criar', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>

                    <?php ActiveForm::end(); ?>

                <?php Modal::end(); ?>
            <?php //-> Fim do form criar-anuncio ?>

            <hr>
            <?php foreach ($anuncios as $anuncio) { ?>
                    <div class="media">
                        <div class="media-left media-middle">
                            <?= Html::img('data:image/jpg;base64,'.$anuncio->imagem0,['width'=>'250','class'=>'media-object img-thumbnail']) ?>
                        </div>
                        <div class="media-body">
                        <?php if ($anuncio->status == 'suspended') { ?>
                                <h4><b style="color:red;">Atenção este anuncio está suspenso, o que quer dizer que os utilizadores não vão poder velo nas suas pesquisas!!</b></h4>
                                <?= Html::a('Ativar Anuncio',['anuncio/ativar','id_anuncio'=>$anuncio->id_anuncio],['class'=>'btn btn-primary btn-sm']) ?>
                        <?php }else { ?>
                                <br>
                                <?= Html::a('Suspender Anuncio',['anuncio/suspender','id_anuncio'=>$anuncio->id_anuncio],['class'=>'btn btn-primary btn-sm']) ?>
                        <?php } ?>
                            <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar Anuncio',['anuncio/eliminar','id_anuncio'=>$anuncio->id_anuncio],['class'=>'btn btn-danger btn-sm']) ?>

                        <?php //-> Inicio do form update-anuncio ?>
                            <?php Modal::begin(['header' => '<h2>Atualizar Anuncio</h2>',
                                                'toggleButton' => ['label' => '<span class="glyphicon glyphicon-pencil"></span> Atualizar Anuncio',
                                                                   'class' => 'btn btn-primary btn-sm',
                                                                  ],
                                               ]); ?>

                                <?php $form = ActiveForm::begin(['id' => 'update-anuncio'],
                                                                ['options' => ['enctype' => 'multipart/form-data']]); ?>
                                    
                                    <?= $form->field($update_anuncio,'id_anuncio')
                                             ->hiddenInput(['value'=>$anuncio->id_anuncio])
                                             ->label(false) ?>
                                    <?= $form->field($update_anuncio,'asunto')
                                             ->dropDownList(['T1'=>'T1', 'T2'=>'T2', 'T3'=>'T3', 'T4'=>'T4'],
                                                            ['prompt'=>'--- Seleciona o Tipo ---',
                                                             'options'=>[$anuncio->asunto => ['selected'=>'selected']]
                                                            ]) ?>
                                    <?= $form->field($update_anuncio,'n_pessoas')
                                             ->dropDownList(['1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4'],
                                                            ['prompt'=>'--- Seleciona o Numero de Pessoas ---',
                                                             'options'=>[$anuncio->n_pessoas => ['selected'=>'selected']]
                                                            ])
                                             ->label('Nº de Pessoas Pretendidas') ?>
                                    <?= $form->field($update_anuncio,'descricao')
                                             ->textarea(['rows' => 6,
                                                         'value' => $anuncio->descricao])
                                             ->hint('Aqui pode descrever tudo o que o apartamento têm, Exemplo(net, fogão, lava-loiça, mobilia, etc...)') ?>
                                    <?= $form->field($update_anuncio,'cordenadas')
                                             ->textInput(['value' => $anuncio->cordenadas])
                                             ->hint('Ex.. 39°20&#039;10.5"N 9°21&#039;10.2"W') ?>
                                    <?= $form->field($update_anuncio,'preco')
                                             ->textInput(['value' => $anuncio->preco])
                                             ->hint('Preço: exemplo(135)') ?>
                                    <?= $form->field($update_anuncio,'distritos')
                                             ->dropDownList(ArrayHelper::map(Distritos::find()->all(), 'id_distritos', 'nome_distritos'), 
                                                            [
                                                                'prompt' => '--- Seleciona o Distrito ---',
                                                                'onchange' => '
                                                                    $.post("index.php?r=pesquisa/concelho&id='.'"+$(this).val(), function(data){
                                                                        $("select#updateanuncio-concelhos").html(data);
                                                                    });',
                                                                'options'=>[$anuncio->id_distrito => ['selected'=>'selected']]
                                                            ]) ?>
                                    <?= $form->field($update_anuncio,'concelhos')
                                             ->dropDownList(ArrayHelper::map(Concelhos::find()
                                                                                    ->where(['ce_id_distritos'=>$anuncio->id_distrito])
                                                                                    ->all(), 'id_concelhos', 'nome_concelhos'),
                                                            [
                                                                'prompt' =>'--- Seleciona o Concelho ---',
                                                                'options'=>[$anuncio->id_concelho => ['selected'=>'selected']]
                                                            ]) ?>
                                    <?= $form->field($update_anuncio,'imagens[]')
                                             ->fileInput(['multiple' => true,'accept' => 'image/*'])
                                             ->hint('Atenção!! Qualquer imagem que coloque aqui substituirá as que já tem!! Se não selecionar nada, manterá as que já tinha!!') ?>

                                    <?= Html::submitButton('Atualizar', ['class' => 'btn btn-primary', 'name' => 'update_anuncio-button']) ?>

                                <?php ActiveForm::end(); ?>

                            <?php Modal::end(); ?>
                        <?php //-> Fim do form update-anuncio ?>

                        <?php //-> Inicio da vista do anuncio ?>
                            <?php //-> Query para buscar o distrito e concelho ?>
                                <?php $dis = Distritos::findOne($anuncio->id_distrito) ?>
                                <?php $con = Concelhos::findOne($anuncio->id_concelho) ?>
                            <?php Modal::begin(['header'=>'<h2>Ver Anuncio</h2>',
                                                'toggleButton'=>['label'=>'<span class="glyphicon glyphicon-eye-open"></span> Visualizar Anuncio',
                                                                   'class'=>'btn btn-primary btn-sm',
                                                                ],
                                               ]); ?>
                                
                                <p><b>Tipo: </b><?= $anuncio->asunto ?></p>
                                <p><b>Nº de Pessoas Pretendidas: </b><?= $anuncio->n_pessoas ?></p>
                                <p><b>Preço: </b><?= $anuncio->preco ?>€</p>
                                <p><b>Distrito: </b><?= $dis->nome_distritos ?></p>
                                <p><b>Concelho: </b><?= $con->nome_concelhos ?></p>
                                <p><b>Descrição: </b><?= $anuncio->descricao ?></p>
                                <p><b>Cordenadas: </b><?= $anuncio->cordenadas ?></p>
                                <p><b>Imagens: </b></p>
                                <?php $imagens = array($anuncio->imagem0,$anuncio->imagem1,$anuncio->imagem2,$anuncio->imagem3) ?>
                                <?php foreach ($imagens as $key => $imagem) { ?>
                                    <?php $campo = 'imagem'.$key ?>
                                    <?php if ($anuncio->$campo != '') { ?>
                                        <?= Html::img('data:image/jpg;base64,'.$anuncio->$campo,['width'=>'250','class'=>'img-thumbnail']) ?>
                                    <?php } ?>
                                <?php } ?>

                            <?php Modal::end(); ?>
                        <?php //-> Fim da vista do anuncio ?>

                            <h4>
                                <b>Tipo: </b><?= $anuncio->asunto ?> / 
                                <b>Nº de Pessoas Pretendidas: </b><?= $anuncio->n_pessoas ?> /
                                <b>Preço: </b><?= $anuncio->preco ?>€ /
                                <b>Distrito: </b><?= $dis->nome_distritos ?> /
                                <b>Concelho: </b><?= $con->nome_concelhos ?>
                            </h4>
                            <h4 class="media-heading"><b>Descrição:</b></h4>
                            <?= $anuncio->descricao ?>

                        </div>
                    </div>

            <?php } ?>
        </div>
    </div>

</div>
