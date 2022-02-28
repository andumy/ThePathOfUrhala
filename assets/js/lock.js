import PatternLock from '@phenax/pattern-lock-js';
document.addEventListener('DOMContentLoaded', () => {

    const inputs = document.querySelectorAll('input');
    for (const input of inputs) {
        input.addEventListener('change',() =>{
            window.scrollTo({ top: 0, behavior: 'smooth' });
        })
    }

    const lock = PatternLock({
        $canvas: document.querySelector('#patternLock'),
        width: 300,
        height: 300,
        grid: [ 3, 3 ],
        theme: 'light'
    });
    lock.setTheme({
        default: {
            colors: {
                accent: '#79419c',     // Accent color for node
                primary: '#33345b',    // Primary node and line color
                bg: '#ecf0f1',         // Canvas background color
            },
            dimens: {
                node_radius: 20,       // Radius of the outer ring of a node
                line_width: 6,         // Thickness of the line joining nodes
                node_core: 8,          // Radius of the inner circle of a node
                node_ring: 1,          // Outer ring thickness
            }
        }
    });


    lock.onComplete(({hash}) => {
        const deto = document.querySelector('#deto').value;
        const mozo = document.querySelector('#mozo').value;
        const ruto = document.querySelector('#ruto').value;
        const crylo = document.querySelector('#crylo').value;
        const first = document.querySelector('#firstIngredient').value;
        const second = document.querySelector('#secondIngredient').value;


        const formData = new FormData();
        formData.append('deto',deto ? deto : 0)
        formData.append('mozo',mozo ? mozo : 0)
        formData.append('ruto',ruto ? ruto : 0)
        formData.append('crylo',crylo ? crylo : 0)
        formData.append('hash',hash)
        formData.append('firstIngredient',first)
        formData.append('secondIngredient',second)

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
                document.querySelector('#effect').innerHTML = `${data.data.effect} ${data.data.cooldown}`;
                document.querySelector('#isCapped').innerHTML = data.data.isCapped;
                document.querySelector('#errorMessage').innerHTML = data.data.errorMessage;
                document.querySelector('#requirments').innerHTML = data.data.requirments;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            })
    })
})