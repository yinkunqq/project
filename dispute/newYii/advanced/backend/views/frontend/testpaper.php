

  <form class="form-horizontal" role="form" action="index.php?r=frontend/get" method="post" enctype="multipart/form-data">
		<div class="form-group">
		    <label for="firstname" class="col-sm-2 control-label">试题名称:</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" placeholder="请输入名字" style="width:400px;" name="exam_name">
		</div>

		</div>
		<div class="form-group">
		    <label for="lastname" class="col-sm-2 control-label">选择试题:</label>
			<div class="col-sm-10">
			   <input type="file" id="inputfile" name="file">
		    </div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10"></div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			    <button type="submit" class="btn btn-default">导入</button>
			</div>
		</div>
  </form>


