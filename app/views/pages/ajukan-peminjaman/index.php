<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Detail Peminjaman</title>

        <!-- Bootstrap CSS CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    </head>

    <body>
        <?php
        // ini_set('include_path', 'C:\xampp\htdocs\dasarWeb\PBL-Inventory\app\function');
        include ('../../../controlers/auth/cekAjukanPeminjaman.php');
            ?>


        <div class="container">
            <h2>Detail Peminjaman</h2>
            <p>Pastikan data dan barang yang Anda pinjam sudah benar!</p>
            <h4>Data Anda</h4>
            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col">
                            <label for="inputState" class="form-label">Nama</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nama" name="name" value="<?php echo $nama?>">
                            </div>
                            <div class="col">
                            <label for="inputState" class="form-label">NIM/NIP</label>
                                <input type="text" class="form-control" placeholder="Masukkan NIM/NIP" name="idNumber" value="<?php echo $nomor_identitas?>">
                            </div>
                            <div class="col">
                                <div class="col-md-4">
                                    <label for="inputState" class="form-label">Jumlah Hari</label>
                                    <select id="inputState" class="form-select">
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
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="inputState" class="form-label">Mulai Pinjam</label>
                                <input type="date" class="form-control" name="startDate">
                            </div>
                            <div class="col">
                                <label for="inputState" class="form-label">Selesai Pinjam</label>
                                <input type="date" class="form-control" value="" name="finishDate">
                            </div>
                        </div> <br>
                </div>
            </div><br>
                        <h4>Data Barang</h4>
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
                                    <th scope="row">RMT01</th>
                                    <td>Remote AC</td>
                                    <td>Pak Wardi</td>
                                    <td>9</td>
                                    <td>
                                    <button type="button" class="btn btn-outline-warning btn-circle">-</button>
                                    <input type="text" name="qty" valu e="0"/>
                                    <button type="button" class="btn btn-outline-warning btn-circle">+</button>
                                    
                                        <!-- <input type="number" name="qty" id=""> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-outline-warning btn-lg">Kembali</button>
                            <button type="button" class="btn btn-outline-warning btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">Pinjam</button>
                        </div>
                    </form>
                <!-- </div> -->
            <!-- </div> -->
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content d-flex justify-content-center">
                    <div class="modal-body">
                        <h3>Peminjaman Berhasil</h3>
                        <p>Silakan menuju ke ruang inventaris!</p>
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="button" class="btn btn-warning">Baik</button><br>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<style>
    .btn-circle{
        border-radius: 50%;
    }
    .btn-outline-warning:hover{
        color: white;
        background-color: #FCD106;
    }
    .btn-warning{
        color: white;
    }
    thead{
        color: white;
        background-color: #FCD106;
    }
</style>
