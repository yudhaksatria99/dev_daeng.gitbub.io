		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Items of <?= isset($item[0]->group_name) ?  $item[0]->group_name : $group_name ?></h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
                    <div class="panel-heading"><a class="btn btn-primary" href="<?= base_url('ListItem/add/'.$group_id)?>">+Add New</a></div>
                    <div class="panel-body" >
                        <table id="tbl" data-toggle="table" data-url="<?= base_url('api/APIListItem/view/'.$group_id)?>"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="date_created" data-sort-order="desc" >
                            <thead>
                            <tr>
								<th data-field="group_name" >Group</th>
								<th data-formatter="ListFormatter" data-field="description" >Description</th>
								<th data-formatter="ImageFormatter" data-field="image" data-align="center">Image</th>
								<th data-field="bobot" data-align="right">Bobot</th>
								<th data-field="category_name" >Category</th>
                                <th data-formatter="ActiveFormatter"  data-field="is_active" data-align="center">Status</th>
                                <th data-formatter="EditItem" data-field="item_id" data-align="center">Actions</th>
                                
                            </tr>
                            </thead>
                        </table>

                       
                    </div>
                </div>	
			</div>
		</div><!--/.row-->		
<script>
	function EditItem(value, row, index) {
		var el = '<a title="Edit" href="<?= base_url() ?>ListItem/edit/' + value +'"><span class="glyphicon glyphicon-pencil"></span></a>';
		return el;
			
	}
</script>