		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Administrator</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-6">
				<div class="panel panel-default">
                    <div class="panel-heading"><button id="btnAddNew" data-toggle="modal" data-target="#myActions" class="btn btn-primary">+Add New</button></div>
                    <div class="panel-body" >
                        <table id="tbl" data-toggle="table" data-url="<?= base_url('api/APIAdministrator/view')?>"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="is_active" data-sort-order="desc" >
                            <thead>
                            <tr>
                                <th data-field="username" >Admin Name</th>
                                <th data-field="password" data-align="center">Password (Encrypt)</th>
                                <th data-formatter="EditFormatter" data-field="username" data-align="center">Actions</th>
                                
                            </tr>
                            </thead>
                        </table>

                       
                    </div>
                </div>	
			</div>
		</div><!--/.row-->		
		