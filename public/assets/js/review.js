const reviewItems = document.querySelectorAll('#review_item')
const reviewBigButtons = document.querySelectorAll('#art_big_review')
const reviewSmallButtons = document.querySelectorAll('#art_small_review')
const reviewColors = ['bg-[#dc3545]', 'bg-[#ffa500]', 'bg-[#28a745]', 'bg-[#ffd700]']
const bigReviewBgRules = [reviewColors[0], reviewColors[0], reviewColors[0], reviewColors[1], reviewColors[1], reviewColors[1], reviewColors[2], reviewColors[2], reviewColors[2], reviewColors[3]]
const smallReviewBgRules = [reviewColors[0], reviewColors[0], reviewColors[1], reviewColors[2], reviewColors[3]]
const scoreInputs = document.querySelectorAll('#score');
const totalScore = document.querySelector('#totalScore')
// function bigReviewClick(event, id) {
//     if (id < 2) {
//         event.target.style.backgroundColor = bigReviewBg[0];
//     }

//     console.log(event)
//     console.log(id)
// }

reviewItems.forEach((item, index) => {

    [...item.children].forEach((btn, btnIndex) => {
        btn.addEventListener('click', (event) => {
            let selectedBtn = item.querySelector('.selected');
            if (selectedBtn) {
                selectedBtn.classList.remove(bigReviewBgRules[selectedBtn.innerHTML - 1], smallReviewBgRules[selectedBtn.innerHTML - 1])
                selectedBtn.classList.add('text-black');
                selectedBtn.classList.remove('selected')
                selectedBtn.classList.remove('text-white')
            }

            btn.classList.remove('bg-[#dddddd3b]');
            btn.classList.remove('text-black');
            if (index == 4 || index == 5) {
                btn.classList.add(smallReviewBgRules[btnIndex]);
            } else {
                btn.classList.add(bigReviewBgRules[btnIndex]);
            }
            btn.classList.add('text-white')
            btn.classList.add('selected');

            scoreInputs[index].value = `${btnIndex + 1}`;
            // console.log(scoreInputs[index].value)

            updateScore()
        })
    })
})

function updateScore() {
    let total = 0;
    scoreInputs.forEach((input)=>{
        total += +input.value
    })
    totalScore.innerHTML = total;
}