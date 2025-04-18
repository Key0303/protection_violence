document.getElementById('denunciaForm').addEventListener('submit', function(event) {
    const descricao = document.getElementById('descricao').value;
    const categoria = document.getElementById('categoria').value;

    if (!descricao || !categoria) {
        event.preventDefault();
        alert('Por favor, preencha todos os campos.');
    }
});


