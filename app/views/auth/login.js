const setVisibilityPass = ()=>{
    const passInput = document.querySelector('#password')
    const passIcon = document.querySelector('#passIcon');
    
    passIcon.addEventListener('click', ()=>{
        passIcon.classList.toggle('hidden');
        passInput.type = (passInput.type == "password") ? "text" : "password";
    })
}

setVisibilityPass();