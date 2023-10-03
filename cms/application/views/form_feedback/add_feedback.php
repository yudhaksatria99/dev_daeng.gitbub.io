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
            <h2 style="font-size: 32px; font-weight: bold;text-align:center;">FEEDBACK USER</h2>
            <form method="post" enctype="multipart/formdata" action="<?= base_url('api/APIFeedback/add') ?>">
                <div class="panel-body">
                    <div class="form-group">
                        <label for="visit">ID Report :</label>
                        <input type="text" class="form-control" name="visit" id="visit" value="<?php if (isset($_GET['visit'])) {
                            echo ($_GET['visit']);
                        } ?>" placeholder="ID Report" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_cabang">Cabang :</label>
                        <input type="text" class="form-control" name="nama_cabang" value="<?php echo $par_area; ?>"
                            placeholder="Masukkan Nama Cabang" readonly>
                    </div>
                    <div class="form-group">
                        <label for="kodetoko">Kode Toko:</label>
                        <input type="text" class="form-control" name="kodetoko" placeholder="Masukkan Kode Toko"
                            value="<?php echo $kodetoko; ?>" readonly>

                    </div>
                    <div class="form-group">
                        <label for="nik">NIK Anda :</label>
                        <input type="number" onkeydown="return event.keyCode !== 69" class="form-control" name="nik"
                            placeholder="Masukkan NIK Anda" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Anda :</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Anda" required>
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
                        <label>Apakah Safety dari maintenance sudah diterapkan ketika pengerjaan ? (Tools dilatakan
                            secara
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
                        <label for="note">Catatan :</label>
                        <textarea type="text" class="form-control" name="note" id="note" rows="5" cols="50"
                            placeholder="Catatan" required></textarea>
                    </div>


                    <input type="submit" name="submit" class="btn btn-success" value="Submit" />

            </form>
        </div>
    </div>
    </div>

</body>



</html>