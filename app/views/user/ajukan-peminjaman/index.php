<section class="container" id="custom--form-container">
    <div class="header">
        <h2 class="title">Detail Peminjaman</h2>
        <p class="desc">Pastikan data dan barang yang Anda pinjam sudah benar!</p>
    </div>
    <section class="custom--form-peminjaman-body">
        <h4 class="sub-title">Data Anda</h4>
        <section class="form-pinjam">
            <div class="form-wrapper">
                <form action="" method="post">
                    <div class="row">
                        <div class="col">
                            <label for="inputState" class="form-label">Nama</label>
                            <input id="nama" type="text" class="form-control" placeholder="Masukkan Nama" name="name" value="<?= $data['personal']['nama'] ?>" disabled>
                        </div>
                        <div class="col">
                            <label for="inputState" class="form-label">NIM/NIP</label>
                            <input id="nomor_identitas" type="text" class="form-control" placeholder="Masukkan NIM/NIP" name="idNumber" value="<?= $data['personal']['nomor_identitas'] ?>" disabled>

                        </div>
                        <div class="col">
                            <label for="inputState" class="form-label">Jumlah Hari</label>
                            <select id="inputState" class="form-control" onchange="updateFinishDate()">
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
                            <textarea id="alasan" class="form-textarea" rows="4" cols="50" name="keperluan" form="usrform" placeholder="Tulis keperluan meminjam barang tersebut" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="inputState" class="form-label">Mulai Pinjam</label>
                            <input id="startDate" type="date" class="form-control" name="startDate" onchange="updateFinishDate()" required>
                        </div>
                        <div class="col">
                            <label for="inputState" class="form-label">Selesai Pinjam</label>
                            <input id="finishDate" type="date" class="form-control" value="" name="finishDate" disabled required>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <h4 class="sub-title">Data Barang</h4>
        <section class="item-info">
            <div class="data-table">
                <?php
                if (isset($_COOKIE['myCookie'])) {
                    $decodedData = json_decode($data['dataListBarang']);

                    if ($decodedData !== null && isset($decodedData->myData)) {
                        $myData = $decodedData->myData;
                ?>
                        <table id="formPeminjaman">
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
                                foreach ($myData as $barang) : ?>
                                    <tr>
                                        <td><?php echo $barang->kodeBarang; ?></td>
                                        <td><?php echo $barang->namaBarang; ?></td>
                                        <td><?php echo $barang->namaPengelola; ?></td>
                                        <td><?php echo $barang->jumlahCheckout; ?></td>
                                    </tr>
                                <?php
                                endforeach; ?>
                            </tbody>
                        </table>
                <?php
                    } else {
                        // var_dump($decodedData);
                        echo "Data tidak valid atau kosong.";
                    }
                }
                ?>

            </div>
        </section>
        <section class="confirm-button">
            <button type="button" class="btn-kembali" onclick="backPage()">Kembali</button>
            <button type="submit" id="pinjam" class="btn-pinjam" name="btn-pinjam" id="modal">Pinjam</button>
        </section>

        <div id="myModal" class="modal" style="z-index: 100;" id="modalSuccess">
            <div class="modal-content">
                <img src="../assets/box.svg">
                <h3>Peminjaman Diproses</h3>
                <p>Silakan cek status peminjaman</p>
                <button type="button" class="close" id="successModalButton">Baik</button><br>
            </div>
        </div>

    </section>
</section>

<section class="custom--container-warning" id="customContainer">
    <div class="custom--warning" id="customWarning">
        <img src="../assets/warning.svg" alt="">

        <div class="custom--warning-content-text">
            <h3>Peringatan</h3>
            <p class="popupText"></p>
        </div>
    </div>

    <div class="custom--success" id="customSuccess">
        <img src="../assets/check.svg" alt="">
        <div class="custom--success-content-text">
            <h3>Berhasil</h3>
            <p class="popupText"></p>
        </div>
    </div>
</section>

<script src="../js/ajukan-peminjaman.js"></script>