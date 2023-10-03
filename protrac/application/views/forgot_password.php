<?php 
$body = '<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  </head>
  <body>
    <p align="center"><img
        src="'. IMAGE_URL.'dac-smi.png" alt=""
        class="" width="355" height="74"></p>
    <p align="center">Hi, '.strtoupper($nama).'<br>
    </p>
    <p align="center">Ini adalah data Aplikasi DAC kamu.<br>
      <br>
      username: '.$nik.'<br>
      password: '.$password.'<br>
      kode aktifasi: '.$token.'<br>
      <font size="-1"><i>*kode aktifasi hanya sekali pakai.</i></font>
	  <br>
      <br>
	  Perlu bantuan? Silakan <i>call</i> atau <i>chat</i> IT Support
      Cabang atau IT NOC Pusat.<br>
      PLANET BAN!!! GO!!!<br>
    </p>
  </body>
</html>
';

?>