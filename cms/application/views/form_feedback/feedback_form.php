<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FEEDBACK USER</title>
    <link href="<?= base_url() . 'assets/' ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() . 'assets/' ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url() . 'assets/' ?>css/styles.css" rel="stylesheet">

    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <link rel="icon" href="<?php echo base_url(); ?>assets\images\logo.png" type="image/x-icon">
</head>


<body>
    <div class="col-md-6 col-md-offset-3" style="">
        <div class="panel panel-default" style="padding-top:6px">
            <!-- <div class="panel-heading"> -->
            <!-- <h3 class="panel-title">Feedback Form</h3> -->
            <h2 style="font-size: 32px; font-weight: bold;text-align:center;margin-top:35px;">FEEDBACK USER</h2>
            <!-- </div> -->
            <div class="panel-body">
                <?php $attributes = array("name" => "Form");
                echo form_open("Form/index", $attributes); ?>
                <div class="form-group">
                    <label for="name">ID Report</label>
                    <input class="form-control" name="visit" placeholder="ID Report" type="text" value="<?php if (isset($_GET['visit'])) {
                        echo ($_GET['visit']);
                    } ?>" readonly />
                    <span class="text-danger">
                        <?php echo form_error('visit'); ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="kodetoko">Kode Toko</label>
                    <input class="form-control" name="kodetoko" placeholder="Kode Toko" type="text" value="<?php if (isset($_GET['kodetoko'])) {
                        echo ($_GET['kodetoko']);
                    } ?>" readonly />
                    <span class="text-danger">
                        <?php echo form_error('kodetoko'); ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="namacabang">Cabang</label>
                    <input class="form-control" name="namacabang" placeholder="Nama Cabang" type="text" value="<?php if (isset($_GET['par_area'])) {
                        echo ($_GET['par_area']);
                    } ?>" readonly />
                    <span class="text-danger">
                        <?php echo form_error('par_area'); ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="nik">NIK User</label>
                    <input class="form-control" name="nik" placeholder="NIK" type="text"
                        value="<?php echo set_value('nik'); ?>" />
                    <span class="text-danger">
                        <?php echo form_error('nik'); ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="nama">Nama User</label>
                    <input class="form-control" name="nama" placeholder="Nama User" type="text"
                        value="<?php echo set_value('nama'); ?>" />
                    <span class="text-danger">
                        <?php echo form_error('nama'); ?>
                    </span>
                </div>

                <div class="form-group">
                    <label>Apakah penjelasan dari maintenance sudah cukup jelas ? (Menyampaikan sumber permasalahan
                        ,terjadinya permasalahan dan
                        cara pencegahan timbulnya masalah kembali)</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="komunikasi" id="komunikasi1" value="1">Ya &nbsp;
                        </label>
                        <label>
                            <input type="radio" name="komunikasi" id="komunikasi2" value="0" checked>Tidak
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Apakah Safety dari maintenance sudah diterapkan ketika pengerjaan ? (Tools dilatakan secara
                        rapih, tools dalam
                        keadaan bersih, menggunakan safety shoes dan menggunakan sarung tangan)</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="keamanan" id="keamanan1" value="1">Ya &nbsp;
                        </label>
                        <label>
                            <input type="radio" name="keamanan" id="keamanan2" value="0" checked>Tidak
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Bagaimana dengan kemampuan penyelesaian masalah oleh tim maintenance ? (apakah saudara
                        melihat staff
                        maintenance menguasai masalah yang terjadi</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="keterampilan" id="keterampilan1" value="1">Baik &nbsp;
                        </label>
                        <label>
                            <input type="radio" name="keterampilan" id="keterampilan2" value="0" checked>Tidak Baik
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Apakah Staff Maintenance sudah menggunakan pakaian yang rapih sesuai dengan jadwal yang
                        ditentukan ?</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="kerapihan" id="kerapihan1" value="1">Ya &nbsp;
                        </label>
                        <label>
                            <input type="radio" name="kerapihan" id="kerapihan2" value="0" checked>Tidak
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="note">Catatan</label>
                    <textarea class="form-control" name="note" rows="4"
                        placeholder="Catatan"><?php echo set_value('note'); ?></textarea>
                    <span class="text-danger">
                        <?php echo form_error('note'); ?>
                    </span>
                </div>

                <div class="form-group">
                    <button name="submit" type="submit" class="btn btn-success">Kirim</button>
                </div>
                <?php echo form_close(); ?>
                <?php echo $this->session->flashdata('msg'); ?>
            </div>
        </div>
    </div>
</body>

</html>