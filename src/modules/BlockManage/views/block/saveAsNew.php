<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model thienhungho\Block\modules\BlockBase\Block */

$this->title = t('app', 'Save As New {modelClass}: ', [
    'modelClass' => 'Block',
]). ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => t('app', 'Block'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = t('app', 'Save As New');
?>
<div class="block-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
