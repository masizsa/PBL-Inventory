<section class="custom--pilih-barang-main-container">
    <header class="custom--header-pilih-barang">
        <h1>Selamat Datang di SIVENTI 👋</h1>
        <p>Silakan cari barang yang ingin Anda pinjam, pilih yang Anda perlukan, dan tentukan jumlahnya!</p>
    </header>
    <div class="custom--body-pilih-barang-container">
        <div class="custom--list-items-pilih-barang">
            <header class="custom--list-barang-dipilih-header">
                <label for="">Barang yang dipilih</label>
                <button id="sendDataPilihBarang">Lanjut</button>
            </header>
            <div class="custom--list-barang-dipilih-body">
                <!-- Tidak ada barang yang dipilih -->
                <!-- <div class="custom--card-checkout">
                    <div class="custom--card-checkout-left">
                        <div style="font-size: 12px;">RMT01</div>
                        <div style="font-size: 20px; font-weight: 600;">Remote AC</div>
                        <div style="font-size: 14px;">Pak Wardi</div>
                    </div>
                    <div class="custom--card-checkout-right">
                        <div style="font-size: 12px;">Jumlah</div>
                        <div style="font-size: 20px; font-weight: 600;" class="custom--total-card-qty">
                            1
                        </div>
                    </div>
                    <button class="custom--button-uncheckout"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 0C4.49 0 0 4.49 0 10C0 15.51 4.49 20 10 20C15.51 20 20 15.51 20 10C20 4.49 15.51 0 10 0ZM13.36 12.3C13.65 12.59 13.65 13.07 13.36 13.36C13.21 13.51 13.02 13.58 12.83 13.58C12.64 13.58 12.45 13.51 12.3 13.36L10 11.06L7.7 13.36C7.55 13.51 7.36 13.58 7.17 13.58C6.98 13.58 6.79 13.51 6.64 13.36C6.35 13.07 6.35 12.59 6.64 12.3L8.94 10L6.64 7.7C6.35 7.41 6.35 6.93 6.64 6.64C6.93 6.35 7.41 6.35 7.7 6.64L10 8.94L12.3 6.64C12.59 6.35 13.07 6.35 13.36 6.64C13.65 6.93 13.65 7.41 13.36 7.7L11.06 10L13.36 12.3Z" fill="#FCD106" />
                        </svg>
                    </button>
                </div> -->
            </div>
        </div>
        <div class="custom--container-list-pilih-data-barang">
            <div class="custom--search-list-items-pilih-barang">
                <div>Data Barang</div>
                <div class="custom--input-search-pilih-barang">
                    <input type="text" placeholder="Cari Nama Barang" oninput="searchItem(event)">
                    <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.5 22.25C5.85 22.25 1.25 17.65 1.25 12C1.25 6.35 5.85 1.75 11.5 1.75C17.15 1.75 21.75 6.35 21.75 12C21.75 17.65 17.15 22.25 11.5 22.25ZM11.5 3.25C6.67 3.25 2.75 7.18 2.75 12C2.75 16.82 6.67 20.75 11.5 20.75C16.33 20.75 20.25 16.82 20.25 12C20.25 7.18 16.33 3.25 11.5 3.25Z" fill="#121212" />
                        <path d="M21.9999 23.25C21.8099 23.25 21.6199 23.18 21.4699 23.03L19.4699 21.03C19.1799 20.74 19.1799 20.26 19.4699 19.97C19.7599 19.68 20.2399 19.68 20.5299 19.97L22.5299 21.97C22.8199 22.26 22.8199 22.74 22.5299 23.03C22.3799 23.18 22.1899 23.25 21.9999 23.25Z" fill="#121212" />
                    </svg>
                </div>
            </div>

            <table class="custom--table-pilih-barang" id="main-tabel-barang">
                <tr>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Nama Pengelola</th>
                    <th>Tersedia</th>
                    <th>Pilih</th>
                </tr>
                <!-- <tr>
                    <td id="kode2">RMT03</td>
                    <td id="nama2">Remote AC</td>
                    <td id="pengelola2">Pak Wardi</td>
                    <td id="tersedia2">9</td>
                    <td>
                        <div class="custom--container-tambah-barang" id="barang2">
                            <button onclick="increment(this,'2'); scroollTo('2'); addToCheckout('2', 'tersedia2', 'totalPilihBarang2', 'barang2', 'indecrement2', 'decButton2', 'incButton2');renderCard()">Tambah</button>
                            <div class="custom--indecrement" id="indecrement2">
                                <button onclick="decrement(this,'2'); scroollTo('2'); minToCheckout('2');renderCard()" class="items" id="decButton2">-</button>
                                <input id="totalPilihBarang2" class="items" type="text" value="0">
                                <button onclick="increment(this,'2'); addToCheckout('2', 'tersedia2', 'totalPilihBarang2', 'barang2', 'indecrement2', 'decButton2', 'incButton2'); renderCard()" class="items" id="incButton2">+</button>
                            </div>
                        </div>
                    </td>
                </tr> -->
                <?php $index = 1;
                foreach ($data['datas'] as $barang) : ?>
                    <tr>
                        <td id="kode<?= $index ?>"><?php echo $barang['id_barang']; ?></td>
                        <td id="nama<?= $index ?>"><?php echo $barang['nama_barang']; ?></td>
                        <td id="pengelola<?= $index ?>"><?php echo $barang['nama_admin']; ?></td>
                        <td id="tersedia<?= $index ?>"><?php echo $barang['jumlah_tersedia']; ?></td>
                        <td>
                            <div class="custom--container-tambah-barang" id="barang<?= $index ?>">
                                <button onclick="increment(this, '<?= $index ?>'); scroollTo('<?= $index ?>'); addToCheckout('<?= $index ?>', 'tersedia<?= $index ?>', 'totalPilihBarang<?= $index ?>', 'barang<?= $index ?>', 'indecrement<?= $index ?>', 'decButton<?= $index ?>', 'incButton<?= $index ?>'); renderCard()">Tambah</button>
                                <div class="custom--indecrement" id="indecrement<?= $index ?>">
                                    <button onclick="decrement(this, '<?= $index ?>'); scroollTo('<?= $index ?>'); minToCheckout('<?= $index ?>'); renderCard()" class="items" id="decButton<?= $index ?>">-</button>
                                    <input id="totalPilihBarang<?= $index ?>" class="items" type="text" value="0">
                                    <button onclick="increment(this, '<?= $index ?>'); addToCheckout('<?= $index ?>', 'tersedia<?= $index ?>', 'totalPilihBarang<?= $index ?>', 'barang<?= $index ?>', 'indecrement<?= $index ?>', 'decButton<?= $index ?>', 'incButton<?= $index ?>'); renderCard()" class="items" id="incButton<?= $index ?>">+</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php $index++;
                endforeach; ?>
            </table>

        </div>

    </div>
</section>
<script>
    let total = 0;
    let checkoutItems = [];
    let sendListData = [];
    const buttonLanjut = document.querySelector('.custom--list-barang-dipilih-header > button')
    buttonLanjut.disabled = true;

    $(document).ready(function() {
        $("#sendDataPilihBarang").click(function() {
            $.ajax({
                type: "POST",
                url: "http://localhost/PBL-Inventory/public/formPeminjaman",
                contentType: "application/json",
                data: JSON.stringify({
                    myData: checkoutItems
                }),
                success: function(response) {
                    // console.log(response);
                    window.location.href = 'http://localhost/PBL-Inventory/public/ajukanPeminjaman/formPeminjaman'
                },
                error: function() {
                    alert("Error in AJAX request");
                }
            });
        });
    });


    const increment = (button, id) => {
        const max = parseInt(document.querySelector(`#tersedia${id}`).textContent);
        const minButton = document.querySelector(`#decButton${id}`);
        const target = document.querySelector(`#totalPilihBarang${id}`);

        let tmp = parseInt(target.value) + 1;

        button.disabled = max <= tmp;
        minButton.disabled = false;
        target.value = tmp;
    }

    const decrement = (button, id) => {
        const max = parseInt(document.querySelector(`#tersedia${id}`).textContent);
        const plusButton = document.querySelector(`#incButton${id}`);
        const target = document.querySelector(`#totalPilihBarang${id}`);

        let tmp = parseInt(target.value) - 1;

        button.disabled = tmp <= 0;
        plusButton.disabled = false;
        target.value = tmp;
    }

    const scroollTo = (id, dependent = 0) => {
        const targetTop = document.querySelector(`#barang${id} > button`);
        const targetBottom = document.querySelector(`#indecrement${id}`);
        const boxCheckout = document.querySelector(`#indecrement${id} input`);
        let dependencies = dependent ? dependent : document.querySelector(`#totalPilihBarang${id}`).value;
        console.log("dependencies " + dependencies);

        if (dependencies > 0) {
            targetBottom.classList.add('show');
            targetTop.classList.add('show');
        } else {
            boxCheckout.value = 0;
            targetBottom.classList.remove('show');
            targetTop.classList.remove('show');;
        }
    }

    const addToCheckout = (id, asalTersedia, asalTotalBarang, target1, target2, buttonMin, buttonPlus) => {
        const kodeBarang = document.querySelector(`#kode${id}`);
        const namaBarang = document.querySelector(`#nama${id}`);
        const namaPengelola = document.querySelector(`#pengelola${id}`);
        const jumlahTersedia = document.querySelector(`#tersedia${id}`);
        let jumlahCheckout = parseInt(document.querySelector(`#totalPilihBarang${id}`).value);


        const objectIndex = checkoutItems.findIndex(item => item.kodeBarang == kodeBarang.textContent);

        if (objectIndex !== -1) {
            checkoutItems[objectIndex].jumlahCheckout += 1;
        } else {
            checkoutItems.push({
                kodeBarang: kodeBarang.textContent,
                namaBarang: namaBarang.textContent,
                namaPengelola: namaPengelola.textContent,
                jumlahCheckout,
                asalTersedia,
                asalTotalBarang,
                target1,
                target2,
                buttonMin,
                buttonPlus
            });
        }

        if (lanjut()) {
            buttonLanjut.disabled = false;
            buttonLanjut.classList.add('active')
        } else {
            buttonLanjut.disabled = true;
            buttonLanjut.classList.remove('active')
        }

    }

    const minToCheckout = (id) => {
        const kodeBarang = document.querySelector(`#kode${id}`);
        const namaBarang = document.querySelector(`#nama${id}`);
        const namaPengelola = document.querySelector(`#pengelola${id}`);
        const jumlahTersedia = document.querySelector(`#tersedia${id}`);
        let jumlahCheckout = parseInt(document.querySelector(`#totalPilihBarang${id}`).value);

        const objectIndex = checkoutItems.findIndex(item => item.kodeBarang == kodeBarang.textContent);

        if (objectIndex !== -1) {
            checkoutItems[objectIndex].jumlahCheckout -= 1;
            if (checkoutItems[objectIndex].jumlahCheckout <= 0) {
                checkoutItems = checkoutItems.filter(objek => objek.jumlahCheckout !== 0);
            }
        }

        if (lanjut()) {
            buttonLanjut.disabled = false;
            buttonLanjut.classList.add('active')
        } else {
            buttonLanjut.disabled = true;
            buttonLanjut.classList.remove('active')
        }

    }

    const deleteCheckoutItem = (idCard, kode, id) => {
        const card = document.querySelector(`#${idCard}`)
        const indentifier = [...document.querySelectorAll(".custom--table-pilih-barang tr td:first-child")];
        const boxJumlahCheckout = document.querySelectorAll(".custom--table-pilih-barang tr td input");
        let jumlahCheckout = document.querySelector(`#totalPilihBarang${id}`);
        const minButton = document.querySelector(`#incButton${id}`)
        const plusButton = document.querySelector(`#decButton${id}`);


        const objectIndex = checkoutItems.findIndex(item => item.kodeBarang == kode);
        const tableIndex = indentifier.findIndex(kodeBarang => kodeBarang.textContent == kode)

        card.style.display = 'none';
        if (objectIndex !== -1) {
            checkoutItems = checkoutItems.filter(objek => objek.kodeBarang !== kode);
            boxJumlahCheckout[objectIndex].value = 0;
        }
        // console.log("index " + tableIndex);

        try {
            scroollTo(tableIndex + 1, boxJumlahCheckout[objectIndex].value);
        } catch (error) {
            return
        }
        // renderCard()
        minButton.disabled = false;
        plusButton.disabled = false;
        if (lanjut()) {
            buttonLanjut.disabled = false;
            buttonLanjut.classList.add('active')
        } else {
            buttonLanjut.disabled = true;
            buttonLanjut.classList.remove('active')
        }
        // console.log(checkoutItems);
    }

    const renderCard = () => {
        const container = document.querySelector('.custom--list-barang-dipilih-body');

        container.innerHTML = '';
        let index = 1;
        checkoutItems.forEach((itemCard) => {
            if (itemCard.jumlahCheckout <= 0) {
                return;
            } else {
                container.innerHTML += `
                    <div class="custom--card-checkout" id="card${index}">
                            <div class="custom--card-checkout-left">
                                <div style="font-size: 12px;">${itemCard.kodeBarang}</div>
                                <div style="font-size: 20px; font-weight: 500;">${itemCard.namaBarang}</div>
                                <div style="font-size: 14px;">${itemCard.namaPengelola}</div>
                            </div>
                            <div class="custom--card-checkout-right">
                                <div style="font-size: 12px;">Jumlah</div>
                                <div style="font-size: 20px; font-weight: 600;" class="custom--total-card-qty">
                                    ${itemCard.jumlahCheckout}
                                </div>
                            </div>
                            <button  onclick = "deleteCheckoutItem('card${index}','${itemCard.kodeBarang}', '${index}')" class="custom--button-uncheckout"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 0C4.49 0 0 4.49 0 10C0 15.51 4.49 20 10 20C15.51 20 20 15.51 20 10C20 4.49 15.51 0 10 0ZM13.36 12.3C13.65 12.59 13.65 13.07 13.36 13.36C13.21 13.51 13.02 13.58 12.83 13.58C12.64 13.58 12.45 13.51 12.3 13.36L10 11.06L7.7 13.36C7.55 13.51 7.36 13.58 7.17 13.58C6.98 13.58 6.79 13.51 6.64 13.36C6.35 13.07 6.35 12.59 6.64 12.3L8.94 10L6.64 7.7C6.35 7.41 6.35 6.93 6.64 6.64C6.93 6.35 7.41 6.35 7.7 6.64L10 8.94L12.3 6.64C12.59 6.35 13.07 6.35 13.36 6.64C13.65 6.93 13.65 7.41 13.36 7.7L11.06 10L13.36 12.3Z" fill="#FCD106" />
                                </svg>
                            </button>
                        </div>
                    `
                index++;
            }
        })
    }

    const lanjut = () => checkoutItems.length ? true : false;

    window.addEventListener('load', () => {
        const totalBarang = <?php echo count($data['datas']); ?>;
        const indentifier = document.querySelectorAll(".custom--table-pilih-barang tr td:first-child");
        const boxJumlahCheckout = document.querySelectorAll(".custom--table-pilih-barang tr td input");

        <?php
        if (isset($_COOKIE['myCookie'])) {
            $cookieValue = $_COOKIE['myCookie'];
            echo "const { myData } = " . $cookieValue .
                ";";
            echo "checkoutItems.push(...myData);";
            // echo "console.log(checkoutItems);";
            echo "renderCard()";
        } else {
            echo "console.log('Cookie is not set.')";
        }
        ?>;

        if (checkoutItems.length) {
            for (let i = 0; i < boxJumlahCheckout.length; i++) {
                for (let j = 0; j < checkoutItems.length; j++) {
                    if (indentifier[i]?.textContent == checkoutItems[j].kodeBarang) {
                        boxJumlahCheckout[i].value = checkoutItems[j]?.jumlahCheckout;
                        scroollTo(i + 1);
                        continue
                    }

                }

            }
        }
    })

    const searchItem = ({
        target
    }) => {
        let result = []
        let dataArray = <?php echo json_encode($data['datas']); ?>;
        dataArray.some((objek) => {
            let isMatch = objek.nama_barang.toLowerCase().includes(target.value.toLowerCase())
            isMatch ? result.push(objek) : "";
        })
        displaySearchResult(result)
        // console.log(result)
    }



    const displaySearchResult = (searchItems) => {
        const table = document.querySelector('#main-tabel-barang');
        let index = 1;

        table.innerHTML = '';
        table.innerHTML += `
        <tr>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Nama Pengelola</th>
            <th>Tersedia</th>
            <th>Pilih</th>
        </tr>
    `;
        // Tambahkan baris untuk setiap objek yang sesuai
        searchItems.forEach((objek) => {
            const alreadyCheckout = checkoutItems.filter((item) => item.kodeBarang == objek.id_barang)
            console.log(alreadyCheckout);
            table.innerHTML += `
            <tr>
                
                <td id="kode${index}">${objek.id_barang}</td>
                <td id="nama${index}">${objek.nama_barang}</td>
                <td  id="pengelola${index}">${objek.nama_admin}</td>
                <td  id="tersedia${index}">${objek.jumlah_tersedia}</td>
                <td>
                        <div class="custom--container-tambah-barang" id="barang${index}">
                            <button onclick="increment(this,'${index}'); scroollTo('${index}'); addToCheckout('${index}', 'tersedia${index}', 'totalPilihBarang${index}', 'barang${index}', 'indecrement${index}', 'decButton${index}', 'incButton${index}');renderCard()">Tambah</button>
                            <div class="custom--indecrement" id="indecrement${index}">
                                <button onclick="decrement(this,'${index}'); scroollTo('${index}'); minToCheckout('${index}');renderCard()" class="items" id="decButton${index}">-</button>
                                <input id="totalPilihBarang${index}" class="items" type="text" value="${alreadyCheckout[0]?.jumlahCheckout ?? 0}">
                                <button onclick="increment(this,'${index}'); addToCheckout('${index}', 'tersedia${index}', 'totalPilihBarang${index}', 'barang${index}', 'indecrement${index}', 'decButton${index}', 'incButton${index}'); renderCard()" class="items" id="incButton${index}">+</button>
                            </div>
                        </div>
                    </td>
            </tr>
        `;
            scroollTo(index)
            index++;
        });
        // scroollTo(index, index)
    }
</script>