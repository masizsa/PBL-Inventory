    <div class="custom--container">
        <div class="custom--content">
            <header>
                <h1>Data Peminjaman</h1>
                <p>Silahkan konfirmasi peminjaman jika sudah siap!</p>
            </header>

            <div class="custom--body">
                <div class="custom--filter">
                    <div class="custom--day-wrapper">
                        <button class="active">Peminjaman</button>
                        <!-- <form action="" method="post"> -->
                            <button name="cekTerlambat">Pengembalian</button>
                        <!-- </form> -->
                    </div>
                    <div class="custom--search">
                        <input type="text" name="search" id="search" placeholder="Cari Nama Barang">
                        <div class="custom--search-icon">
                            <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.5 22.25C5.85 22.25 1.25 17.65 1.25 12C1.25 6.35 5.85 1.75 11.5 1.75C17.15 1.75 21.75 6.35 21.75 12C21.75 17.65 17.15 22.25 11.5 22.25ZM11.5 3.25C6.67 3.25 2.75 7.18 2.75 12C2.75 16.82 6.67 20.75 11.5 20.75C16.33 20.75 20.25 16.82 20.25 12C20.25 7.18 16.33 3.25 11.5 3.25Z" fill="#121212" />
                                <path d="M21.9999 23.25C21.8099 23.25 21.6199 23.18 21.4699 23.03L19.4699 21.03C19.1799 20.74 19.1799 20.26 19.4699 19.97C19.7599 19.68 20.2399 19.68 20.5299 19.97L22.5299 21.97C22.8199 22.26 22.8199 22.74 22.5299 23.03C22.3799 23.18 22.1899 23.25 21.9999 23.25Z" fill="#121212" />
                            </svg>
                        </div>
                    </div>
                </div>


                <div class="custom--table-info" id="table-peminjaman">
                    <h2>Peminjaman</h2>
                    <div class="custom--table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>Tanggal pinjam</th>
                                    <th>Kode</th>
                                    <th>Nama Barang</th>
                                    <th>Nama Peminjam</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $groupedData = [];
                                foreach ($data['items'] as $item) {
                                    $id_peminjaman = $item['id_peminjaman'];
                                    if (!array_key_exists($id_peminjaman, $groupedData)) {
                                        $groupedData[$id_peminjaman] = [];
                                    }
                                    $groupedData[$id_peminjaman][] = $item;
                                }

                                foreach ($groupedData as $id_peminjaman => $group) {

                                    foreach ($group as $index => $item) {
                                        echo '<td>' . $item['tanggal_pinjam'] . '</td>';
                                        echo '<td>' . $item['kode'] . '</td>';
                                        echo '<td>' . $item['nama_barang'] . '</td>';
                                        echo '<td class="custom--first-child">' . $item['nama_peminjam'] . '</td>';
                                        if ($index === 0) {
                                            echo '<td rowspan="' . count($group) . '" class="custom--confirm">';
                                            echo '<div class="custom--aksi">'; ?>
                                            <form method="POST" action="">

                                                <input type="hidden" name="update" value="<?php echo $item['id_peminjaman']; ?>">
                                                <!-- Tambahkan tombol submit atau aksi lain yang Anda perlukan -->
                                                <button type="submit" name="confirmBtn" class="button-confirm">Konfirmasi</button>
                                            </form>

                                <?php
                                            echo '<button class="button-info">';
                                            echo '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" style="vertical-align: middle;" xmlns="http://www.w3.org/2000/svg">';
                                            // ... (SVG code)
                                            echo '</svg>';
                                            echo '</button>';
                                            echo '</div>';
                                            echo '</td>';
                                        }
                                        echo '</tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="custom--table-info" id="table-pengembalian">
                    <h2>Pengembalian</h2>
                    <div class="custom--table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>Tanggal pinjam</th>
                                    <th>Kode</th>
                                    <th>Nama Barang</th>
                                    <th>Nama Peminjam</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr>
                                    <?php
                                    $groupedData = [];
                                    foreach ($data['items2'] as $item) {
                                        $id_peminjaman = $item['id_peminjaman'];
                                        if (!array_key_exists($id_peminjaman, $groupedData)) {
                                            $groupedData[$id_peminjaman] = [];
                                        }
                                        $groupedData[$id_peminjaman][] = $item;
                                    }

                                    foreach ($groupedData as $id_peminjaman => $group) {
                                        foreach ($group as $index => $item) {
                                            echo '<td>' . $item['tanggal_pinjam'] . '</td>';
                                            echo '<td>' . $item['kode'] . '</td>';
                                            echo '<td>' . $item['nama_barang'] . '</td>';
                                            echo '<td class="custom--first-child">' . $item['nama_peminjam'] . '</td>';
                                            if ($index === 0) {
                                                echo '<td rowspan="' . count($group) . '" class="custom--confirm">';
                                    ?>
                                                <!-- <form method="POST" action="">
                                                    <input type="hidden" name="checkStatus" value="<?php echo $item['id_peminjaman']; ?>">
                                                </form> -->
                                                <div class="custom--status">
                                                    <?php if ($item['status'] === 'Dipinjam') { ?>
                                                        <div class="custom--status-value" id="status-dipinjam">
                                                            <p>Dipinjam</p>
                                                        </div>
                                                    <?php } elseif ($item['status'] === 'Validasi') { ?>
                                                        <div class="custom--status-value" id="status-validasi">
                                                            <p>Validasi</p>
                                                        </div>
                                                    <?php } elseif ($item['status'] === 'Terlambat') { ?>
                                                        <div class="custom--status-value" id="status-terlambat">
                                                            <p>Terlambat</p>
                                                        </div>
                                                    <?php } else { ?>
                                                        <!-- Tampilkan default atau pesan jika status tidak sesuai -->
                                                        <p>Status tidak valid</p>
                                                    <?php } ?>
                                                </div>
                                                </td>
                                            <?php
                                            }
                                            if ($index === 0) {
                                                echo '<td rowspan="' . count($group) . '" class="custom--confirm">';
                                                echo '<div class="custom--aksi">';
                                            ?>
                                                <form method="POST" action="">
                                                    <input type="hidden" name="updateSelesai" value="<?php echo $item['id_peminjaman']; ?>">
                                                    <!-- Tambahkan tombol submit atau aksi lain yang Anda perlukan -->
                                                    <button type="submit" name="confirmBtnPengembalian" class="button-confirm">Konfirmasi</button>
                                                </form>
                                    <?php
                                                // echo '<button class="button-confirm" type="submit" name="confirmBtnPengembalian" >Konfirmasi</button>';
                                                echo '<button class="button-info">';
                                                echo '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" style="vertical-align: middle;" xmlns="http://www.w3.org/2000/svg">';
                                                // ... (SVG code)
                                                echo '</svg>';
                                                echo '</button>';
                                                echo '</div>';
                                            }
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                    }
                                    ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="popup-container">
        <div class="custom--content-popup">
            <div class="custom--row">
                <div class="custom--row-info">
                    <label for="">Nama</label>
                    <input type="text" disabled>
                </div>
                <div class="custom--row-info">
                    <label for="">NIM/NIP</label>
                    <input type="text" disabled>
                </div>
                <div class="custom--row-info">
                    <label for="">Jumlah Hari</label>
                    <input type="text" disabled>
                </div>
            </div>

            <div class="custom--desc">
                <label for="">Keterangan</label>
                <textarea name="" id="" cols="30" rows="10" disabled></textarea>
            </div>

            <div class="custom--row">
                <div class="custom--row-info">
                    <label for="">Mulai Pinjam</label>
                    <input type="text" disabled>
                </div>
                <div class="custom--row-info">
                    <label for="">Selesai Pinjam</label>
                    <input type="text" disabled>
                </div>
            </div>

            <button class="custom--popup-close" id="custom--close-popup">x</button>
        </div>
    </div>
    <script>
        const buttons = document.querySelectorAll(".custom--day-wrapper button");
        const tables = document.querySelectorAll(".custom--table-info");
        const detailsButtons = document.querySelectorAll(".button-info");
        const popupContainer = document.querySelector(".popup-container");
        const closePopupButton = document.getElementById("custom--close-popup");
        const headerTitle = document.querySelector("header h1");
        const subheader = document.querySelector("header p");


        buttons.forEach((button, index) => {
            button.addEventListener('click', () => {
                buttons.forEach((btn) => {
                    btn.classList.remove('active');
                });

                tables.forEach((table) => {
                    table.style.display = 'none';
                });

                button.classList.add('active');
                tables[index].style.display = 'flex';

                headerTitle.textContent =
                    index === 0 ? "Data Peminjaman" : "Data Pengembalian";

                subheader.textContent = index === 0 ? "Silahkan konfirmasi peminjaman jika sudah siap!" : "Silahkan konfirmasi pengembalian jika sudah benar!";
            });
        });

        detailsButtons.forEach((detailsButton) => {
            detailsButton.addEventListener('click', () => {
                popupContainer.style.display = 'flex';
            });
        });

        closePopupButton.addEventListener('click', () => {
            popupContainer.style.display = 'none';
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                popupContainer.style.display = 'none';
            }
        });

        const tbodies = document.querySelectorAll('tbody');
        tbodies.forEach(tbody => {
            const customConfirms = tbody.querySelectorAll('.custom--confirm');
            const lastCustomConfirm = customConfirms[customConfirms.length - 1];
            lastCustomConfirm.style.borderBottomRightRadius = '1rem';
        });
    </script>