let closeQuestion = document.getElementById('closeQuestion');
closeQuestion.addEventListener('click', function () {
    let questionId = closeQuestion.getAttribute('data-question-id');
    // делаем запрос по пути /admin/questions/{id}/close с помощью fetch и передаем questionId в качестве параметра
    fetch(`{{route()}}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.log(error);
        });

});