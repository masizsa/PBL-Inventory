<div class="custom--container-barang-dipinjam">
    <div class="custom--content-barang-dipinjam">
        <header>
            <section class="custom--text-header">
                <h1>Data Barang Dipinjam</h1>
                <p>Jaga baik-baik barang tersebut dan jangan terlambat mengembalikan!</p>
            </section>

            <section class="custom--countdown">
                <p class="countdown-text">Waktu pengembalian</p>
                <div class="custom--container-countdown">
                    <div class="custom--time">
                        <p class="return-date" id="days"></p>
                        <p class="countdown-label">Hari</p>
                    </div>

                    <div class="colon">:</div>

                    <div class="custom--time">
                        <p class="return-date" id="hours"></p>
                        <p class="countdown-label">Jam</p>
                    </div>

                    <div class="colon">:</div>

                    <div class="custom--time">
                        <p class="return-date" id="minutes"></p>
                        <p class="countdown-label">Menit</p>
                    </div>

                    <div class="vertical-line">

                    </div>
                    <div class="custom--time">
                        <p class="return-date" id="month"></p>
                        <p class="countdown-label" id="month-label"></p>
                    </div>
                </div>
            </section>
        </header>

        <main>
            <?php
            $number = 1;
            $groupedData = [];
            foreach ($data['datas'] as $item) {
                $idPeminjaman = $item['id_peminjaman'];
                if (!array_key_exists($idPeminjaman, $groupedData)) {
                    $groupedData[$idPeminjaman] = [];
                }
                $groupedData[$idPeminjaman][] = $item;
            } ?>

            <section class="custom--borrowed-one">
                <?php

                foreach ($groupedData as $idPeminjaman => $items) {
                ?>
                    <p class="custom--subheader-borrowed">Peminjaman - <?php echo $number ?></p>
                    <?php $number++ ?>
                    <div class="custom--container-borrowed-items">
                        <div class="custom--borrowed-info">
                            <div class="custom--start-date">
                                <p class="info-label">Mulai pinjam</p>
                                <input type="text" name="start_date" class="borrow-date" id="start-date" value="<?php echo $item['tgl_peminjaman']; ?>" size="35" disabled>
                            </div>
                            <div class="custom--end-date">
                                <p class="info-label">Selesai pinjam</p>
                                <input type="text" name="end_date" class="borrow-date" id="end-date" value="<?php echo $item['tgl_pengembalian']; ?>" size="35" disabled>
                            </div>

                            <div class="custom--status">
                                <p class="info-label">Status</p>

                                <?php
                                $status = $item['status']; // Ambil nilai status dari variabel $item['status']

                                if ($status === 'Dipinjam') { ?>
                                    <div class="custom--status-value-dipinjam" id="status-dipinjam">
                                        <p><?php echo $status ?></p>
                                    </div>
                                <?php } elseif ($status === 'Menunggu') { ?>
                                    <div class="custom--status-value-dipinjam" id="status-menunggu">
                                        <p><?php echo $item['status'] ?></p>
                                    </div>
                                <?php } elseif ($status === 'Terlambat') { ?>
                                    <div class="custom--status-value-terlambat" id="status-terlambat">
                                        <p><?php echo $status ?></p>
                                    </div>
                                <?php } else { ?>
                                    <!-- Tambahkan logika untuk status lain jika diperlukan -->
                                    <div class="custom--status-value-default" id="status-default">
                                        <p><?php echo $status ?></p>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>

                        <div class="custom--item-info-dipinjam">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama Barang</th>
                                        <th>Nama Pengelola</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <div class="custom--card">
                                        <table>
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
                                </tbody>
                            </table>
            </section>
        <?php } ?>
        </main>
    </div>





    <section class="custom--borrowed-two">
        <p class="custom--subheader-borrowed">Peminjaman - <?php echo $number ?></p>
        <div class="custom--container-borrowed-items-empty">
            <p>Tidak ada peminjaman</p>
        </div>
    </section>

    </main>
</div>
</div>

<script src="../../layouts/sidebar.js"></script>
<script>
    function updateCountdown(endDate) {
        const now = new Date();
        const endDateTime = new Date(endDate);
        const timeDifference = endDateTime - now;

        if (timeDifference <= 0) {
            // If expired
            document.getElementById('return-date').innerHTML = 'Expired';
        } else {
            // Calculate days, hours, minutes
            const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
            const monthLabel = endDateTime.toLocaleString('id-ID', {
                month: 'short'
            });

            document.getElementById('days').innerHTML = days;
            document.getElementById('hours').innerHTML = hours;
            document.getElementById('minutes').innerHTML = minutes;
            document.getElementById('month-label').innerHTML = monthLabel;
            document.getElementById('month').innerHTML = endDateTime.getDate();
        }
    }
    // BACKEND BRO
    // Retrieve the date from the db 
    // const returnDateFromDatabase = "<?php echo $formattedReturnDate; ?>";

    // Call the updateCountdown w/ the retrieved return date
    updateCountdown(returnDateFromDatabase);
    setInterval(() => {
        updateCountdown(returnDateFromDatabase);
    }, 1000);
</script>