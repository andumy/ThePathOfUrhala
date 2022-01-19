import PatternLock from '@phenax/pattern-lock-js';
document.addEventListener('DOMContentLoaded', () => {
    const lock = PatternLock({
        $canvas: document.querySelector('#patternLock'),
        width: 300,
        height: 300,
        grid: [ 3, 3 ],
        theme: 'light'
    });

    lock.onComplete(({hash}) => {
        const form = document.querySelector('#formCombo');
        const formData = new FormData(form);
        formData.append('hash',hash)

        fetch('/combine',{
            method: "POST",
            body: formData
        })
            .then(response => {
                if(!response.ok){
                    throw new Error(response.statusText)
                }
                return response.json()
            })
            .then(data => {
                document.querySelector('#name').innerHTML = data.data.name;
                document.querySelector('#effect').innerHTML = data.data.effect;
                document.querySelector('#isCapped').innerHTML = data.data.isCapped;
                document.querySelector('#errorMessage').innerHTML = data.data.errorMessage;
            })
    })
})