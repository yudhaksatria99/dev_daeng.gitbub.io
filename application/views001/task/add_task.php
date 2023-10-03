	
	<div class="row">
		<div class="col-lg-9">
			<div class="panel panel-default chat">
				<div class="panel-heading">
					To-do List
					<ul class="pull-right panel-settings panel-button-tab-right">
						<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
							<em class="fa fa-cogs"></em>
						</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li>
									<ul class="dropdown-settings">
										
										<?php foreach($group as $g): ?>
										<li><a href="<?= base_url('Task/add/?group='.$g->group_id)?>">
											<em class="<?= $g->group_id == $group_id ? 'fa fa-check-square-o' : 'fa fa-square-o'?>"></em><?= $g->group_name ?>
										</a></li>
										<?php endforeach; ?>
										
									</ul>
								</li>
							</ul>
						</li>
						
					</ul>
					<ul class="pull-right panel-settings panel-button-tab-right">
						<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
							<em class="fa fa-toggle-down"></em>
						</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li>
									<ul class="dropdown-settings">
										<li><a href="<?= base_url('Task/add/?group='.$group_id)?>">
											<em class="<?= $category_id == 0 ? 'fa fa-check-square-o' : 'fa fa-square-o'?>"></em>All Categories
										</a></li>
										<?php foreach ($category as $c): ?>
										<li><a href="<?= base_url('Task/add/?group='.$group_id.'&category='.$c->category_id)?>">
											<em class="<?= $c->category_id == $category_id ? 'fa fa-check-square-o' : 'fa fa-square-o'?>"></em> <?= $c->category_name ?>
										</a></li>
										<?php endforeach; ?>
									</ul>
								</li>
							</ul>
						</li>
						
					</ul>
				</div>
				<div class="panel-body">
					<ul class="todo-list">
						<?php $a=0; ?>
						<?php foreach ($item as $i): ?>
						<?php $a++; ?>
					
						<li class="<?= fmod($a,2) == 1 ? 'left'  : 'right'?> clearfix"><span class="chat-img pull-<?= fmod($a,2) == 1 ? 'left'  : 'right'?>">
								<?php if (!empty($i->image)){ ?>
									<img style="width:80px;height:80px;" src="<?= base_url('uploads/150/'.$i->image)?>"  class="img-circle" />
								<?php } ?>
								</span>
								<div class="chat-body clearfix">
									<div class="header"><strong class="primary-font"><?= $i->category_name ?></strong> <small class="text-muted"><?= $i->group_name ?></small></div>
									<p>&nbsp;<?= $i->description ?></p>
								</div>
								<div class="pull-right action-buttons">
									<?php if ($i->temp_id == 0 ) { ?>
										<a href="<?= base_url('Task/add/?id='.$i->item_id).'&group='.$group_id ?><?=  $category_id != 0 ? '&category='.$category_id : '' ?>" ><em class="fa fa-square-o" style="font-size:24px;color:red"></em></a>
									<?php } else { ?>	
										<em class="fa fa-check-square" style="font-size:24px;color:red"></em>
									<?php } ?>
								
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				
			</div>	
		</div>
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-body" >
					<form role="form" method="post" action="<?= base_url('Task/submit') ?>"> 
						<label>Task Name</label>
						<div class="form-group ">
							<input type="hidden" value="<?= current_url().'?'.$_SERVER['QUERY_STRING'] ?>" name="uri">
							<input class="form-control" name="name" value="<?= date("F Y", strtotime("+1 month", time())) ?>" readonly>
						</div>
						<label>Total Bobot</label>
						<div class="input-group">
							
							<input type="text" class="form-control input-md" value="<?= $bobot->jumlah ?>" readonly/><span class="input-group-btn">
								<button class="btn btn-warning btn-md" id="btn-chat">Process</button>
						</span></div>
					
					</form>
				</div>
			</div>
		</div>
	</div><!--/.row-->		
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body" >
					<table id="tbl" data-toggle="table" data-url="<?= base_url('api/APITask/temp')?>"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="date_created" data-sort-order="desc">
						<thead>
						<tr>
							<th data-formatter="SeqFormatter" data-field="seq"  >Seq</th>					
							<th data-field="description">Check List</th>
							<th data-field="bobot" data-align="right">bobot</th>
							<th data-field="group_name" >Group</th>
							<th data-field="category_name" >Category</th>
							<th data-formatter="DeleteFormatter" data-field="temp_id" data-align="center">Actions</th>
							
						</tr>
						</thead>
					</table>
				<div>
			</div>
		</div>
	</div><!--/.row-->		


<script>
	function DeleteFormatter(value, row, index) {
		var category_id = '<?= $category_id ?>';
		var theUrl = '<?= base_url()?>Task/add/?temp_id='+ value +'&group=<?= $group_id ?>';
		if (category_id != '0') theUrl += '&category=' + category_id;
		var el = '<a href="' +  theUrl + '" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>';
		return el;
			
	}

	function SeqFormatter(value, row, index){ 
		var el = '<span class="col-sm-8"><input onChange="SeqRequest(this.id)" id="'+ row.temp_id +'" class="form-control" type="number" maxlength="3" value="' + value + '"></span>';
		return el;
			
	}
	

	function SeqRequest(id){
		var seq = document.getElementById(id).value;
		var theUrl = '<?= base_url()?>Task/edit/?id=' + id + '&seq='+seq;
		$.get(theUrl, function( data ) {
			console.log(data);
		});

	}
</script>