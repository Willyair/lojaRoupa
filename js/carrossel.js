let index = 0;
const imagens = document.querySelectorAll('.carrossel img');
function mostrarImagem() {
imagens.forEach((img, i) => img.classList.remove('ativo'));
imagens[index].classList.add('ativo');
index = (index + 1) % imagens.length;
}
setInterval(mostrarImagem, 3000); // troca a cada 3s