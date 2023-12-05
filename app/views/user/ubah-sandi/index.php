<link rel="stylesheet" href="../../css/ubahSandi.css">
<div class="custom--ubah-sandi-container">
    <div class="custom--header">
        <h1>Ubah Sandi</h1>
        <p>Pastikan konfirmasi sandi Anda dengan benar!</p>
    </div>
    <form class="custom--body" action="">
        <div class="custom--input-sandi-baru">
            <div class="custom--wrapper">
                <label for="">Sandi Sekarang</label>
                <input type="password" name="" id="currentPass">
                <div class="custom--close-icon">
                    <img src="../../../../public/assets/hiddenPass.svg" alt="">
                </div>
            </div>
            <div class="custom--wrapper">
                <label for="">Sandi baru</label>
                <input type="password" name="" id="newPass">
                <label for="">Sandi harus 8-12 karakter</label>
                <div class="custom--close-icon">
                    <img src="../../../../public/assets/hiddenPass.svg" alt="">
                </div>
            </div>
            <div class="custom--wrapper">
                <label for="">Konfirmasi sandi</label>
                <input type="password" name="" id="confirmPass">
                <div class="custom--close-icon">
                    <img src="../../../../public/assets/hiddenPass.svg" alt="">
                </div>
            </div>
        </div>
        <div class="custom-confirm-button">
            <input type="submit" value="Kembali">
            <input class="active" type="submit" value="Simpan">
        </div>
    </form>
</div>
<script>
    const setVisibilityPass = () => {
        const currentPass = document.querySelector('#currentPass');
        const newPass = document.querySelector('#newPass');
        const confirmPass = document.querySelector('#confirmPass');
        const icons = {
            currentPass: document.querySelector('#currentPass + .custom--close-icon img'),
            newPass: document.querySelector('#newPass +label + .custom--close-icon img'),
            confirmPass: document.querySelector('#confirmPass + .custom--close-icon img'),
        }

        const setVisibility = (icon, input) => {
            icon?.addEventListener('click', () => {
                icon.src = icon.src == 'http://localhost/dasarWeb/PBL-Inventory/public/assets/hiddenPass.svg' ? 'http://localhost/dasarWeb/PBL-Inventory/public/assets/showPass.svg' : 'http://localhost/dasarWeb/PBL-Inventory/public/assets/hiddenPass.svg';
                input.type = (input.type == "password") ? "text" : "password";
            })
        }

        setVisibility(icons.currentPass, currentPass);
        setVisibility(icons.newPass, newPass);
        setVisibility(icons.confirmPass, confirmPass);
    }


    setVisibilityPass();
</script>