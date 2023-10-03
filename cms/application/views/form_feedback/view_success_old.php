<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logo.png" type="image/x-icon" />
    <!-- <link rel="shortcut icon" href="assets/img/planet-ban.png" type="image/x-icon" /> -->

</head>

<style>
    body,
    html {
        height: 100%;
        width: 100%;
        /* margin: 0; */
    }

    .bg {
        /* The image used */
        /* background-image: url("assets/img/rmb1.png"); */

        /* Full height */
        height: 100%;
        width: 100%;
        /* position: relative; */

        /* Add the blur effect */
        filter: blur(8px);
        webkit-filter: blur(8px);

        /* Center and scale the image nicely */
        /* background-image: url('http://localhost/dev_daeng/cms/assets/images/pb.png'); */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .bg-text {
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/opacity/see-through */
        color: white;
        /* font-weight: bold; */
        border: 1px solid #f1f1f1;
        position: absolute;
        top: 30%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
        width: 80%;
        padding: 20px;
        text-align: center;
    }

    .bg .logo {
        text-align: center;
    }
</style>

<body>
    <!-- <p align="center"><img src=" <?php echo base_url(); ?>assets/img/planet-ban.png" alt="" class="" width="auto"
            height="auto"></p>

    <img align="center" src="<?php echo base_url(); ?>assets/img/planet-ban.png" style="max-width: 100%; position:absolute; display:none;"> -->

    <!-- <div class="bg">
        <img class="logo" align="center" src="<?php echo base_url(); ?>assets/images/logo.png"
            style="max-width: 300px;">
    </div> -->

    <!-- <div class="bg-text"> -->

        <!-- <div align="center">
            <p align="center"></p>
            <font color="white" size="+6"> Hi,
                <?php echo $nopol; ?>
                <?= strtoupper($ac->nama) ?>
            </font>
        </div> -->
        <div align="center">
            <font color="black" size="+3">Feedback Anda Telah Kami Terima.</font>
        </div>

        <!-- <div align="center">
            <font color="white" size="+3">Terima Kasih.</font>
        </div> -->
        <div align="center">
            <font size="+3">
            </font><br>
            <br>

        </div>
        <div align="center">
            <font color="black" size="+3">Terima Kasih</font><br>
            <br>

        </div>
        <!-- <div align="center">
        <font size="+3">nikMAT berkendaranya </font><br>
        <br>

    </div>
    <div align="center">
        <font size="+3">ikut selaMATkan planet </font><br>
        <br>

    </div> -->
        <!-- <div align="center">
            <font color="white" size="+3">Salam Rasa Mesin Baru </font><br>
        </div> -->
    <!-- </div> -->

</body>

</html>