
<form action="index.php?r=frontend/testpaper" method="post">
   <button type="submit" class="btn btn-primary">导入试题</button>
</form>

<table class="table table-hover">
		<thead>
			<tr>
			<th>topic_unit</th>
			<th>topic_title</th>
			<th>topic_type</th>
			<th>操作</th>
		</tr>
		</thead>
		<tbody id="replace">
		  <?php foreach ($data as $val) { ?>
			<tr>
				<td><?=$val['topic_unit']?></td>
				<td><?=$val['topic_title']?></td>
				<td><?=$val['topic_type']?></td>
				<td>
					<button type="button" class="btn btn-primary">更改</button>
					<button type="button" class="btn btn-danger">删除</button>
				</td>
			</tr>
		 <?php }?>
	</tbody>
</table>

<!-- <script>
	var obj = new Object()

	$(document).on('click','.page',function(){
        var page = $(this).attr('pages')
        obj['page'] = page

       $.get("index.php?r=frontend/getdata",{obj:obj},function(e){
             var str = ''           

             $(e.data).each(function(i){
   				str+='<tr>'
				str+='<td>'+e.data[i].topic_unit+'</td>'
			    str+='<td>'+e.data[i].topic_title+'</td>'
				str+='<td>'+e.data[i].topic_type+'</td>'
				str+='<td>\
						<button type="button" class="btn btn-primary">更改</button>\
						<button type="button" class="btn btn-danger">删除</button>\
				     </td>'
			    str+='</tr>'
 		    },'json')

              $('#replace').html(str)

              $('#page').html(e.page)
              console.log(e)
         },'json')
	})
</script> -->
