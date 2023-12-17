<section class="custom--ubah-sandi-container">
    <div class="custom--header">
        <h1>Ubah Sandi</h1>
        <p>Pastikan konfirmasi sandi Anda dengan benar!</p>
    </div>
    <form class="custom--body" id="ubahSandiForm" action="" method="post">
        <div class="custom--input-sandi-baru">
            <div class="custom--wrapper ">
                <label for="">Sandi Sekarang</label>
                <input type="password" name="sandi_sekarang" id="currentPass" required>
                <div class="custom--close-icon ">
                </div>
            </div>
            <div class="custom--wrapper ">
                <label for="">Sandi baru</label>
                <input type="password" name="sandi_baru" id="newPass" required>
                <label for="">Sandi harus 8-12 karakter</label>
                <div class="custom--close-icon ">
                </div>
            </div>
            <div class="custom--wrapper ">
                <label for="">Konfirmasi sandi</label>
                <input type="password" name="konfirmasi_sandi" id="confirmPass" required>
                <div class="custom--close-icon ">
                </div>
            </div>
        </div>
        <div class="custom-confirm-button">
            <input class="active" type="submit" value="Simpan">
        </div>
    </form>
</section>

<section class="custom--container-warning" id="customContainer">
    <div class="custom--warning" id="customWarning">
        <img src="assets/warning.svg" alt="">
        <div class="custom--warning-content-text">
            <h3>Peringatan</h3>
            <p class="popupText"></p>
        </div>
    </div>

    <div class="custom--success" id="customSuccess">
        <img src="assets/check.svg" alt="">
        <div class="custom--success-content-text">
            <h3>Berhasil</h3>
            <p class="popupText"></p>
        </div>
    </div>
</section>

<script src="js/ubah-sandi.js"></script>
<script>
    $(document).ready(function() {
        $('#ubahSandiForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: './ubahSandiUser/ubahSandiProccess',
                data: {
                    sandi_sekarang: $('#currentPass').val(),
                    sandi_baru: $('#newPass').val(),
                    konfirmasi_sandi: $('#confirmPass').val()
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.status === 'success') {
                        console.log("success");
                        showPopup('customSuccess', 'Kata sandi berhasil diubah!');
                    } else if (response.status === 'password_mismatch') {
                        console.log("password_mismatch");
                        showPopup('customWarning', 'Kata sandi baru dan konfirmasi tidak cocok.');
                    } else if (response.status === 'old_password_mismatch'){
                        console.log("Terjadi kesalahan.");
                        showPopup('customWarning', 'Kata sandi lama salah!');
                    } else if (response.status === 'password_invalid') {
                        console.log("invalid_length ");
                        showPopup('customWarning', 'Kata sandi minimal 8 karakter.');
                    } else {
                        console.log("Terjadi kesalahan.");
                        showPopup('customWarning', 'Terjadi kesalahan.');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan.');
                }
            });
        });
    });
</script>
