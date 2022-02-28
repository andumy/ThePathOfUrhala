const attachSaveListeners = () => {
    const table = document.querySelector(".js-table");
    console.log(table);

    table.addEventListener('click', e => {
            if(!e.target.classList.contains('js-save-combo')){
                return;
            }
            const target = e.target.dataset.target;
            const formData = new FormData();
            formData.append('effect', document.querySelector(`#effect_${target}`).value);
            formData.append('cooldown', document.querySelector(`#cooldown_${target}`).value);
            formData.append('id', target);
            fetch('/runebuilder/combo_save', {
                method: "POST",
                body: formData
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }
                    return response.json()
                })
        });
}

window.attachSaveListeners = attachSaveListeners;
