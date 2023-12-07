<?php
require_once '../../../models/Peminjaman.php';
include('../../../controlers/auth/checkFormPeminjaman.php');

$crud = new Crud();
if (isset($_POST['btn-pinjam'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $tanggal = $_POST['startDate'];
        $crud->addPeminjaman( $tanggal);
    }
}



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Detail Peminjaman</title>

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/form.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <?php
    include('../../../controlers/auth/checkFormPeminjaman.php');
    // include('../../../controlers/auth/checkLogin.php');

    ?>
    <div class="container">
        <div class="header">
            <h2 class="title">Detail Peminjaman</h2>
            <p class="desc">Pastikan data dan barang yang Anda pinjam sudah benar!</p>
        </div>
        <h4 class="sub-title">Data Anda</h4>
        <section class="form-pinjam">
            <div class="form-wrapper">

                <form action="" method="post">


                    <div class="row">
                        <div class="col">
                            <label for="inputState" class="form-label">Nama</label>
                            <input type="text" class="form-control" placeholder="Masukkan Nama" name="name" value="<?php echo $nama ?>" disabled>
                        </div>
                        <div class="col">
                            <label for="inputState" class="form-label">NIM/NIP</label>
                            <input type="text" class="form-control" placeholder="Masukkan NIM/NIP" name="idNumber" value="<?php echo $nomor_identitas ?>" disabled>

                        </div>
                        <div class="col">
                            <label for="inputState" class="form-label">Jumlah Hari</label> <br>
                            <select id="inputState" class="form-control">
                                <option selected>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="inputState" class="form-label">Keperluan</label> <br>
                            <!-- <input type="text" class="form-textarea" name="Keperluan" placeholder="Tulis keperluan meminjam barang tersebut"> -->
                            <textarea class="form-textarea" rows="4" cols="50" name="keperluan" form="usrform" placeholder="Tulis keperluan meminjam barang tersebut"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="inputState" class="form-label">Mulai Pinjam</label>
                            <input type="date" class="form-control" name="startDate" id="startDate" onchange="updateFinishDate()">
                        </div>
                        <div class="col">
                            <label for="inputState" class="form-label">Selesai Pinjam</label>
                            <input type="date" class="form-control" value="" name="finishDate" id="finishDate" disabled>
                        </div>
                    </div>

            </div>
        </section>
        <h4 class="sub-title">Data Barang</h4>
        <section class="item-info">
            <div class="data-table">
                <table>
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Nama Pengelola</th>
                            <th>Jumlah Dipinjam</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // print_r($_POST); // Cetak isi dari $_POST untuk memeriksa data yang dikirim
                        // for ($i = 0; isset($_POST['barang']) && $i < sizeof($_POST['barang']); $i++) {
                        //     // Tampilkan data di sini
                        // }
                        ?>
                        <?php for ($i = 0; isset($_POST['barang']) && $i < sizeof($_POST['barang']); $i++) : ?>
                            <tr>
                                <td><?php echo $_POST['barang'][$i] ?></td>
                                <td><?php echo isset($_POST['namaBarang'][$i]) ? $_POST['namaBarang'][$i] : ''; ?></td>
                                <td><?php echo isset($_POST['pengelola'][$i]) ? $_POST['pengelola'][$i] : ''; ?> </td>
                                <td><?php echo $_POST['jumlah'][$i] ?></td>
                            </tr>
                        <?php endfor; ?>


                    </tbody>
                </table>
            </div>
        </section>
        <section class="confirm-button">
            <button type="button" class="btn-kembali">Kembali</button>
            <button type="submit" class="btn-pinjam" name="btn-pinjam" id="modal">Pinjam</button>

        </section>
    </div>
    </div>
    </form>



    <div id="myModal" class="modal">
        <div class="modal-content">
            <img src="../../../../public/assets/box.svg">
            <h3>Peminjaman Diproses</h3>
            <p>Silakan cek status peminjaman</p>
            <form action="http://localhost/dasarWeb/PBL-Inventory/app/views/pages/barang-dipinjam/">
                <button type="button" class="close">Baik</button><br>
            </form>
        </div>
    </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");
        // Get the button that opens the modal
        var btn = document.getElementById("modal");
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }


        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function updateFinishDate() {
            var startDate = new Date(document.getElementById('startDate').value);
            var inputState = document.getElementById('inputState');
            var selectedDays = parseInt(inputState.options[inputState.selectedIndex].value);

            if (!isNaN(startDate.getTime())) {
                var finishDate = new Date(startDate);
                finishDate.setDate(finishDate.getDate() + selectedDays);
                var yyyy = finishDate.getFullYear();
                var mm = ('0' + (finishDate.getMonth() + 1)).slice(-2);
                var dd = ('0' + finishDate.getDate()).slice(-2);
                document.getElementById('finishDate').value = yyyy + '-' + mm + '-' + dd;
            }
        }

        function redirectPage() {
            // Redirect ke halaman lain menggunakan window.location.href
            window.location.href = ("http://localhost/dasarWeb/PBL-Inventory/app/views/pages/barang-dipinjam/")
            //Ganti dengan URL halaman yang diinginkan
        }
    </script>
</body>

</html>