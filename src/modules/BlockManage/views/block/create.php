<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model thienhungho\Block\modules\BlockBase\Block */

$this->title = t('app', 'Create Block');
$this->params['breadcrumbs'][] = ['label' => t('app', 'Block'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
