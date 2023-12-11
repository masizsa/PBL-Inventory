<html>
<!-- <link rel="stylesheet" href="../../../../public/css/riwayat-admin.css"> -->
<div class="custom--riwayat-container">
    <div class="custom--header">
        <h1>Riwayat Peminjaman</h1>
        <p>Lihat Riwayat Peminjaman Anda</p>
    </div>
    <div class="custom--body">
        <div class="custom--filter">
            <div class="custom--left">
                <!-- <div class="custom--day-wrapper">
                    <button class="active">7 Hari</button>
                    <button>30 Hari</button>
                    <button>12 Bulan</button>
                    <button>Semua</button>
                </div> -->
                <div class="custom--sort-wrapper">
                    <li style="--delay: 2;" tabindex="0">
                        <button>
                            <img class="icon-sort" src="../../../../public/assets/sort.svg" alt="">
                            <span class="text">Urutkan</span>
                        </button>
                        <!-- <form action="../../../controllers/riwayatAdmin.php" method="post"> -->
                            <ul class="dropdown">
                                <li class="p"><button id="latest">Tanggal Terkini</button></li>
                                <li class="P"><button id="oldest">Tanggal Terlama</button></li>
                            </ul>
                        <!-- </form> -->
                    </li>
                </div>
            </div>
            <div class="custom--search">
                <input type="text" name="search" id="search" placeholder="Cari Nama Barang" autocomplete="off">
                <div class="custom--search-icon">
                    <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.5 22.25C5.85 22.25 1.25 17.65 1.25 12C1.25 6.35 5.85 1.75 11.5 1.75C17.15 1.75 21.75 6.35 21.75 12C21.75 17.65 17.15 22.25 11.5 22.25ZM11.5 3.25C6.67 3.25 2.75 7.18 2.75 12C2.75 16.82 6.67 20.75 11.5 20.75C16.33 20.75 20.25 16.82 20.25 12C20.25 7.18 16.33 3.25 11.5 3.25Z" fill="#121212" />
                        <path d="M21.9999 23.25C21.8099 23.25 21.6199 23.18 21.4699 23.03L19.4699 21.03C19.1799 20.74 19.1799 20.26 19.4699 19.97C19.7599 19.68 20.2399 19.68 20.5299 19.97L22.5299 21.97C22.8199 22.26 22.8199 22.74 22.5299 23.03C22.3799 23.18 22.1899 23.25 21.9999 23.25Z" fill="#121212" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="custom--table-wrapper">
            <div class="custom--card">
                <h4>Data Riwayat</h4>
                <table id="table-descending">
                    <tr>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Nama Peminjam</th>
                        <th>Jumlah</th>
                    </tr>
                    <?php
                    foreach ($data['desc'] as $row) { ?>
                        <tr>
                            <td><?= $row['tgl_peminjaman'] ?></td>
                            <td><?= $row['tgl_pengembalian'] ?></td>
                            <td><?= $row['id_barang'] ?></td>
                            <td><?= $row['nama_barang'] ?></td>
                            <td><?= $row['nama_peminjam'] ?></td>
                            <td><?= $row['jumlah'] ?></td>
                        </tr>
                    <?php    }
                    ?>
                </table>
                <table id="table-ascending" style="display: none">
                    <tr>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Nama Peminjam</th>
                        <th>Jumlah</th>
                    </tr>
                    <?php
                    foreach ($data['asc'] as $row) { ?>
                        <tr>
                            <td><?= $row['tgl_peminjaman'] ?></td>
                            <td><?= $row['tgl_pengembalian'] ?></td>
                            <td><?= $row['id_barang'] ?></td>
                            <td><?= $row['nama_barang'] ?></td>
                            <td><?= $row['nama_peminjam'] ?></td>
                            <td><?= $row['jumlah'] ?></td>
                        </tr>
                    <?php    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sortButtonLatest = document.getElementById("latest"); // Corrected selector
        const sortButtonOldest = document.getElementById("oldest"); // Corrected selector
        const descendingTable = document.getElementById("table-descending");
        const ascendingTable = document.getElementById("table-ascending");

        sortButtonLatest.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent form submission

            const selectedOption = event.currentTarget.textContent.trim();

            // console.log(sortButtonLatest);

            // Check the selected option and sort accordingly
            if (selectedOption === "Tanggal Terkini") {
                // Sort in descending order
                descendingTable.style.display = "table";
                ascendingTable.style.display = "none";
            } else{
                // Sort in ascending order
                ascendingTable.style.display = "table";
                descendingTable.style.display = "none";
            }
        });
        sortButtonOldest.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent form submission

            const selectedOption = event.currentTarget.textContent.trim();

            // console.log(sortButtonOldest);

            // Check the selected option and sort accordingly
            if (selectedOption === "Tanggal Terkini") {
                // Sort in descending order
                descendingTable.style.display = "table";
                ascendingTable.style.display = "none";
            } else{
                // Sort in ascending order
                ascendingTable.style.display = "table";
                descendingTable.style.display = "none";
            }
        });
    });
</script>

</html>