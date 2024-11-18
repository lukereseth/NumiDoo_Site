window.onscroll = function () {
  toggleHeaderStyle();
};

function toggleHeaderStyle() {
  const header = document.getElementById("header");
  const logo = document.querySelector(".logo-header img"); // Seleciona a imagem do logo

  // Verifica a posição da rolagem
  if (window.scrollY > 200) {
    // Adiciona a classe 'scrolled' quando rolar mais de 50px
    header.classList.add("scrolled");

    // Substitui a imagem do logo ao rolar
    logo.src = "/img/img-header-logo-scrolled.png"; // Caminho da nova imagem
  } else {
    // Remove a classe 'scrolled' quando estiver no topo da página
    header.classList.remove("scrolled");

    // Restaura a imagem original
    logo.src = "/img/img-header-logo.png"; // Caminho da imagem original
  }
}

// Selecionando o ícone de hambúrguer e a sidebar
const hamburger = document.getElementById('hamburger');
const sidebar = document.getElementById('sidebar');
const mainContent = document.querySelector('main');

// Quando o ícone de hambúrguer for clicado, alterna a classe 'open' na sidebar
hamburger.addEventListener('click', function() {
  sidebar.classList.toggle('open'); // Abre ou fecha a sidebar
  mainContent.classList.toggle('shifted'); // Desloca o conteúdo
});
