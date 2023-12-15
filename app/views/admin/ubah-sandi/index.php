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
            <input type="submit" value="Kembali">
            <input class="active" type="submit" value="Simpan">
        </div>
    </form>
</section>
<script>
    $(document).ready(function() {
        $('#ubahSandiForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: './ubahSandiAdmin/ubahSandiProccess',
                data: {
                    sandi_sekarang: $('#currentPass').val(),
                    sandi_baru: $('#newPass').val(),
                    konfirmasi_sandi: $('#confirmPass').val()
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Kata sandi berhasil diubah!');
                    } else if (response.status === 'password_mismatch') {
                        alert('Kata sandi baru dan konfirmasi tidak cocok.');
                    } else {
                        alert('Terjadi kesalahan.');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan.');
                }
            });
            location.reload();
        });
    });
    const setVisibilityPass = () => {
        const currentPass = document.querySelector('#currentPass');
        const newPass = document.querySelector('#newPass');
        const confirmPass = document.querySelector('#confirmPass');
        const icons = {
            currentPass: document.querySelector('#currentPass + .custom--close-icon'),
            newPass: document.querySelector('#newPass +label + .custom--close-icon'),
            confirmPass: document.querySelector('#confirmPass + .custom--close-icon'),
        }

        const setVisibility = (icon, input) => {
            icon?.addEventListener('click', () => {
                icon.classList.toggle('show')
                input.type = (input.type == "password") ? "text" : "password";
            })
        }

        setVisibility(icons.currentPass, currentPass);
        setVisibility(icons.newPass, newPass);
        setVisibility(icons.confirmPass, confirmPass);
    }
    setVisibilityPass();
</script>