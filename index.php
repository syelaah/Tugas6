<?php
$bandara_asal = [
    "Soekarno-Hatta" => 65000,
    "Husein Sastranegara" => 50000,
    "Abdul Rahman Saleh" => 40000,
    "Juanda" => 30000
];

ksort($bandara_asal);

$bandara_tujuan = [
    "Ngurah Rai" => 85000,
    "Hasanuddin" => 70000,
    "Inanwantan" => 90000,
    "Sultan Iskandar Muda" => 60000
];
ksort($bandara_tujuan);

function pajak_asal($bandara_asal, $asal)
{
    $harga_pajak = $bandara_asal[$asal];
    return $harga_pajak;
}

function pajak_tujuan($bandara_tujuan, $tujuan)
{
    $harga_pajak = $bandara_tujuan[$tujuan];
    return $harga_pajak;
}

function hitung_total_pajak($bandara_asal, $asal, $bandara_tujuan, $tujuan){
    $harga_pajak_asal = pajak_asal($bandara_asal, $asal);
    $harga_pajak_tujuan = pajak_tujuan($bandara_tujuan, $tujuan);
    $total_pajak = $harga_pajak_asal + $harga_pajak_tujuan;
    return $total_pajak;
  }
  
  function hitung_total_harga_tiket($harga_tiket, $total_pajak){
    $total_harga_tiket = $harga_tiket + $total_pajak;
    return $total_harga_tiket;
  }
  function rupiah($angka){
    $hasil = "Rp ". number_format($angka,0,',','.');
    return $hasil;
  }
  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Falcon Air</title>
      <link rel="stylesheet" href="style.css">
  </head>
  <body>
  <header class="header">

    <a href="#" class="logo">
    <img src="img/logo.png" alt="">
    </a>

    <nav class="navbar">
    <a href="#homepage">Homepage</a>
    <a href="#">Ticketing</a>
    <a href="#">Schedule</a>
    <a href="#">About Us</a>
    <a href="#">Contact</a>
    <a href="#">Follow</a>
    </nav>
    </header>

    <section class="homepage" id="homepage">
        <div class="content">
            <img src="img/logo1.png" alt="">
            <h3>FALCON AIR</h3>
            <p style="text-align:justify">Falcon Air adalah perusahaan teknologi terkemuka di Asia Tenggara yang menyediakan akses bagi masyarakat untuk menemukan dan memesan tiket pesawat.</p>
        </div>
    </section>
    
      <div class = "input">
          <form class = "box" action = "" method = "POST">
              <input type = "hidden" name = "tanggal" value = "<?php echo date("d-m-Y"); ?>">
              <label for="nama_maskapai"><b>Nama Maskapai</b></label>
              <input type = "text" name = "nama_maskapai" id = "nama_maskapai">
              <label for="bandara_asal"><b>Bandara Asal</b></label>
              <select name="bandara_asal" id="bandara_asal">
                  <?php
                  foreach ($bandara_asal as $asal => $pajak_asal){
                      ?>
                  <option value="<?= $asal; ?>"><?= $asal; ?></option>
                  <?php
                  }
                  ?> </select>

              <label for="bandara_tujuan"><b>Bandara Tujuan</b></label>
              <select name="bandara_tujuan" id="bandara_tujuan">
                <?php
                foreach ($bandara_tujuan as $tujuan => $pajak_tujuan){
                ?>
                <option value="<?= $tujuan; ?>"><?= $tujuan ?></option>
                <?php
                }
                ?>
                </select>
            <label for="harga_tiket"><strong>Harga Tiket</strong></label>
            <input type="number" name="harga_tiket" id="harga_tiket">
            <input type="submit" value="Daftar" name="daftar">
    </form>
  </div>

  <div class="output">
      <table width="400px" height="363px">
          <?php
          $tanggal = "";
          $maskapai = "";
          $asal = "";
          $tujuan = "";
          $harga_tiket = 0;
          $pajak = 0;
          $total_harga_tiket = 0;
          if (isset($_POST['daftar'])){
              $tanggal          = $_POST['tanggal'];
              $maskapai         = $_POST['nama_maskapai'];
              $asal             = $_POST['bandara_asal'];
              $tujuan           = $_POST['bandara_tujuan'];
              $harga_tiket      = $_POST['harga_tiket'];
              $pajak            = hitung_total_pajak($bandara_asal, $asal, $bandara_tujuan, $tujuan);
              $total_harga_tiket= hitung_total_harga_tiket($_POST['harga_tiket'],$pajak);
          }
          ?>
          <tr>
          <td><strong><?php echo "Tanggal"; ?></strong></td>
          <td><strong><?php echo ":"; ?></strong></td>
          <td><strong><?php echo "$tanggal"; ?></strong></td>
        </tr>
        <tr>
          <td><strong><?php echo "Nama Maskapai"; ?></strong></td>
          <td><strong><?php echo ":"; ?></strong></td>
          <td><strong><?php echo "$maskapai"; ?></strong></td>
        </tr>
        <tr>
          <td><strong><?php echo "Asal Penerbangan"; ?></strong></td>
          <td><strong><?php echo ":"; ?></strong></td>
          <td><strong><?php echo "$asal"; ?></strong></td>
        </tr>
        <tr>
          <td><strong><?php echo "Tujuan Penerbangan"; ?></strong></td>
          <td><strong><?php echo ":"; ?></strong></td>
          <td><strong><?php echo "$tujuan"; ?></strong></td>
        </tr>
        <tr>
          <td><strong><?php echo "Harga Tiket"; ?></strong></td>
          <td><strong><?php echo ":"; ?></strong></td>
          <td><strong><?php echo "".rupiah($harga_tiket); ?></strong></td>
        </tr>
        <tr>
          <td><strong><?php echo "Pajak"; ?></strong></td>
          <td><strong><?php echo ":"; ?></strong></td>
          <td><strong><?php echo "".rupiah($pajak); ?></strong></td>
        </tr>
        <tr>
          <td><strong><?php echo "Total Harga Tiket"; ?></strong></td>
          <td><strong><?php echo ":"; ?></strong></td>
          <td><strong><?php echo "".rupiah($total_harga_tiket); ?></strong></td>
        </tr>
      </table>
  </div>
</body>
</html>              