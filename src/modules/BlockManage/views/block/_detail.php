<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model thienhungho\Block\modules\BlockBase\Block */
?>
<div class="block-view">

    <div class="row">
        <div class="col-sm-9">
            <h3><?= Html::encode($model->name) ?></h3>
        </div>
    </div>

    <div class="row">
        <?php
        $gridColumn = [
            [
                'attribute' => 'id',
                'visible'   => false,
            ],
            'name',
            [
                'attribute' => 'author0.username',
                'label'     => t('app', 'Author'),
            ],
        ];
        if (is_enable_multiple_language()) {
            $gridColumn[] = [
                'format'    => 'raw',
                'attribute' => 'language',
                'value'     => function($model, $key) {
                    return \powerkernel\flagiconcss\Flag::widget([
                        'tag'     => 'span',
                        'country' => get_country_code_from_language_code($model->language),
                        'squared' => false,
                        'options' => [],
                    ]);
                },
            ];
            $gridColumn[] = [
                'format'    => 'raw',
                'attribute' => 'assign_with',
                'value'     => function($model, $key) {
                    if ($model->assign_with == 0) {
                        return Yii::t('app', 'Empty');
                    }
                    return Html::a($model->assign_with, \yii\helpers\Url::to(['block/view', 'id' => $model->assign_with]), ['target' => '_blank']);
                },
            ];
        }
        echo DetailView::widget([
            'model'      => $model,
            'attributes' => $gridColumn,
        ]);
        ?>
    </div>
</div>