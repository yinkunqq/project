<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

class FrontendController extends Controller
{
    public $enableCsrfValidation = false;

    public $layout = 'file';

    public function actionIndex()
    {
       header("content-type:text/html;charset=utf8");

       // print_r(Yii::$app->params['month']);die;

       $arr = ['name'=>'GoAWay','age'=>18];

       $sign = $this->actionEncryption($arr);

       // $url = 'http://39.105.18.210/newYii/advanced/api/web/index.php?r=test/gettopic&sign='.$sign['sign'].'&time='.$sign['time'];

       $data = Yii::$app->curl->_get('http://39.105.18.210/newYii/advanced/api/web/index.php?r=test/gettopic',$sign);

       $arr = json_decode($data,true);

       return $this->render('add',$arr);    
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

    public function actionTestpaper()
    {
        return $this->render('testpaper');
    }

    public function actionGet()
    {
    		$file = $_FILES['file'];

        $info = ['name'=>'GoAWay','age'=>18];

        $sign = $this->actionEncryption($info);

    		$path = '/phpstudy/www/newYii/advanced/common/excel/'.$file['name'];

        move_uploaded_file($file['tmp_name'],$path);

    		$arr['topic_title'] = Yii::$app->request->post('exam_name');

        $arr['sign'] = $sign['sign'];

        $arr['time'] = $sign['time'];

    		$url = 'http://39.105.18.210/newYii/advanced/api/web/index.php?r=test/index';

        $data = Yii::$app->curl->_post($url,$arr,['file'=>$path]);

        // print_r($data);

        if($data){
             $this->redirect('index.php?r=frontend/index');
        }
    }

    public function actionExamdata(){

      header("content-type:text/html;charset=utf8");

      $data = Yii::$app->db->createCommand("select * from(select * from topic where topic_type = '单选' order by rand() limit 3) as k union select * FROM (select * from topic where topic_type = '多选' order by rand() limit 3) as l
       union select * from(select * from topic where topic_type = '判断' order by rand() limit 3) as l where l.topic_unit = '十二单元'")->queryAll();

      foreach ($data as $key => $val) {
          $child = Yii::$app->db->createCommand("select * from answer where topic_id = ".$val['topic_id'])->queryAll();

          $data[$key]['son'] = $child; 
      }

      return json_encode($data);
    }

     public function actionIn(){

      header("content-type:text/html;charset=utf8");

      $data = Yii::$app->db->createCommand("select * from topic join answer on answer.topic_id = topic.topic_id where topic.topic_unit= '十二单元'")->queryAll();

      foreach ($data as $key => $val) {

         if(!isset($info[$val['topic_id']])){
            $info[$val['topic_id']] = $val;
         }

         $child =[
            'option'=>$val['option'],
            'topic_id'=>$val['topic_id']
          ];

          $info[$val['topic_id']]['child'][] = $child; 
      }

      print_r($info);
    }

}
