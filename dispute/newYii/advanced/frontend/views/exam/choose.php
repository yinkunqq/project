

<form role="form" action="index.php?r=exam/getdata" method="post">
  <?php foreach(Yii::$app->params['month'] as $key =>$val) {?>
     <div>
          <div class="form-group">
                <div class="radio">
                    <label>
                        <input type="checkbox"><?=$val?></label>
                    </label>
           </div>
        </div>
      <?php foreach(Yii::$app->params['unit'] as $k =>$v) {?>
           <div class="form-group" style="margin-left:70px;">
                  <div class="checkbox">
                     <label><input type="checkbox" name="<?=$key?>[]" value="<?=$k?>"><?=$v?></label>
                  </div>
          </div>
     <?php }?>
  <?php }?>
   <button type="submit" class="btn btn-primary">开始考试</button>
</form>
