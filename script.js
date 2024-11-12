// Adicione scripts personalizados se necessário
// Aqui você pode incluir lógica para melhorar a interatividade ou carregar dados dinâmicos no futuro

// Exemplo: se houver comportamento adicional para os carrosséis
document.addEventListener('DOMContentLoaded', function() {
    var carousels = document.querySelectorAll('.carousel');
    carousels.forEach(carousel => {
        carousel.addEventListener('slid.bs.carousel', function() {
            // Ações após o slide mudar
            console.log("Carrossel mudou");
        });
    });
});

