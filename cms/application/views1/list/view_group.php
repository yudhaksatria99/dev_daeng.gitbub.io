		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Group of Check List</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-10">
				<div class="panel panel-default">
                    <div class="panel-heading"><button id="btnAddNew"  data-toggle="modal" data-target="#myActions" class="btn btn-primary">+Add New</button></div>
                    <div class="panel-body" >
                        <table id="tbl" data-toggle="table" data-url="<?= base_url('api/APIListGroup/view')?>"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="seq" data-sort-order="asc" >
                            <thead>
                            <tr>
								<th data-field="seq" data-align="center">Seq</th>
                                <th data-formatter="ListFormatter" data-field="group_name" >Group Name</th>
								<th data-formatter="ImageFormatter" data-field="group_image" data-align="center">Icon</th>
								<th data-field="group_id" data-formatter="ItemFormatter" data-align="center">Items</th>
                                <th data-formatter="ActiveFormatter"  data-field="is_active" data-align="center">Status</th>
                                <th data-formatter="EditFormatter" data-field="group_id" data-align="center">Actions</th>
                                
                            </tr>
                            </thead>
                        </table>

                       
                    </div>
                </div>	
			</div>
		</div><!--/.row-->		
		
<script>
	function ItemFormatter(value, row, index) {
			var theUrl = '<?php base_url()?>ListItem/?group='+ value;
			var el = '<a href="' + theUrl + '" title="Click to view items"><button type="button" class="btn btn-default btn-md"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> View Items</button></a>';
			return el;
	
		}
</script>