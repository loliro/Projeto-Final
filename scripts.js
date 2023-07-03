// Adicione este código antes da tag </body> ou em um arquivo JavaScript separado

// Variáveis globais
let currentSlide = 0;
const slides = document.querySelectorAll('.destaque-slide');

// Função para trocar o slide
function changeSlide(n) {
    currentSlide += n;
    if (currentSlide < 0) {
        currentSlide = slides.length - 1;
    } else if (currentSlide >= slides.length) {
        currentSlide = 0;
    }
    showSlide(currentSlide);
}

// Função para exibir um slide específico
function showSlide(slideIndex) {
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = 'none';
    }
    slides[slideIndex].style.display = 'block';
}

// Exibir o slide inicial
showSlide(currentSlide);

// Função para lidar com o clique no botão "Inscrever-se"
function inscrever() {
    alert('Inscrição realizada com sucesso!');
}

// Obter a referência do botão "Inscrever-se"
const inscreverBtn = document.getElementById('inscreverBtn');

// Adicionar o event listener para o clique no botão
inscreverBtn.addEventListener('click', inscrever);
