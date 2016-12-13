<?php

    /* @var $this yii\web\View */
    use yii\helpers\Html;
    use backend\assets\AppAsset;

    use yii\bootstrap\ActiveForm;
    use yii\bootstrap\Modal;

    $this->title = 'Qwartus - Manage Users';
    $this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-musers">

    <div class="body-content">
        <h1>Tabela Users</h1>
        <div class="fluid-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Primeiro Nome</th>
                        <th>Ultimo Nome</th>
                        <th>Contacto</th>
                    </tr>                    
                </thead>
                <tbody>
                    <?php 
                        foreach ($users as $user) {

                            echo '<tr>
                                    <td>'.$user->id.'</td>
                                    <td>'.$user->username.'</td>
                                    <td>'.$user->email.'</td>
                                    <td>'.$user->primeiro_nome.'</td>
                                    <td>'.$user->ultimo_nome.'</td>
                                    <td>'.$user->contacto.'</td>
                                    <td>';
                                        Modal::begin([
                                                'header' => '<h2 class="glyphicon glyphicon-edit"> Editar User: <b>'.$user->username.'</b></h2>',
                                                'toggleButton' => ['label' => '',
                                                                   'class' => 'glyphicon glyphicon-edit btn btn-primary btn-xs'
                                                                ],
                                            ]); ?>
                                            <!-- Body !-->
                                            <div class="fluid-container">

                                            
                                            <?php $form = ActiveForm::begin(['id' => 'update-form', 'method' => 'POST']) ?>

                                                <?= $form->field($modelUpdateUser, 'username')->textInput(['placeholder' => $user->username]) ?>

                                                <?= $form->field($modelUpdateUser, 'email')->textInput(['placeholder' => $user->email]) ?>

                                                <?= $form->field($modelUpdateUser, 'primeiro_nome')->textInput(['placeholder' => $user->primeiro_nome]) ?>

                                                <?= $form->field($modelUpdateUser, 'ultimo_nome')->textInput(['placeholder' => $user->ultimo_nome]) ?>

                                                <?= $form->field($modelUpdateUser, 'contacto')->textInput(['placeholder' => $user->contacto]) ?>

                                                <div class="form-group">
                                                    <?= Html::submitButton('Atualizar', ['class' => 'btn btn-primary btn-xs', 'name' => 'updateuser-button']) ?>
                                                </div>

                                            <?php ActiveForm::end(); ?>

                                            </div>
                                        <?php Modal::end();
                                    '</td>';
                                echo '<td>';
                                        Modal::begin([
                                                'header' => '<h2 class="glyphicon glyphicon-exclamation-sign">Aviso!!</h2>',
                                                'headerOptions' => ['class' => 'alert alert-danger'],
                                                'toggleButton' => ['label' => '',
                                                                   'class' => 'glyphicon glyphicon-remove btn btn-primary btn-xs'
                                                                ],
                                            ]);

                                            echo 'Tem a certeza que quer eliminar este user?'; ?>
                                            <br><br>

                                            <div class="fluid-container">

                                                <?= Html::button('Sim', array('onclick' => 'js:document.location.href="index.php?r=user/delete&id='.$user->id.'"',
                                                                              'class' => 'btn btn-primary btn-sm')); ?>

                                                <?= Html::submitButton('Não', ['class' => 'btn btn-primary btn-sm',
                                                                                'data-dismiss' => 'modal']) ?>

                                            </div>
                                        <?php Modal::end();
                                    '</td>';
                            echo  '</tr>';
                        }
                     ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
