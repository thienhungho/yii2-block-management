<?php

namespace thienhungho\Block\modules\BlockManage\controllers;

use Yii;
use thienhungho\Block\modules\BlockBase\Block;
use thienhungho\Block\modules\BlockManage\search\BlockSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BlockController implements the CRUD actions for Block model.
 */
class BlockController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Block models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlockSearch();
        $dataProvider = $searchModel->search(request()->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     * @throws \yii\db\Exception
     */
    public function actionCreate()
    {
        $model = new Block();

        if ($model->loadAll(request()->post())) {
            if ($model->saveAll()) {
                set_flash_has_been_saved();
                return $this->redirect(['update', 'id' => $model->id]);
            } else {
                set_flash_has_not_been_saved();
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     *
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function actionUpdate($id)
    {
        if (request()->post('_asnew') == '1') {
            $model = new Block();
        }else{
            $model = $this->findModel($id);
        }

        if ($model->loadAll(request()->post())) {
            if ($model->saveAll()) {
                set_flash_has_been_saved();
                return $this->redirect(['update', 'id' => $model->id]);
            } else {
                set_flash_has_been_saved();
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     *
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function actionDelete($id)
    {
        if ($this->findModel($id)->deleteWithRelated()) {
            set_flash_success_delete_content();
        } else {
            set_flash_error_delete_content();
        }

        return $this->goBack(request()->referrer);
    }

    /**
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function actionBulk()
    {
        $action = request()->post('action');
        $ids = request()->post('selection');
        if (!empty($ids)) {
            if ($action == ACTION_DELETE) {
                foreach ($ids as $id) {
                    $model = $this->findModel($id);
                    if ($model->deleteWithRelated()) {
                        set_flash_success_delete_content();
                    } else {
                        set_flash_error_delete_content();
                    }
                }
            }
        }

        return $this->goBack(request()->referrer);
    }

    /**
     * @param $id
     *
     * @return mixed
     * @throws NotFoundHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionPdf($id) {
        $model = $this->findModel($id);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
        ]);

        $pdf = new \kartik\mpdf\Pdf([
            'mode' => \kartik\mpdf\Pdf::MODE_UTF8,
            'format' => \kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'options' => ['title' => \Yii::$app->name],
            'methods' => [
                'SetHeader' => [\Yii::$app->name],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        return $pdf->render();
    }

    /**
     * @param $id
     *
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function actionSaveAsNew($id) {
        $model = new Block();

        if (request()->post('_asnew') != '1') {
            $model = $this->findModel($id);
        }

        if ($model->loadAll(request()->post())) {
            if ($model->saveAll()) {
                set_flash_has_been_saved();
                return $this->redirect(['update', 'id' => $model->id]);
            } else {
                set_flash_has_been_saved();
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    
    /**
     * Finds the Block model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Block the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Block::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(t('app', 'The requested page does not exist.'));
        }
    }
}
