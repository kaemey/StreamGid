const anketa_list = document.getElementById('anketa_list');

// Обработчик клика на элементе anketa_list
anketa_list.addEventListener('click', function (event) {
    // Проверяем, был ли клик над элементом с классом anketa
    if (event.target.classList.contains('anketa')) {

        let el = event.target;

        for (let i = 0; i < 3; i++) { // ищем div с data-url в родительских объектах
            if (el.classList.contains('anketa')) {
                anketa_div = el
            }
            el = el.parentElement;
        }

        url = anketa_div.dataset.url
        window.location.href = url;
        console.log("12123")
    }
});