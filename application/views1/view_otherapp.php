		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">List DSS</h1>
			</div>
		</div>
		<!--/.row-->


		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><button id="btnAddNew" data-toggle="modal" data-target="#myActions" class="btn btn-primary">+Add New</button></div>
					<div class="panel-body">
						<table id="tbl" data-toggle="table" data-url="<?= base_url('api/APIOtherapp/view') ?>" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="is_active" data-sort-order="desc">
							<thead>
								<tr>
									<th data-formatter="ListFormatter" data-field="judul">Nama</th>
									<th data-formatter="ListFormatter" data-field="link">Link</th>
									<th data-field="nik" data-align="center">Param NIK</th>
									<th data-field="password" data-align="center">Param Pwd</th>
									<th data-field="store" data-align="center">Param Store</th>
									<th data-field="suffix" data-align="center">Last Param</th>
									<th data-formatter="ImageFormatter" data-field="path_img" data-align="center">Icon</th>
									<th data-formatter="ActiveFormatter" data-field="is_active" data-align="center">Status</th>
									<th data-formatter="DateFormatter" data-field="date_created" data-align="center">Date Created</th>
									<th data-formatter="EditFormatter" data-field="id" data-align="center">Actions</th>
								</tr>
							</thead>
						</table>


					</div>
				</div>
			</div>
		</div>
		<!--/.row-->