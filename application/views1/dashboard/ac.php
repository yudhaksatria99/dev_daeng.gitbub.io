<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <table id="tbl" data-toggle="table" data-url="<?= base_url('api/APIDashboard/ac/?nik=' . $admin->nik) ?>" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="date_created" data-sort-order="desc">
                    <thead>
                        <tr>
                            <th data-field="empid" data-align="center">NIK</th>
                            <th data-field="name">Nama</th>
                            <th data-field="pmtelp">HP</th>
                            <th data-field="gender" data-align="center">Gender</th>
                            <th data-formatter="ScheduleFormatter" data-field="empid" data-align="center">Schedule</th>
                            <th data-field="position_begin" data-align="center">Tgl Aktif</th>
                            <th data-field="termination" data-align="center">Termination</th>
                        </tr>
                    </thead>
                </table>


            </div>
        </div>
    </div>
</div>
<!--/.row-->
<script>
    function ScheduleFormatter(value, row, index) {
        var el = '';
        var res1 = false;
        var res2 = false;
        var current_month = '<?= date("M Y") ?>';
        var current_period = '<?= date("Ym") ?>';
        var next_month = '<?= date("M Y", strtotime("+1 month -1 day")) ?>';
        var next_period = '<?= date("Ym", strtotime("+1 month -1 day")) ?>';

        if (row.schedule != null) {
            try {

                var obj = JSON.parse(row.schedule);
                $.each(obj, function(i, item) {
                    el += '<a href="<?= base_url() ?>Dashboard/?view=schedule&id=' + row.empid + '-' + item.schedule_number + '">' + item.schedule_name + ' <span class="glyphicon glyphicon-calendar"></span></a><br />';
                    if (item.schedule_name === current_month) res1 = true;
                    if (item.schedule_name === next_month) res2 = true;
                    sessionStorage.setItem("nikpilih", row.empid);

                });

                if (res1 == false) {
                    el += '<a href="<?= base_url() ?>Dashboard/?view=schedule&id=' + row.empid + '-' + current_period + '">' + current_month + ' <span class="glyphicon glyphicon-calendar"></span></a><br />';
                }

                if (res2 == false) {
                    el += '<a href="<?= base_url() ?>Dashboard/?view=schedule&id=' + row.empid + '-' + next_period + '">' + next_month + ' <span class="glyphicon glyphicon-calendar"></span></a><br />';
                }
            } catch (e) {
                console.log(e);
            }

        } else {
            el += '<a href="<?= base_url() ?>Dashboard/?view=schedule&id=' + row.empid + '-' + current_period + '">' + current_month + ' <span class="glyphicon glyphicon-calendar"></span></a><br />';
            el += '<a href="<?= base_url() ?>Dashboard/?view=schedule&id=' + row.empid + '-' + next_period + '">' + next_month + ' <span class="glyphicon glyphicon-calendar"></span></a><br />';
        }
        return el;
    }
</script>