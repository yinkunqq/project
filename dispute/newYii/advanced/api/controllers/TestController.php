<?php
namespace api\controllers;
use Yii;
use api\controllers\CommonController;
use PHPExcel;

class TestController extends CommonController
{

    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        header("content-type:text/html;charset=utf8");

        $file = $_FILES['file'];

        $path = '../excel/'.$file['name'];

        move_uploaded_file($file['tmp_name'],$path);
        
    	  $topicName = Yii::$app->request->post('topic_title');
        // print_r($path);die;

        $excel = \PHPExcel_IOFactory::load($path);
        $data = $excel->getActiveSheet()->toArray(null,true,true,true);

        $new_data = array_slice($data,1);

        foreach ($new_data as $key => $val) {

            $type = substr($val['B'],2);

            if($type == '单选'){
                $topic_score = 3;
            }elseif ($type == '多选') {
                $topic_score= 2;
            }
            else{
                $topic_score = 2;
            }

             $arr = array(
                 'topic_title'=>$val['C'], 
                 'topic_type' =>$type, 
                 'topic_name' =>$val['L'], 
                 'topic_score' => $topic_score, 
                 'topic_unit' => $topicName, 
                 'topic_time' => time(), 
              );

             $IntoTopic = Yii::$app->db->createCommand()->insert('topic',$arr)->execute();

             $arr=['D'=>'A','E'=>'B','F'=>'C','G'=>'D','H'=>'E','I'=>'F'];

             $topic_id = Yii::$app->db->getLastInsertId();

             $correct = str_split($val['J'],1);

            for($i='D';$i<='I';$i++){ 

                $is_correct = in_array($arr[$i],$correct) ? 1 : 0;

                if(!empty($val[$i])){
                    $data = array(
                        'topic_id'=>$topic_id, 
                        'is_correct' =>$is_correct, 
                        'option' =>$val[$i], 
                    );

                  $IntoAnswer = Yii::$app->db->createCommand()->insert('answer',$data)->execute();
               }
            }  
        }

        return 1;
    }

    public function actionGettopic(){
        $page = Yii::$app->request->get('page',1);

        $offset = ($page - 1)*10;

        $count = Yii::$app->db->createCommand('select count(topic_id) as count from topic')->queryOne();

        $data = Yii::$app->db->createCommand('select * from topic limit '.$offset.',10')->queryAll();

        $arr = ['data'=>$data,'count'=>$count];

        return json_encode($arr);

    }
}
