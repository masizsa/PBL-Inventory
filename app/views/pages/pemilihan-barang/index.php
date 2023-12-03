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
  <link rel="stylesheet" href="../../css/p.css">
</head>

<body>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <?php
  include('../../../controlers/auth/checkFormPeminjaman.php');
  // include('../../../controlers/auth/checkLogin.php');

  ?>
  <header class="siventi">
    <h1>Selamat Datang di SIVENTI 👋</h1>
    <h4>Silakan cari barang yang ingin Anda pinjam, pilih yang Anda perlukan, dan tentukan jumlahnya!</h4>
  </header>

  <div class="lanjut">
    <h4>Barang yang dipilih</h4>
    <form action="http://localhost/dasarWeb/PBL-Inventory/app/views/pages/ajukan-peminjaman/formPeminjaman.php" method="post" id="barangTerpilih">
      <button type="submit" class="lanjut_button">Lanjut</button>
    </form>
  </div>

  
  <style>
    .overflow-x-auto {
      overflow-x: auto;
    }
  </style>

  <!-- Tambahkan ini di dalam body setelah elemen dengan class "data_barang" -->
  <div class="card_cont overflow-x-auto" id="barang_terpilih">

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
      <?php
      echo "<tr>";
      $number = 0;

      while ($row = $result->fetch_assoc()) {
        $number++;
        echo "   <td>" . $row['id_barang'] . "</td>
                                <td>" . $row['nama_barang'] . "</td>
                                <td>" . $row['nama_admin'] . "</td>
                                <td>" . $row['jumlah_tersedia'] . "</td>";
      ?>
        <td class="qty">
          <button type="button" class="btn-tambah" onclick="tambahBarang(this)">Tambah</button>
        </td>
      <?php
        echo "</tr>";
      };
      ?>
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

  <script>
    const barang = []; // idBarang,JumlahBarang
    function tambahBarang(button) {
      //document.write('TEST NYAMBUNG BELUM');
      const form = $("#barangTerpilih");
      const row = $(button).closest('tr');
      const idBarang = row.find('td:eq(0)').text(); // Mengambil teks dari kolom pertama (indeks 0)
      const namaBarang = row.find('td:eq(1)').text(); // Mengambil teks dari kolom kedua (indeks 1)
      const pengelola = row.find('td:eq(2)').text(); // Mengambil teks dari kolom ketiga (indeks 2)

      // cek apakah barang sudah ditambahkan sebelumnya, jka sudah tambahkan jumlahnya
      const isBarangTerpilih = $(`#barang_terpilih .card .text_left p:contains(${idBarang})`).length > 0;

      if (isBarangTerpilih) {
        const jumlah = $(`#barang_terpilih .card .text_left p:contains(${idBarang})`).closest('.card').find('.text_right h1').text();
        const jumlahBaru = parseInt(jumlah) + 1;
        $(`#barang_terpilih .card .text_left p:contains(${idBarang})`).closest('.card').find('.text_right h1').text(jumlahBaru);

        // tambahkan jumlah barang ke dalam array barang
        barang.forEach((item, index) => {
          if (item.idBarang === idBarang) {
            // update jumlah barang di form
            $(`#barangTerpilih input[name="jumlah[]"]`).eq(index).val(jumlahBaru);
            barang[index].jumlahBarang = jumlahBaru;
          }
        });
        return;
      }

      const cardContent = `
      <div class="card">
      <div class="text_left">
        <p>${idBarang}</p>
        <h4>${namaBarang}</h4>
        <p>${pengelola}</p>
      </div>
        <div class="vertical_line">
      </div>
      <div class="text_right">
          <p>jumlah</p>
          <h1>1</h1>
        </div>
      </div>
      `;

      $("#barang_terpilih").append(cardContent);
      // tambahkan idbarang dan jumlah barang ke dalam array barang
      barang.push({
        idBarang, namaBarang, pengelola,
        jumlahBarang: 1
      });
      // tambahkan barang ke dalam form
      form.append(`<input type="hidden" name="barang[]" value="${idBarang}">`);
      form.append(`<input type="hidden" name="jumlah[]" value="1">`);
    }
  </script>

</body>

</html>