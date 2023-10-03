<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add Visit Schedule</h1>
    </div>
</div>
<!--/.row-->

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading"><label>SCHEDULE <?= strtoupper($schedule->schedule_name)  ?></label></div>
            <div class="panel-body">
                <form id="formActions" role="form" action="<?= base_url('api/APIDashboard/addSchedule') ?>">

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Store</label>
                                <select name="kode" data-live-search="true" class="selectpicker form-control" data-dropup-auto="false">
                                    <?php foreach ($toko as $t) : ?>
                                        <option value="<?= $t->singkatan_toko ?>"><?= $t->nama_toko . ' ' . $t->subarea ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Date </label>
                                <div class="input-group date" data-date-min-date="2020-11-21" data-provide="datepicker" data-date-format="yyyy-mm-dd"  data-date-start-date="+1d">
                                    <input id="visit_date" type="text" class="form-control" name="visit_date" value="<?= date("Y-m-t", strtotime($schedule->schedule_name)) ?>">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Hour </label>
                                <select id="hour" name="hour" data-live-search="true"  class="selectpicker form-control" data-dropup-auto="false">
                                    <?php for ($i = 1; $i <= 23; $i++) { ?>
                                        <?php $hour = $i < 10 ? '0' . $i : $i  ?>
                                        <?php if ($i >= 6 &&  $i <= 23) { ?>
                                            <option value="<?= $hour ?>"><?= $hour ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Minute</label>
                                <select name="minute" class="form-control">
                                    <?php for ($i = 0; $i <= 59; $i++) { ?>
                                        <?php $minute = $i < 10 ? '0' . $i : $i ?>
                                        <?php if ($i % 15 == 0) { ?>
                                            <option value="<?= $minute ?>"><?= $minute ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <div>
                                    <label>
                                        <input type="hidden" name="number" value="<?= $schedule->schedule_number ?>" />
                                        <input type="hidden" name="periode" value="<?= $schedule->period ?>" />
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>


            </div>
        </div>
    </div>
</div>
<!--/.row-->
<script>
   
    $("#visit_date").on('change keyup paste', function () {
		var vd = $("#visit_date").val();
        //ApplyFilter(vd);
        
    });
    
    function ApplyFilter(vd) {
		var d1 = new Date('<?= date("F d,Y", strtotime($schedule->schedule_name)) ?>');
        var n1 = d1.getMonth();
        
        var d2 = new Date(vd);
        var n2 = d2.getMonth();
        
        if (isNaN(d2) === false){
            if(n1 !== n2)
            {
                alert('Visit Date must in same month');
                $("#visit_date").val('<?= date("Y-m-t", strtotime($schedule->schedule_name)) ?>');
            
            }else if(new Date(vd) <= new Date()){
                alert('Visit Date minimum is next day');
                $("#visit_date").val('<?= date("Y-m-t", strtotime($schedule->schedule_name)) ?>');
            
            }
        }
        
	}
</script>

<script>
    $('#formActions').on('submit', (function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {    
                if (data['success']) {
                    //jk respon sukses lgsg keinsert
                    window.alert(data['message']);
                    var Cntl = '<?= $this->router->class ?>';
                    var Suffix = '<?= $suffix ?>';
                    var theUrl = '<?= base_url() ?>' + Cntl + Suffix;
                    window.location = theUrl;
                    
                   
                } else {
                    // Konfirmasi jadwal lebih dari 5 atau mepet dari 1 jam
                    if (typeof data['schedule_number'] !== 'undefined'){
                        var konfirmasi = window.confirm(data['message'] + ', tetap lanjut proses?');
                        if (konfirmasi === true) {
                            $ur = '<?= base_url() ?>' + 'Dashboard/Ins?schedulenumber=' + data['schedule_number'] + '&kode=' + data['kode'] + '&visitdate=' + data['visit_date'] + '&visithour=' + data['visit_hour'];
                            window.location.href = $ur;

                            window.alert("Berhasil");

                            var Cntl = '<?= $this->router->class ?>';
                            var Suffix = '<?= $suffix ?>';
                            var theUrl = '<?= base_url() ?>' + Cntl + Suffix;
                            window.location = theUrl;

                        }
                    }else {
                        window.alert(data['message']);
                    }
                }

            },
            error: function(data) {
                var errHtml = data['responseText'];
                $('#formActions').html(errHtml);

            }
        });
    }));

</script>