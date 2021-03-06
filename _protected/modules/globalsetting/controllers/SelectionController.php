<?php

namespace app\modules\globalsetting\controllers;

use Yii;
use app\models\RefRek5;
use app\modules\globalsetting\models\RefRek5Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SelectionController implements the CRUD actions for RefRek5 model.
 */
class SelectionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all RefRek5 models.
     * @return mixed
     */
    public function actionIndex()
    {
        IF($this->cekakses() !== true){
            Yii::$app->getSession()->setFlash('warning',  'Anda tidak memiliki hak akses');
            return $this->redirect(Yii::$app->request->referrer);
        }    
        IF(Yii::$app->session->get('tahun'))
        {
            $Tahun = Yii::$app->session->get('tahun');
        }ELSE{
            $Tahun = DATE('Y');
        }

        return $this->render('index', [
            'Tahun' => $Tahun,
        ]);
    }

    public function actionBas()
    {
        IF($this->cekakses() !== true){
            Yii::$app->getSession()->setFlash('warning',  'Anda tidak memiliki hak akses');
            return $this->redirect(Yii::$app->request->referrer);
        }    
        IF(Yii::$app->session->get('tahun'))
        {
            $Tahun = Yii::$app->session->get('tahun');
        }ELSE{
            $Tahun = DATE('Y');
        }
        $searchModel = new RefRek5Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere('Kd_Rek_1 IN (4,5,6)');
        $dataProvider->query->orderBy('Sekolah DESC, Kd_Rek_1, Kd_Rek_2, Kd_Rek_3, Kd_Rek_4, Kd_Rek_5 ASC');

        return $this->render('bas', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'Tahun' => $Tahun,
        ]);
    }    


    public function actionPenerimaansekolah()
    {
        IF($this->cekakses() !== true){
            Yii::$app->getSession()->setFlash('warning',  'Anda tidak memiliki hak akses');
            return $this->redirect(Yii::$app->request->referrer);
        }    
        IF(Yii::$app->session->get('tahun'))
        {
            $Tahun = Yii::$app->session->get('tahun');
        }ELSE{
            $Tahun = DATE('Y');
        }
        $searchModel = new \app\modules\globalsetting\models\RefPenerimaanSekolah2Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy('Sekolah DESC, kd_penerimaan_1, kd_penerimaan_2 ASC');

        return $this->render('penerimaansekolah', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'Tahun' => $Tahun,
        ]);
    }   

    public function actionPengesahan()
    {
        IF($this->cekakses() !== true){
            Yii::$app->getSession()->setFlash('warning',  'Anda tidak memiliki hak akses');
            return $this->redirect(Yii::$app->request->referrer);
        }    
        IF(Yii::$app->session->get('tahun'))
        {
            $Tahun = Yii::$app->session->get('tahun');
        }ELSE{
            $Tahun = DATE('Y');
        }
        $searchModel = new \app\modules\globalsetting\models\RefPenerimaanSekolah2Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere('sekolah = 1');
        $dataProvider->query->orderBy('Sekolah DESC, kd_penerimaan_1, kd_penerimaan_2 ASC');

        return $this->render('pengesahan', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'Tahun' => $Tahun,
        ]);
    }

    public function actionCreate()
    {
        IF($this->cekakses() !== true){
            Yii::$app->getSession()->setFlash('warning',  'Anda tidak memiliki hak akses');
            return $this->redirect(Yii::$app->request->referrer);
        }    
        IF(Yii::$app->session->get('tahun'))
        {
            $Tahun = Yii::$app->session->get('tahun');
        }ELSE{
            $Tahun = DATE('Y');
        }   

        $model = new \app\models\RefPenerimaanSekolah2();
        
        if ($model->load(Yii::$app->request->post())) {
            IF($model->save()){
                echo 1;
            }ELSE{
                echo 0;
            }
        } else {
            return $this->renderAjax('_form', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($kd_penerimaan_1, $kd_penerimaan_2)
    {
        IF($this->cekakses() !== true){
            Yii::$app->getSession()->setFlash('warning',  'Anda tidak memiliki hak akses');
            return $this->redirect(Yii::$app->request->referrer);
        }    
        IF(Yii::$app->session->get('tahun'))
        {
            $Tahun = Yii::$app->session->get('tahun');
        }ELSE{
            $Tahun = DATE('Y');
        }   

        $model = \app\models\RefPenerimaanSekolah2::findOne(['kd_penerimaan_1' => $kd_penerimaan_1, 'kd_penerimaan_2' => $kd_penerimaan_2]);
        if ($model->load(Yii::$app->request->post())) {
            IF($model->save()){
                echo 1;
            }ELSE{
                echo 0;
            }
        } else {
            return $this->renderAjax('_form', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($kd_penerimaan_1, $kd_penerimaan_2)
    {
        IF($this->cekakses() !== true){
            Yii::$app->getSession()->setFlash('warning',  'Anda tidak memiliki hak akses');
            return $this->redirect(Yii::$app->request->referrer);
        }    
        IF(Yii::$app->session->get('tahun'))
        {
            $Tahun = Yii::$app->session->get('tahun');
        }ELSE{
            $Tahun = DATE('Y');
        }

        \app\models\RefPenerimaanSekolah2::findOne(['kd_penerimaan_1' => $kd_penerimaan_1, 'kd_penerimaan_2' => $kd_penerimaan_2])->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }    

    public function actionAssign($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4, $Kd_Rek_5)
    {
        IF($this->cekakses() !== true){
            Yii::$app->getSession()->setFlash('warning',  'Anda tidak memiliki hak akses');
            return $this->redirect(Yii::$app->request->referrer);
        }    
        IF(Yii::$app->session->get('tahun'))
        {
            $Tahun = Yii::$app->session->get('tahun');
        }ELSE{
            $Tahun = DATE('Y');
        }   

        $model = $this->findModel($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4, $Kd_Rek_5);
        switch ($model->Sekolah) {
            case 0:
                $model->Sekolah = 1;
                $message = 'Akun telah berhasil diseleksi untuk dapat dipilih oleh Sekolah.';
                break;
            case 1:
                $model->Sekolah = 0;
                $message = 'Akun telah berhasil diseleksi untuk tidak dapat dipilih oleh Sekolah.';
                break;
        }
        
        IF($model->save()){
            Yii::$app->getSession()->setFlash('success',  $message);
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionAssignp($kd_penerimaan_1, $kd_penerimaan_2)
    {
        IF($this->cekakses() !== true){
            Yii::$app->getSession()->setFlash('warning',  'Anda tidak memiliki hak akses');
            return $this->redirect(Yii::$app->request->referrer);
        }    
        IF(Yii::$app->session->get('tahun'))
        {
            $Tahun = Yii::$app->session->get('tahun');
        }ELSE{
            $Tahun = DATE('Y');
        }   

        $model = \app\models\RefPenerimaanSekolah2::findOne(['kd_penerimaan_1' => $kd_penerimaan_1, 'kd_penerimaan_2' => $kd_penerimaan_2]);
        switch ($model->sekolah) {
            case 0:
                $model->sekolah = 1;
                $message = 'Akun telah berhasil diseleksi untuk dapat dipilih oleh Sekolah.';
                break;
            case 1:
                $model->sekolah = 0;
                $message = 'Akun telah berhasil diseleksi untuk tidak dapat dipilih oleh Sekolah.';
                break;
        }
        
        IF($model->save()){
            Yii::$app->getSession()->setFlash('success',  $message);
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionAssignq($kd_penerimaan_1, $kd_penerimaan_2)
    {
        IF($this->cekakses() !== true){
            Yii::$app->getSession()->setFlash('warning',  'Anda tidak memiliki hak akses');
            return $this->redirect(Yii::$app->request->referrer);
        }    
        IF(Yii::$app->session->get('tahun'))
        {
            $Tahun = Yii::$app->session->get('tahun');
        }ELSE{
            $Tahun = DATE('Y');
        }   

        $model = \app\models\RefPenerimaanSekolah2::findOne(['kd_penerimaan_1' => $kd_penerimaan_1, 'kd_penerimaan_2' => $kd_penerimaan_2]);
        switch ($model->pengesahan) {
            case 0:
                $model->pengesahan = 1;
                $message = 'Akun telah berhasil diseleksi untuk dimasukkan dalam SP3B.';
                break;
            case 1:
                $model->pengesahan = 0;
                $message = 'Akun telah berhasil diseleksi untuk dikecualikan dalam SP3B.';
                break;
        }
        
        IF($model->save()){
            Yii::$app->getSession()->setFlash('success',  $message);
            return $this->redirect(Yii::$app->request->referrer);
        }
    }        

    protected function findModel($Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4, $Kd_Rek_5)
    {
        if (($model = RefRek5::findOne(['Kd_Rek_1' => $Kd_Rek_1, 'Kd_Rek_2' => $Kd_Rek_2, 'Kd_Rek_3' => $Kd_Rek_3, 'Kd_Rek_4' => $Kd_Rek_4, 'Kd_Rek_5' => $Kd_Rek_5])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    protected function cekakses(){

        IF(Yii::$app->user->identity){
            $akses = \app\models\RefUserMenu::find()->where(['kd_user' => Yii::$app->user->identity->kd_user, 'menu' => 107])->one();
            IF($akses){
                return true;
            }else{
                return false;
            }
        }ELSE{
            return false;
        }
    }  

}
