const items = document.querySelector('#items');
const buttons = document.querySelector('#buttons');

[...buttons.children].forEach((button, index)=>{
    let item = [...items.children][index];
    button.addEventListener('click', ()=>{
        [...items.children].forEach(item=>{
            item.classList.remove('flex')
            item.classList.add('hidden')
            
        });
        [...buttons.children].forEach(button=>{
            button.classList.remove('scale-90')
        });
        item.classList.remove('hidden')
        item.classList.add('flex')
        button.classList.add('scale-90');
    })

})
