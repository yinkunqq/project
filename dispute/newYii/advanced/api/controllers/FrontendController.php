<?php
namespace api\controllers;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use PHPExcel;

class FrontendController extends Controller
{
    public function actionIndex()
    {
        // $excel = \PHPExcel_IOFactory::load('test.xls');
        // $sheet = $excel->getActiveSheet();

        // $rows = $sheet->getHighestRow();
        // $cols = $sheet->getHighestColumn();

        // print_r($rows);die;

        // echo 1;
    }
}
