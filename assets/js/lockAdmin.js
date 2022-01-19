import PatternLock from '@phenax/pattern-lock-js';

let stateHash = '';
document.addEventListener('DOMContentLoaded', () => {
    const lock = PatternLock({
        $canvas: document.querySelector('#patternLock'),
        width: 300,
        height: 300,
        grid: [ 3, 3 ],
        theme: 'light'
    });
    lock.onComplete(({hash}) => {
        stateHash = hash
        document.querySelector('#showHash').innerHTML = hash;
    });
    document.querySelector('#save').addEventListener('click', () => {
        {
            const formData = new FormData();
            formData.append('hash',stateHash)

            fetch('/runebuilder/save',{
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
                    document.querySelector('#message').innerHTML = data.message;
                })
        }
    })
})