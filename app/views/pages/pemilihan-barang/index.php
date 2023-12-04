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
  ?>

  <header class="siventi">
    <h1>Selamat Datang di SIVENTI 👋</h1>
    <p>Silakan cari barang yang ingin Anda pinjam, pilih yang Anda perlukan, dan tentukan jumlahnya!</p>
  </header>

        <div class="lanjut">
          <h4>Barang yang dipilih</h4>
          <button class="lanjut_button">Lanjut</button>
        </div>
      
      <div class="card_cont">
        <h5 class="noBooking">Tidak Ada Barang yang Dipilih</h5>
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
                <button type="button" class="btn_tambah" onclick="tombolTambah(this)">Tambah</button>
                <button class="btn_min" style="display: none" onclick="kurangiJumlah(this)">-</button>
                <h1 style="display: none"></h1>
                <button class="btn_plus" style="display: none" onclick="tambahJumlah(this)">+</button>
              </td>
            <?php
              echo "</tr>";
            };
            ?>

              <tr>
          </tbody>
        </table>
     
  <script>

  let jumlahTable = 0;
  function tombolTambah(button) {
  tambahBarang(button);
  const h1Elem = button.nextElementSibling.nextElementSibling;
  const btnMin = h1Elem.previousElementSibling;
  const btnPlus = h1Elem.nextElementSibling;

  if (h1Elem.innerText === '') {
    // Jika nilai h1 masih kosong, maka atur nilainya menjadi 1
    h1Elem.innerText = '1';
  }

  // Mengubah tampilan tombol
  button.style.display = 'none'; // Menyembunyikan tombol Tambah
  btnMin.style.display = 'inline-block'; // Menampilkan tombol Minus
  h1Elem.style.display = 'inline-block'; // Menampilkan elemen h1 (angka)
  btnPlus.style.display = 'inline-block'; // Menampilkan tombol Plus

  // Mengubah tampilan berdasarkan nilai angka
  const jumlah = parseInt(h1Elem.innerText);
  if (jumlah < 1) {
    btnMin.style.display = 'none'; // Menyembunyikan tombol Minus
    btnPlus.style.display = 'none'; // Menyembunyikan tombol Plus
    button.style.display = 'inline-block'; // Menampilkan tombol Tambah
    }
  }

  function kurangiJumlah(button) {
  const h1Elem = button.nextElementSibling;
  let jumlah = parseInt(h1Elem.innerText);

  if (jumlah === 1) {
    h1Elem.style.display = 'none'; // Menyembunyikan angka
    button.style.display = 'none'; // Menyembunyikan tombol Min
    const btnPlus = button.nextElementSibling;
    if (btnPlus.tagName === 'BUTTON') {
      btnPlus.style.display = 'none'; // Menyembunyikan tombol Plus
    }
    button.previousElementSibling.style.display = 'inline-block'; // Menampilkan tombol Tambah
  } else {
    jumlah--;
    h1Elem.innerText = jumlah;
    jumlahTable = jumlah;
    }
  }

  function tambahJumlah(button) {
  const h1Elem = button.previousElementSibling;
  let jumlah = parseInt(h1Elem.innerText);
  jumlah++;
  h1Elem.innerText = jumlah;
  jumlahTable = jumlah;
  }


    const barang = []; // idBarang,JumlahBarang
    function tambahBarang(button) {
      //document.write('TEST NYAMBUNG BELUM');
      const form = $(".card_cont");
      const row = $(button).closest('tr');
      const idBarang = row.find('td:eq(0)').text(); // Mengambil teks dari kolom pertama (indeks 0)
      const namaBarang = row.find('td:eq(1)').text(); // Mengambil teks dari kolom kedua (indeks 1)
      const pengelola = row.find('td:eq(2)').text(); // Mengambil teks dari kolom ketiga (indeks 2)

      // cek apakah barang sudah ditambahkan sebelumnya, jka sudah tambahkan jumlahnya
      const isBarangTerpilih = $(`.card_cont .card .text_left p:contains(${idBarang})`).length > 0;
      
      if (isBarangTerpilih) {
        const jumlah = $(`.card_cont .card .text_left p:contains(${idBarang})`).closest('.card').find('.text_right h1').text();
        const jumlahBaru = parseInt(jumlah) + 1;
        $(`.card_cont .card .text_left p:contains(${idBarang})`).closest('.card').find('.text_right h1').text(jumlahBaru);

        // tambahkan jumlah barang ke dalam array barang
        barang.forEach((item, index) => {
          if (item.idBarang === idBarang) {
            // update jumlah barang di form
            $(`.card_cont input[name="jumlah[]"]`).eq(index).val(jumlahBaru);
            tambahJumlah(button);
            barang[index].jumlahBarang = jumlahTable;
          }
        });
        return;
      }

      const cardContent = `
      <div class="card">
      <button class="closeButton">X</button>
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

      $(".card_cont").append(cardContent);

      const adaElement = document.querySelector('card_cont');
      const nb = 'Tidak ada peminjaman'

      if (!adaElement) {
        // Jika ada, lakukan sesuatu
        document.querySelector('.noBooking').remove();
      }else{
        $(".card_cont").append(nb);
      }

      // tambahkan idbarang dan jumlah barang ke dalam array barang
      barang.push({
        idBarang, namaBarang, pengelola,
        jumlahBarang: 1
      });
      // tambahkan barang ke dalam form
      form.append(`<input type="hidden" name="barang[]" value="${idBarang}">`);
      form.append(`<input type="hidden" name="jumlah[]" value="1">`);
    }


    function hapusBarang(button) {
    const card = $(button).closest('.card');
    const idBarang = card.find('.text_left p').text();
    
    // Mengatur nilai jumlah menjadi 0
    card.find('.text_right h1').text('0');
    
    // Menghapus kartu dari tampilan
    card.remove();

    // Mengubah nilai jumlah barang di array barang menjadi 0
    barang.forEach((item, index) => {
      if (item.idBarang === idBarang) {
        barang[index].jumlahBarang = 0;
      }
    });

    // Mengubah nilai jumlah barang di dalam form menjadi 0
    $(`.card_cont input[name="jumlah[]"][value="${idBarang}"]`).val('0');
  }

  // Menambahkan event listener pada tombol close ("X")
  $('.card_cont').on('click', '.closeButton', function() {
    hapusBarang(this);
  });

  
    function toggleButtons(button) {
    const btnGroup = $(button).siblings('.btn_group');
    btnGroup.find('.btn_tambah').toggleClass('hidden');
    btnGroup.find('.counter').toggleClass('hidden');
  }


  </script>

</body>
</html>