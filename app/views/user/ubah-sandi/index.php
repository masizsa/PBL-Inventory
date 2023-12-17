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

<script>
    const container = document.getElementById('customContainer');
    const warning = document.getElementById('customWarning');
    const success = document.getElementById('customSuccess');

    function showPopup(id, text) {
        const popupText = document.querySelector(`#${id} .popupText`);

        // Set the text for the pop-up
        popupText.textContent = text;

        container.classList.add('show');     
        setTimeout(() => {
            container.style.top = '1rem';
            const popupElement = id === 'customWarning' ? warning : success;
            popupElement.classList.add('show');

            setTimeout(() => {
                container.style.transition = 'top 0.3s ease';
                container.style.top = '-8.8rem';
                setTimeout(() => {
                    hidePopup();
                    container.style.transition = 'none';
                    if (id === 'customSuccess') {
                        location.reload();
                    }
                }, 200);
            }, 2000);
        }, 10)
    }

    function hidePopup() {
        container.classList.remove('show');
        warning.classList.remove('show');
        success.classList.remove('show');
    }

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
                    if (response.status === 'success') {
                        console.log("success");
                        showPopup('customSuccess', 'Kata sandi berhasil diubah!');
                    } else if (response.status === 'password_mismatch') {
                        console.log("password_mismatch");
                        showPopup('customWarning', 'Kata sandi salah');
                    } else {
                        console.log("Terjadi kesalahan.");
                        showPopup('customWarning', 'Kata sandi lama salah!');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan.');
                }
            });
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