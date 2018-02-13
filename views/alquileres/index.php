<?php

//use app\widgets\DateRangePicker;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AlquileresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alquileres';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alquileres-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Alquileres', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'socio.numero',
            'socio.nombre',
            'pelicula.codigo',
            'pelicula.titulo',
            [
                'attribute' => 'created_at',
                'filter' => DateRangePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                ]),
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    $d = new DateTime($model->created_at);
                    $d = $d->format('Y-m-d');
                    return Html::a(Yii::$app->formatter->asDatetime($model->created_at),
                        ['alquileres/index',
                         'AlquileresSearch[hastaAlquilado]' => $d,
                         'AlquileresSearch[desdeAlquilado]' => $d,
                     ]);
                },
            ],
            [
                'attribute' => 'devolucion',
                'filter' => DateRangePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'devolucion',
                ]),
                'format' => 'datetime',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
