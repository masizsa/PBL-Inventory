<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/sidebar.css">
    <link rel="stylesheet" href="../../css/barang-dipinjam.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&family=Josefin+Sans&family=Manjari&family=Poppins:wght@400;500;600&family=Rubik&display=swap" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="custom--container">
        <?php include("../../layouts/sidebar.php"); ?>

        <div class="custom--content">
            <div class="header-container">
                <div class="text-header">
                    <h1>Data Barang Dipinjam</h1>
                    <p>Jaga baik-baik barang tersebut dan jangan terlambat mengembalikan!</p>
                </div>
            
                <div class="countdown">
                    <p>Waktu pengembalian</p>
                    <div class="countdown-container">
                        <table class="countdown-table">
                            <tr>
                                <td class="return-date" id="days"></td>
                                <td class="return-date" id="hours"></td>
                                <td class="return-date" id="minutes"></td>
                                <td class="return-date" id="month"></td>
                            </tr>                            
                            <tr>
                                <td class="countdown-label">Hari</td>
                                <td class="countdown-label">Jam</td>
                                <td class="countdown-label">Menit</td>
                                <td class="countdown-label" id="month-label">Month</td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
    
            <div class="custom--borrowed">
                <div class="borrowed-one">
                    <p class="subheader-borrowed">Peminjaman - 1</p>
                    <div class="container-borrowed">
                        <div class="date-period">
                            <div class="start-date">
                                <p class="date-label">Mulai pinjam</p> 
                                <input type="text" name="" class="borrow-date">
                            </div>
                            <div class="end-date">
                                <p class="date-label">Selesai pinjam</p>
                                <input type="text" name="" class="borrow-date">
                            </div>
                            <div class="status">
                                <p class="date-label">Status</p>
                                <p class="status-label">Dipinjam</p>
                            </div>
                        </div>

                        <div class="item-info">
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
                                    <tr>
                                        <td>RMT01</td>
                                        <td>Remote Ac</td>
                                        <td>Pak Wardi</td>
                                        <td>9</td>
                                    </tr>
                                    <tr>
                                        <td>RMT01</td>
                                        <td>Remote Ac</td>
                                        <td>Pak Wardi</td>
                                        <td>9</td>
                                    </tr>
                                    <?php
                                    // Loop through the fetched data and populate the table
                                    // while ($row = $result->fetch_assoc()) {
                                    //     echo "<tr>";
                                    //     echo "<td>{$row['kode']}</td>";
                                    //     echo "<td>{$row['nama_barang']}</td>";
                                    //     echo "<td>{$row['nama_pengelola']}</td>";
                                    //     echo "<td>{$row['jumlah']}</td>";
                                    //     echo "</tr>";
                                    // }

                                    // Close the database connection
                                    // $conn->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="borrowed-two">
                    <p class="subheader-borrowed">Peminjaman - 2</p>
                    <div class="container-borrowed">
                        <p class="no-items">Tidak ada peminjaman</p>
                    </div>
                </div>
            </div>
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
                    const monthLabel = endDateTime.toLocaleString('id-ID', { month: 'short' });

                    document.getElementById('days').innerHTML = days;
                    document.getElementById('hours').innerHTML = hours;
                    document.getElementById('minutes').innerHTML = minutes;
                    document.getElementById('month-label').innerHTML = monthLabel;
                    document.getElementById('month').innerHTML = endDateTime.getDate();
                }
            }

            // Retrieve the date from the db 
            const returnDateFromDatabase = "2023-12-31 23:59:59";

            // Call the updateCountdown w/ the retrieved return date
            updateCountdown(returnDateFromDatabase);
            setInterval(() => {
                updateCountdown(returnDateFromDatabase);
            }, 1000);

        </script>

</body>

</html>
