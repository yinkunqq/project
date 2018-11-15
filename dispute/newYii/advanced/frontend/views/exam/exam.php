

<form role="form" action="index.php?r=exam/data" method="post">
  <?php $i = 1; foreach($data as $key =>$val) {?>
     <div>
      <?php if($val['topic_type'] == '单选' || $val['topic_type'] == '判断') {?>
          <div class="form-group">
             <label for="name"><?=$i?>: <?=$val['topic_title']?></label>
                <?php $n = 'A'; foreach($val['son'] as $k =>$v) {
                  ?>
                   <div class="radio">
                      <label>
                         <input type="radio" name="<?=$val['topic_id']?>" value="<?=$v['answer_id']?>"><?=$n?>: <?=$v['option']?>
                      </label>
                   </div>
                <?php $n++;}?>
          </div>
        <?php }else{?>
          <div class="form-group">
                  <label for="name"><?=$i?>: <?=$val['topic_title']?></label>
              <?php $n = 'A'; foreach($val['son'] as $k =>$v) {?>
                  <div class="checkbox">
                     <label><input type="checkbox" name="<?=$val['topic_id']?>[]" value="<?=$v['answer_id']?>"><?=$n?>: <?=$v['option']?></label>
                  </div>
              <?php $n++;}?>
          </div>
        <?php }?>
     </div>
  <?php $i++;}?>
   <button type="submit" class="btn btn-primary">提交试卷</button>
</form>
