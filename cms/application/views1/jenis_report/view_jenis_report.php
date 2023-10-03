<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Jenis Report</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-10">
				<div class="panel panel-default">
                    <div class="panel-heading"><a href="#" id="btnAddNew" data-toggle="modal" data-target="#myActions" class="btn btn-primary"><em class="fa fa-circle-o-notch">&nbsp;</em> Synchronize with Tableau</a> </div>
                    <div class="panel-body" >
                        <table id="tbl" data-toggle="table" data-url="<?= base_url('api/APIJenisReport/view')?>"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="is_active" data-sort-order="desc">
                            <thead>
                            <tr>
                                <th data-formatter="ListFormatter" data-field="report_name">Report</th>
								<th data-formatter="ImageFormatter" data-field="report_image" data-align="center">Icon</th>
							    <th data-formatter="ActiveFormatter"  data-field="is_active" data-align="center">Status</th>
                                <th data-formatter="DateFormatter" data-field="date_created" data-align="center">Date Created</th>
                                <th data-formatter="EditFormatter" data-field="report_id" data-align="center">Actions</th>
                            </tr>
                            </thead>
                        </table>

                       
                    </div>
                </div>	
			</div>
		</div><!--/.row-->		
	