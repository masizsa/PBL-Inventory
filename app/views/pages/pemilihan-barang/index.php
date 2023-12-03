<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIVENTI</title>
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    
<<<<<<< Updated upstream
    <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Poppins'>
=======
>>>>>>> Stashed changes
    <link rel="stylesheet" href="../../css/p.css">
</head>

<body>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <?php
    include ('../../../controlers/auth/checkFormPeminjaman.php');
    // include('../../../controlers/auth/checkLogin.php');
    
    ?>
  <header class="siventi">
    <h1>Selamat Datang di SIVENTI 👋</h1>
    <p>Silakan cari barang yang ingin Anda pinjam, pilih yang Anda perlukan, dan tentukan jumlahnya!</p>
  </header>

        <div class="lanjut">
          <h4>Barang yang dipilih</h4>
          <button class="lanjut_button">Lanjut</button>
        </div>
      
      <!-- <div class="card_cont">
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
      </div> -->

      <!-- Tambahkan ini di dalam body setelah elemen dengan class "data_barang" -->
      <div id="barang_terpilih">
      <!-- Tempat untuk menampilkan data barang yang dipilih -->
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
<<<<<<< Updated upstream
<?php 
                        echo "<tr>";
                        $number = 0 ;

                        while($row = $result->fetch_assoc()) {
                        $number ++;
                        echo"   <td>".$row['id_barang']."</td>
                                <td>".$row['nama_barang']."</td>
                                <td>".$row['nama_admin']."</td>
                                <td>".$row['jumlah_tersedia']."</td>";
                        ?>
                                <td class="qty">
                                <button type="button" class="btn-tambah" onclick="tambahBarang(this)">Tambah</button>                                </td>
                        <?php 
                        echo "</tr>";
                        };
                        ?>
=======
            <tr>
                <td>RMT01</td>
                <td>Remote AC</td>
                <td>Pak Wardi</td>
                <td>9</td>
                <td class="qty">
                <button type="button" class="btn_tambah">Tambah</button>
                    <button type="button" class="btn_min" style="display: none;">-</button>
                    <h4 id="quantity">0</h4>
                    <button type="button" class="btn_plus" style="display: none;">+</button>
                </td>
            </tr>
>>>>>>> Stashed changes
            <tr>
                <td>KB01</td>
                <td>Kursi Biru</td>
                <td>Pak Sulaiman</td>
                <td>10</td>
                <td class="qty">
                    <button type="button" class="btn_tambah">Tambah</button>
                    <button type="button" class="btn_min" style="display: none;">-</button>
                    <h4 id="quantity" style="display: none;">0</h4>
                    <button type="button" class="btn_plus" style="display: none;">+</button>
                </td>
            </tr>
        </tbody>
      </table>

<<<<<<< Updated upstream
      <script>
        function tambahBarang(button) {
         //  document.write("Ini pesan baru menggunakan document.write()!");
          
        var row = $(button).closest('tr');
        var idBarang = row.find('td:eq(0)').text(); // Mengambil teks dari kolom pertama (indeks 0)

        $.ajax({
            type: 'POST',
            url: 'http://localhost/dasarWeb/PBL-Inventory/app/controlers/prosesTambahBarang.php', // Ganti dengan alamat file PHP Anda
            data: { id: idBarang }, // Mengirimkan ID barang ke skrip PHP
            success: function(response) {
                var dataBarang = JSON.parse(response);

                var cardContent = "<div class='card'>" +
                    "<div class='text_left'>" +
                    "<p>" + dataBarang.id_barang + "</p>" +
                    // "<h4>" + dataBarang.nama_barang + "</h4>" +
                    "</div>" +
                    "<div class='vertical_line'></div>" +
                    "<div class='text_right'>" +
                    "<p>Jumlah</p><h1>1</h1>" +
                    "</div>" +
                    "</div>";

                $("#barang_terpilih").append(cardContent);
            },
            error: function() {
                console.log("Error: tidak dapat menambahkan barang.");
            }
        });
    }

</script>
=======
  <script>
  // Ambil elemen-elemen yang diperlukan
  const allTambahButtons = document.querySelectorAll('.btn_tambah');
  const allMinButtons = document.querySelectorAll('.btn_min');
  const allPlusButtons = document.querySelectorAll('.btn_plus');
  const allQuantityDisplays = document.querySelectorAll('.quantity');

  // Fungsi untuk menampilkan tombol minus dan plus
  function showMinusPlusButtons(btnMin, btnPlus) {
      btnMin.style.display = 'inline-block';
      btnPlus.style.display = 'inline-block';
  }

  // Tambah event listener untuk tombol tambah
  allTambahButtons.forEach(btnTambah => {
      btnTambah.addEventListener('click', function() {
          btnTambah.style.display = 'none'; // Sembunyikan tombol tambah
          // Dapatkan tombol minus dan plus terkait (menggunakan index yang sama)
          const index = Array.from(allTambahButtons).indexOf(btnTambah);
          const btnMin = allMinButtons[index];
          const btnPlus = allPlusButtons[index];
          showMinusPlusButtons(btnMin, btnPlus); // Tampilkan tombol minus dan plus
          allQuantityDisplays[index].innerText = '1';
          allQuantityDisplays[index].style.display = 'inline-block'; // Tampilkan nilai awal 1
        });
  });

  // Tambah event listener untuk tombol plus
  allPlusButtons.forEach((btnPlus, index) => {
      btnPlus.addEventListener('click', function() {
          let currentQuantity = parseInt(allQuantityDisplays[index].innerText);
          currentQuantity++;
          allQuantityDisplays[index].innerText = currentQuantity;

          if (currentQuantity === 0) {
            // Periksa elemen-elemen terkait pada indeks yang sama
            allTambahButtons[index].style.display = 'inline-block';
            allMinButtons[index].style.display = 'none';
            allPlusButtons[index].style.display = 'none';
          } else {
            showMinusPlusButtons(allMinButtons[index], allPlusButtons[index]);
            allQuantityDisplays[index].style.display = 'inline-block'; // Tampilkan tombol minus dan plus
          }
      });
  });

  // Tambah event listener untuk tombol minus
  allMinButtons.forEach((btnMin, index) => {
      btnMin.addEventListener('click', function() {
          let currentQuantity = parseInt(allQuantityDisplays[index].innerText);
          
          // Periksa apakah nilai mencapai 0, jika iya, tampilkan kembali tombol tambah
          if (currentQuantity === 0) {
            // Periksa elemen-elemen terkait pada indeks yang sama
            allTambahButtons[index].style.display = 'inline-block';
            allMinButtons[index].style.display = 'none';
            allPlusButtons[index].style.display = 'none';
          } else {
            showMinusPlusButtons(allMinButtons[index], allPlusButtons[index]); // Tampilkan tombol minus dan plus
          }
      });
  });

  </script>
>>>>>>> Stashed changes

</body>
</html>