document.addEventListener('DOMContentLoaded', () => {
    registerEventListeners();
});

const submitForm = async () => {
    const response = await fetch("/", {
        headers: {
            'Accept': 'application/json',
            "Content-Type": "application/json",
        },
        method: "POST",
        body: JSON.stringify({
            'dobas': 'Dobás'
        }),
    });
    const html = await response.text();
    document.querySelector('body').innerHTML = html;
    registerEventListeners();
}

const registerEventListeners = () => {
    const rollElem = document.querySelector('.dobas');

    rollElem.addEventListener('click', (event) => {
        event.preventDefault();
        submitForm();
    });
}