<div class="container">
    <div class="header">
        <h2 class="title">Detail Peminjaman</h2>
        <p class="desc">Pastikan data dan barang yang Anda pinjam sudah benar!</p>
    </div>
    <h4 class="sub-title">Data Anda</h4>
    <div class="section1">
        <div class="form-wrapper">
            <form action="" method="post">
                <div class="row">
                    <div class="col">
                        <label for="inputState" class="form-label">Nama</label>
                        <input type="text" class="form-control" placeholder="Masukkan Nama" name="name">
                    </div>
                    <div class="col">
                        <label for="inputState" class="form-label">NIM/NIP</label>
                        <input type="text" class="form-control" placeholder="Masukkan NIM/NIP" name="idNumber">
                    </div>
                    <div class="col">
                        <label for="inputState" class="form-label">Jumlah Hari</label> <br>
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
                <div class="row">
                    <div class="col">
                        <label for="inputState" class="form-label">Mulai Pinjam</label>
                        <input type="date" class="form-control" name="startDate">
                    </div>
                    <div class="col">
                        <label for="inputState" class="form-label">Selesai Pinjam</label>
                        <input type="date" class="form-control" value="" name="finishDate">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <h4 class="sub-title">Data Barang</h4>
    <div class="section2">
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
                        <button type="button" class="btn-tambah">tambah</button>
                    </td>
                </tr>
                <tr>
                    <td>KB01</td>
                    <td>Kursi Biru</td>
                    <td>Pak Sulaiman</td>
                    <td>10</td>
                    <td class="qty">
                        <button type="button" class="btn-outline-warning">-</button>
                        <h4>3</h4>
                        <button type="button" class="btn-outline-warning">+</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="section3">
        <button type="button" class="btn-lg">Kembali</button>
        <button type="button" class="btn-lg" id="modal">Pinjam</button>
    </div>
</div>

<div id="myModal" class="modal">
    <div class="modal-content">
        <img src="../../../../public/assets/box.svg">
        <h3>Peminjaman Berhasil</h3>
        <p>Silakan menuju ke ruang inventaris!</p>
        <button type="button" class="close">Baik</button><br>
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
</script>