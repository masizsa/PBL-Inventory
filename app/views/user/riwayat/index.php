<div class="custom--riwayat-container">
    <div class="custom--header">
        <h1>Riwayat Peminjaman</h1>
        <p>Lihat Riwayat Peminjaman Anda</p>
    </div>
    <div class="custom--body">
        <div class="custom--filter">
            <!-- <div class="custom--day-wrapper">
                <button class="active">70 Hari</button>
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
                    <ul class="dropdown">
                        <li class="p"><button id="latest">Tanggal Terkini</button></li>
                        <li class="P"><button id="oldest">Tanggal Terlama</button></li>
                    </ul>
                </li>
            </div>
            <div class="custom--search">
                <!-- <form action="" method="post"> -->
                <input type="text" name="search" id="search" placeholder="Cari Nama Barang">
                <!-- <button type="submit"> -->
                <div class="custom--search-icon">
                    <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.5 22.25C5.85 22.25 1.25 17.65 1.25 12C1.25 6.35 5.85 1.75 11.5 1.75C17.15 1.75 21.75 6.35 21.75 12C21.75 17.65 17.15 22.25 11.5 22.25ZM11.5 3.25C6.67 3.25 2.75 7.18 2.75 12C2.75 16.82 6.67 20.75 11.5 20.75C16.33 20.75 20.25 16.82 20.25 12C20.25 7.18 16.33 3.25 11.5 3.25Z" fill="#121212" />
                        <path d="M21.9999 23.25C21.8099 23.25 21.6199 23.18 21.4699 23.03L19.4699 21.03C19.1799 20.74 19.1799 20.26 19.4699 19.97C19.7599 19.68 20.2399 19.68 20.5299 19.97L22.5299 21.97C22.8199 22.26 22.8199 22.74 22.5299 23.03C22.3799 23.18 22.1899 23.25 21.9999 23.25Z" fill="#121212" />
                    </svg>
                </div>
                <!-- </button> -->
                <!-- </form> -->
            </div>
        </div>
        <div class="custom--table-wrapper">
            <?php
            $groupedData = [];
            foreach ($data['items'] as $item) {
                $idPeminjaman = $item['id_peminjaman'];
                if (!array_key_exists($idPeminjaman, $groupedDataDesc)) {
                    $groupedDataDesc[$idPeminjaman] = [];
                }
                $groupedDataDesc[$idPeminjaman][] = $item;
            }
            ?>

            <?php foreach ($groupedData as $idPeminjaman => $items) { ?>
                <div class="custom--card">
                    <table>
                        <h4 id="date-desc"><?= $items[0]['tgl_peminjaman'] ?></h4>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Nama Pengelola</th>
                            <th>Jumlah</th>
                        </tr>
                        <?php foreach ($items as $item) { ?>
                            <tr>
                                <td><?= $item['id_barang'] ?></td>
                                <td><?= $item['nama_barang'] ?></td>
                                <td><?= $item['nama_admin'] ?></td>
                                <td><?= $item['jumlah'] ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            <?php } ?>
        </div>

    </div>
</div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sortButtonLatest = document.getElementById("latest"); // Corrected selector
        const sortButtonOldest = document.getElementById("oldest"); // Corrected selector

        sortButtonLatest.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent form submission
            const pathname = window.location.pathname.replace(/&sort=(asc|desc)/g, '');
            window.location = pathname + "&sort=desc";
        });
        sortButtonOldest.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent form submission
            const pathname = window.location.pathname.replace(/&sort=(asc|desc)/g, '');
            window.location = pathname + "&sort=asc";
        });
    });
</script>