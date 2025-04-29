const sliderList = document.querySelectorAll('#sliderbox');

sliderList.forEach(box=>{
    let prevBtn = box.querySelector('#artsPrev')
    let nextBtn = box.querySelector('#artsNext')
    let slider = box.querySelector('#artSlider')
    let card = slider.querySelectorAll('#card')

    prevBtn.addEventListener('click', event=>{
        slider.scrollBy({left: -card[0].offsetWidth + 32})
    })
    nextBtn.addEventListener('click', event=>{
        slider.scrollBy({left: card[0].offsetWidth + 32})
    })
})