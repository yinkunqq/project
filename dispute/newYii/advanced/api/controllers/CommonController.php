<?php
namespace api\controllers;
use Yii;
use yii\web\Controller;

class CommonController extends Controller
{
    public function init(){

       header("content-type:text/html;charset=utf8");

       if(Yii::$app->request->isGet){
           $data = Yii::$app->request->get();

           unset($data['r']);
       }

       if(Yii::$app->request->isPost){
          $data = Yii::$app->request->post();

          unset($data['topic_title']);
       }

       // print_r($data);die;

       if(!$this->Encryption($data)){
          die('加密错误');
       }

       return true;
    }

    public function Encryption($data){
       $token = 'nicai';

       $arr = ['name'=>'GoAWay','age'=>18];

       sort($arr);

       $str='';

       foreach ($arr as $key => $val) {
          $str.=$key.'='.$val.',';
       }

       $sign = md5($token.$str.$data['time']);

       if($sign == $data['sign']){
          return true;
       }
       else{
       	  return false;
       }
    }
}