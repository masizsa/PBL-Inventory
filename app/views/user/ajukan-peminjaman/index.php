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
                        var_dump($decodedData);
                        echo "Data tidak valid atau kosong.";
                    }
                }
                ?>

            </div>
        </section>
        <section class="confirm-button">
            <button type="button" class="btn-kembali" onclick="backPage()">Kembali</button>
            <button type="submit" class="btn-pinjam" name="btn-pinjam" id="modal">Pinjam</button>
        </section>

        <div id="myModal" class="modal" style="z-index: 100;" id="modalSuccess">
            <div class="modal-content">
                <img src="../assets/box.svg">
                <h3>Peminjaman Diproses</h3>
                <p>Silakan cek status peminjaman</p>
                <form action="http://localhost/dasarWeb/PBL-Inventory/app/views/pages/barang-dipinjam/">
                    <button type="button" class="close">Baik</button><br>
                </form>
            </div>
        </div>

    </section>

    <script>
        // Get the modal
        let modal = document.getElementById("myModal");
        // Get the button that opens the modal
        let btn = document.getElementById("modal");
        // Get the <span> element that closes the modal
        let span = document.getElementsByClassName("close")[0];
        // When the user clicks the button, open the modal 

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
            let startDate = new Date(document.getElementById('startDate').value);
            let inputState = document.getElementById('inputState');
            let selectedDays = parseInt(inputState.options[inputState.selectedIndex].value);

            if (!isNaN(startDate.getTime())) {
                let finishDate = new Date(startDate);
                finishDate.setDate(finishDate.getDate() + selectedDays);
                let yyyy = finishDate.getFullYear();
                let mm = ('0' + (finishDate.getMonth() + 1)).slice(-2);
                let dd = ('0' + finishDate.getDate()).slice(-2);
                document.getElementById('finishDate').value = yyyy + '-' + mm + '-' + dd;
            }
        }

        const backPage = () => {
            window.location.href = 'http://localhost/PBL-Inventory/public/ajukanPeminjaman';
        }

        function createObjectsFromTable(tableId) {
            let dataObjects = [];

            let table = document.querySelector(tableId);
            let rowsHeader = table.querySelectorAll('thead')[0].querySelectorAll('th');
            let rows = table.querySelectorAll('tbody')[0].querySelectorAll('tr');

            console.log(rowsHeader[0].textContent);

            for (let i = 0; i < rows.length; i++) {
                let rowData = {};
                let cells = rows[i].querySelectorAll('td');
                for (let j = 0; j < cells.length; j++) {
                    let columnName = table.querySelectorAll('tbody')[0].querySelectorAll('tr')[0].querySelectorAll('td')[j].textContent.toLowerCase();
                    rowData[rowsHeader[j].textContent] = cells[j].innerText;
                }
                dataObjects.push(rowData)
            }

            return dataObjects;
        }


        const dataSent = () => {
            const nama = document.querySelector('#nama').value;
            const nomor_identitas = document.querySelector('#nomor_identitas').value;
            const alasan = document.querySelector('#alasan').value;
            const startDate = document.querySelector('#startDate').value;
            const endDate = document.querySelector('#finishDate').value;

            const formValue = {
                nama,
                nomor_identitas,
                alasan,
                startDate,
                endDate
            }
            const dataListBarang = createObjectsFromTable("#formPeminjaman");

            return {
                formValue,
                dataListBarang
            }
        }

        const succesPopup =document.querySelector('#modalSuccess')
        const errorPopup =document.querySelector('#modalError')
        $(document).ready(function() {
            // Ketika tombol diklik
            $("#modal").click(function() {
                // Menggunakan jQuery Ajax
                $.ajax({
                    type: "POST", // Metode pengiriman data
                    url: "http://localhost/PBL-Inventory/public/ajukanPeminjaman/processPinjam", // URL ke server PHP
                    data: dataSent(), // Data yang akan dikirim
                    contentType: "application/x-www-form-urlencoded",
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 'success') modal.style.display = "block";;
                        console.log(response.message);
                    },
                    error: function() {
                        // Callback yang dijalankan jika terjadi kesalahan
                        alert("Masukkan Data yang valid");
                    }
                });
            });
        });
    </script>