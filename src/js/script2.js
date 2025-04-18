document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('denunciaForm');
    form.addEventListener('submit', (event) => {
        const categoria = document.getElementById('categoria').value;
        const descricao = document.getElementById('descricao').value;

        if (!categoria || !descricao) {
            event.preventDefault();
            alert('Por favor, preencha todos os campos.');
        }
    });
});