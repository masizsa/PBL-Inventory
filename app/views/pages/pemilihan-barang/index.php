<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIVENTI</title>
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Poppins'>
    <link rel="stylesheet" href="p.css">
</head>

<body>
  <header class="siventi">
    <h1>Selamat Datang di SIVENTI 👋</h1>
    <h4>Silakan cari barang yang ingin Anda pinjam, pilih yang Anda perlukan, dan tentukan jumlahnya!</h4>
  </header>

        <div class="lanjut">
          <h4>Barang yang dipilih</h4>
          <button class="lanjut_button">Lanjut</button>
        </div>
      
      <div class="card_cont">
        <div class="card">
          <div class="text_left">
            <p>RMT01</p>
            <h4>Remote AC</h4>
            <p>Pak Wardi</p>
          </div>
          <div class="vertical_line">
          </div>
          <div class="text_right">
            <p>jumlah</p>
            <h1>1</h1>
          </div>
        </div>

        <div class="card">
          <div class="text_left">
            <p>KB01</p>
            <h4>Kursi Biru</h4>
            <p>Pak Sulaiman</p>
          </div>
          <div class="vertical_line">
          </div>
          <div class="text_right">
            <p>jumlah</p>
            <h1>10</h1>
          </div>
        </div>
      </div>

      <div class="data_barang">
        <h4>Data Barang</h4>
        <form action="" class="search">
          <input type="text" placeholder="Cari Nama Barang" name="search" class="search_text">
        </form>
      </div>

      <table class="table">
        <thead class="table-warning">
            <tr>
                <th scope="col">Kode</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Nama Pengelola</th>
                <th scope="col">Jumlah Tersedia</th>
                <th scope="col">Pilih</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>RMT01</td>
                <td>Remote AC</td>
                <td>Pak Wardi</td>
                <td>9</td>
                <td class="qty">
                    <button type="button" class="btn_tambah">Tambah</button>
                </td>
            </tr>
            <tr>
                <td>KB01</td>
                <td>Kursi Biru</td>
                <td>Pak Sulaiman</td>
                <td>10</td>
                <td class="qty">
                    <button type="button" class="btn_min">-</button>
                    <h4>3</h4>
                    <button type="button" class="btn_plus">+</button>
                </td>
            </tr>
        </tbody>
      </table>
</body>
</html>