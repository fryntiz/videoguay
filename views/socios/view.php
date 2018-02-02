<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Socios */
/* @var $peliculas app\models\Peliculas[] */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Socios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="socios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Gestionar', ['alquileres/gestionar', 'numero' => $model->numero], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'numero',
            'nombre',
            'direccion',
            'telefono',
        ],
    ]) ?>

    <h3>Últimas peliculas alquiladas</h3>

    <table class="table">
        <thead>
            <th>Código</th>
            <th>Título</th>
            <th>Fecha de alquiler</th>
            <th>Devolver</th>
        </thead>
        <tbody>
            <?php foreach ($alquileres as $alquiler): ?>
                <tr>
                    <td><?= Html::encode($alquiler->pelicula->codigo) ?></td>
                    <td><?= Html::encode($alquiler->pelicula->titulo) ?></td>
                    <td><?= Html::encode($alquiler->created_at) ?></td>
                    <td>
                        <?php
                        if ($alquiler->devolucion === null):
                        ?>

                            <?= Html::beginForm(['alquileres/devolver', 'numero' => $model->numero], 'post') ?>
                                <?= Html::hiddenInput('id', $alquiler->id) ?>
                                <td><?= Html::submitButton('Devolver', ['class' => 'btn-xs btn-danger']) ?></td>
                            <?= Html::endForm() ?>

                        <?php
                        else:
                        ?>
                            <td>
                                Ya devuelta
                            </td>
                        <?php
                        endif
                        ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
