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

// Обработчик наведения мыши на элементе anketa_list
anketa_list.addEventListener('mouseover', function (event) {
    // Проверяем, было ли наведение на элемент с классом anketa
    if (event.target.classList.contains('anketa')) {

        let el = event.target;

        for (let i = 0; i < 3; i++) { // ищем div с классом bgAnketa
            if (el.classList.contains('bgAnketa')) {
                anketa_div = el
            }
            el = el.parentElement;
        }

        // anketa_div.style = "background-color: #E5E4E2;"
        anketa_div.style = "border: 4px solid"
    }
});

// Обработчик наведения мыши на элементе anketa_list
anketa_list.addEventListener('mouseout', function (event) {
    // Проверяем, было ли наведение на элемент с классом anketa
    if (event.target.classList.contains('anketa')) {

        let el = event.target;

        for (let i = 0; i < 3; i++) { // ищем div с классом bgAnketa
            if (el.classList.contains('bgAnketa')) {
                anketa_div = el
            }
            el = el.parentElement;
        }

        anketa_div.style = ""
    }
});