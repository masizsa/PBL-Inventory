const container = document.getElementById('customContainer');
const warning = document.getElementById('customWarning');
const success = document.getElementById('customSuccess');

function showPopup(id, text) {
    const popupText = document.querySelector(`#${id} .popupText`);

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