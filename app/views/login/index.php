<section>
    <form class="custom--login-form" action="login/processLogin" method="post">
        <div class="logo ">
            <div class="custom--logo">
                <svg width="451" height="451" viewBox="0 0 451 451" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M404 48.4342C404 62.4893 397.62 75.141 387.445 83.9887C385.619 85.7981 383.558 87.4366 381.285 88.8684C380.004 89.6663 378.921 90.2291 378.368 90.5069C378.254 90.5639 377.436 90.9699 377.436 90.9699L251.759 152.875C250.107 153.751 249.137 154.278 249.024 154.35C248.501 154.699 248.001 155.069 247.516 155.461L189.728 183.963C189.728 183.963 189.712 183.963 189.712 183.97L189.637 184.006C172.104 191.735 159.958 208.469 159.958 227.874C159.958 229.947 160.095 231.998 160.367 234C154.086 225.687 146.085 218.591 138.342 213.733C129.803 208.376 121.711 205.811 116.649 204.536V204.522C94.934 198.83 79 180.109 79 157.883C79 138.478 91.1456 121.744 108.678 114.015L108.754 113.98C108.754 113.98 108.762 113.972 108.769 113.972L327.489 6.09078C328.224 5.7061 328.974 5.33567 329.732 4.9866L330.171 4.76577C332.831 3.455 335.589 2.50043 338.385 1.85929C342.863 0.655382 347.598 0 352.485 0C380.936 0 404 21.6846 404 48.4342Z" fill="url(#paint0_linear_227_2177)" />
                    <path d="M287.351 246.653V246.639C282.282 245.365 274.19 242.803 265.651 237.45C257.945 232.618 249.982 225.571 243.716 217.315C242.632 215.222 241.647 213.03 240.791 210.71C234.366 193.264 233.919 166.111 247.823 155L190.034 183.478C190.034 183.478 190.019 183.478 190.019 183.485L189.943 183.52C172.41 191.243 160.265 207.962 160.265 227.351C160.265 229.422 160.401 231.472 160.674 233.472C166.319 240.931 170.569 249.38 171.986 258.07C172.895 263.6 172.653 269.231 170.895 274.768C169.577 278.896 166.144 286.996 155.817 295.032C120.699 312.313 18.3814 365.276 16.5553 367.083C6.37968 375.923 0 388.564 0 402.607C0 429.334 23.0638 451 51.5148 451C56.4018 451 61.1373 450.345 65.6152 449.142C68.4111 448.502 71.169 447.548 73.8285 446.238L74.268 446.018C75.0256 445.669 75.7757 445.299 76.5107 444.914L295.231 337.125C295.231 337.125 295.246 337.125 295.246 337.118L295.322 337.083C312.854 329.36 325 312.641 325 293.252C325 271.045 309.066 252.34 287.358 246.653H287.351Z" fill="url(#paint1_linear_227_2177)" />
                    <defs>
                        <linearGradient id="paint0_linear_227_2177" x1="404" y1="117" x2="79" y2="117" gradientUnits="userSpaceOnUse">
                            <stop offset="0.149372" stop-color="#F49E4C" />
                            <stop offset="0.649094" stop-color="#F8EDAF" />
                        </linearGradient>
                        <linearGradient id="paint1_linear_227_2177" x1="324.992" y1="303.004" x2="-0.00757426" y2="303.004" gradientUnits="userSpaceOnUse">
                            <stop offset="0.415163" stop-color="#F49E4C" />
                            <stop offset="1" stop-color="#F8EDAF" />
                        </linearGradient>
                    </defs>
                </svg>

            </div>
            <label for="">SIVENTI</label>
        </div>
        <div class="wrapper">
            <div class="username-wrapper">
                <input id="username" type="text" name="nomor_identitas" placeholder="Masukkan nomor identitas">
            </div>
            <div class="password-wrapper">
                <input id="password" type="password" name="password" placeholder="Masukkan password">
                <div id="passIcon">
                </div>
            </div>
            <label for="">Lupa Password?</label>
        </div>
        <button type="submit">Masuk</button>
    </form>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
    const setVisibilityPass = () => {
        const passInput = document.querySelector('#password')
        const passIcon = document.querySelector('#passIcon');

        passIcon.addEventListener('click', () => {
            passIcon.classList.toggle('show');
            passInput.type = (passInput.type == "password") ? "text" : "password";
        })
    }

    setVisibilityPass();
</script>