import PatternLock from '@phenax/pattern-lock-js';
document.addEventListener('DOMContentLoaded', () => {
    const lock = PatternLock({
        $canvas: document.querySelector('#patternLock'),
        width: 300,
        height: 300,
        grid: [ 3, 3 ],
        theme: 'light'
    });

    lock.onComplete(({hash}) => console.log(hash))
})