<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;


class ExamController extends Controller
{
    public $enableCsrfValidation = false;

    public $layout = 'exam';

    public function actionIndex(){
        return $this->render('choose');
    }

    public function actionGetdata(){

       header("content-type:text/html;charset=utf8");

       $arr = Yii::$app->request->post();

       //print_r($arr);die;

       $condition = '';

       foreach ($arr as $key => $val) {
          $condition.=' month='.$key;

          $str = implode(',',$val);

          $condition.=" and topic_unit in($str) or";
       }

       $condition = rtrim($condition,' or');

       $sql = "select * from (select * from topic where topic_type = '单选' and (".$condition.") ORDER BY RAND() limit 5) as topic join answer on topic.topic_id = answer.topic_id";

       // echo $sql;die;

       $radioData = Yii::$app->db->createCommand($sql)->queryAll();

       $sql = "select * from (select * from topic where topic_type = '多选' and (".$condition.") ORDER BY RAND() limit 5) as topic join answer on topic.topic_id = answer.topic_id";

       $checkData = Yii::$app->db->createCommand($sql)->queryAll();

       $sql = "select * from (select * from topic where topic_type = '判断' and (".$condition.") ORDER BY RAND() limit 5) as topic join answer on topic.topic_id = answer.topic_id";

       $judgeData = Yii::$app->db->createCommand($sql)->queryAll();

       $bigData = array_merge($radioData,$checkData,$judgeData);

       foreach ($bigData as $key => $val) {

            if(!isset($info[$val['topic_id']])){
                $info[$val['topic_id']] = $val;
            }

            $option = [ 'option'=>$val['option'],'answer_id'=>$val['answer_id'] ];

            $info[$val['topic_id']]['son'][] = $option;
        }

        return $this->render('exam',['data'=>$info]);
    }

    public function actionData(){

        $data = Yii::$app->request->post();

        $score = 0;
        $check = 0;

        foreach ($data as $key => $val) {
           if(is_array($val)){

              sort($val);
              // print_r($val);die;

              $arr = Yii::$app->db->createCommand("select * from answer where answer.topic_id = ".$key.' and is_correct = 1')->queryAll();

              $info = [];

              foreach ($arr as $kk => $vv) {
                  $info[] = $vv['answer_id'];
              }

              sort($info);

              if($info == $val){
                 $check = $check+2;
              }

              unset($info);
           } 
           else{
             $arr = Yii::$app->db->createCommand("select * from answer join topic on answer.topic_id = topic.topic_id where answer.topic_id = ".$key.' and is_correct = 1')->queryAll();
             $info[] = $val;

             foreach ($arr as $k => $v) {
                 if(in_array($v['answer_id'],$info)){
                     $score = $score+$v['topic_score']; 
                 }
              }
           }
        }

       print_r($check+$score);
    }


    public function actionEncryption($arr){    //对称加密
     
       $token = 'nicai';

       $time = time();

       sort($arr);

       $str='';

       foreach ($arr as $key => $val) {
          $str.=$key.'='.$val.',';
       }

       $sign = md5($token.$str.$time);

       return ['sign'=>$sign,'time'=>$time];
    }

}
