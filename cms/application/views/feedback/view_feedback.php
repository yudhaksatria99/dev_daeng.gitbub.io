<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">List Feedback</h1>
    </div>
</div><!--/.row-->


<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <!-- <div class="panel-heading"><button id="btnAddNew" data-toggle="modal" data-target="#myActions"
                    class="btn btn-primary">+Add New</button></div> -->
            <div class="panel-body">
                <table id="tbl" data-toggle="table" data-url="<?= base_url('api/APIFeedback/view') ?>"
                    data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true"
                    data-select-item-name="toolbar1" data-pagination="true" data-sort-name="is_active"
                    data-sort-order="desc">
                    <thead>
                        <tr>
                            <th data-formatter="ListFormatter" data-field="kodetoko">Kode Toko</th>
                            <th data-formatter="ListFormatter" data-field="nama" data-align="center">Nama</th>
                            <th data-formatter="ListFormatter" data-field="nilai" data-align="center">Nilai</th>
                            <th data-formatter="ListFormatter" data-field="note" data-align="center">Note</th>

                        </tr>
                    </thead>
                </table>


            </div>
        </div>
    </div>
</div><!--/.row-->