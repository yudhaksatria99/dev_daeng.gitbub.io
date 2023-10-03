		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Departement Terkait</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-6">
				<div class="panel panel-default">
                    <div class="panel-heading"><button id="btnAddNew" data-toggle="modal" data-target="#myActions" class="btn btn-primary">+Add New</button></div>
                    <div class="panel-body" >
                        <table id="tbl" data-toggle="table" data-url="<?= base_url('api/APIDepartement/view')?>"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="is_active" data-sort-order="desc" >
                            <thead>
                            <tr>
                                <th data-formatter="ListFormatter" data-field="dept_name" >Dept Name</th>
                                <th data-formatter="ActiveFormatter"  data-field="is_active" data-align="center">Status</th>
                                <th data-formatter="EditFormatter" data-field="dept_id" data-align="center">Actions</th>
                                
                            </tr>
                            </thead>
                        </table>

                       
                    </div>
                </div>	
			</div>
		</div><!--/.row-->		
		