<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model thienhungho\Block\modules\BlockBase\Block */
/* @var $form yii\widgets\ActiveForm */
if (empty($model->author)) {
    $model->author = Yii::$app->user->id;
}
if (empty($model->language)) {
    $model->language = get_primary_language();
}
if (empty($model->id)) {
    $model->id = 0;
}
?>

<div class="row block-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <div class="col-lg-9 col-xs-12">
        <?= $form->field($model, 'name', [
            'addon'        => ['prepend' => ['content' => '<span class="fa fa-edit"></span>']],
            'hintType'     => \kartik\form\ActiveField::HINT_SPECIAL,
            'hintSettings' => [
                'showIcon' => true,
                'title'    => '<i class="glyphicon glyphicon-info-sign"></i> ' . Yii::t('app', 'Note'),
            ],
        ])->textInput([
            'maxlength'   => true,
            'placeholder' => t('app', 'Name'),
        ])->hint(Yii::t('app', 'Block\'s name, max length is 255 character')) ?>

        <!--        --><? //=
        //        $form->field($model, 'content')->widget(
        //            'trntv\aceeditor\AceEditor',
        //            [
        //                'mode' => 'html',
        //                'theme' => 'monokai',
        //                'readOnly' => 'false',
        //            ]
        //        )
        //        ?>

        <?= $form->field($model, 'content', [
            'hintType'     => \kartik\form\ActiveField::HINT_SPECIAL,
            'hintSettings' => [
                'showIcon' => true,
                'title'    => '<i class="glyphicon glyphicon-info-sign"></i> ' . Yii::t('app', 'Note'),
            ],
        ])->widget(\marqu3s\summernote\Summernote::className(), [
            'clientOptions' => [
                'height' => '500px',
            ],
        ])->hint(Yii::t('app', 'Block\'s content')); ?>
    </div>

    <div class="col-lg-3 col-xs-12">
        <?= $form->field($model, 'author', [
            'addon'        => ['prepend' => ['content' => '<span class="fa fa-user"></span>']],
            'hintType'     => \kartik\form\ActiveField::HINT_SPECIAL,
            'hintSettings' => [
                'showIcon' => true,
                'title'    => '<i class="glyphicon glyphicon-info-sign"></i> ' . Yii::t('app', 'Note'),
            ],
        ])->widget(\kartik\widgets\Select2::classname(), [
            'data'          => \yii\helpers\ArrayHelper::map(
                \thienhungho\UserManagement\models\User::find()
                    ->orderBy('id')
                    ->asArray()
                    ->all(), 'id', 'username'),
            'options'       => ['placeholder' => t('app', 'Choose User')],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->hint(Yii::t('app', 'Block\'s author, select author for block')); ?>

        <?php
        if (is_enable_multiple_language()) {
            echo language_select_input($form, $model, 'language');
            echo $form->field($model, 'assign_with', [
                'addon'        => ['prepend' => ['content' => '<span class="fa fa-paperclip"></span>']],
                'hintType'     => \kartik\form\ActiveField::HINT_SPECIAL,
                'hintSettings' => [
                    'showIcon' => true,
                    'title'    => '<i class="glyphicon glyphicon-info-sign"></i> ' . Yii::t('app', 'Note'),
                ],
            ])->widget(\kartik\widgets\Select2::classname(), [
                'data'          => \yii\helpers\ArrayHelper::map(
                    \thienhungho\Block\modules\BlockBase\Block::find()
                        ->orderBy('id')
                        ->where(['assign_with' => 0])
                        ->andWhere([
                            '!=',
                            'id',
                            $model->id,
                        ])
                        ->asArray()
                        ->all(), 'id', 'name'),
                'options'       => ['placeholder' => t('app', 'Assign With')],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])->hint(Yii::t('app', 'Block\'s assign with other block different language'));
        }
        ?>
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            <?php if (Yii::$app->controller->action->id != 'save-as-new'): ?>
                <?= Html::submitButton($model->isNewRecord ? t('app', 'Create') : t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?><?php endif; ?><?php if (Yii::$app->controller->action->id != 'create'): ?>
                <?= Html::submitButton(t('app', 'Save As New'), [
                    'class' => 'btn btn-info',
                    'value' => '1',
                    'name'  => '_asnew',
                ]) ?><?php endif; ?>
            <?= Html::a(t('app', 'Cancel'), request()->referrer, ['class' => 'btn btn-danger']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
