// Adiciona um evento de mudança ao formulário para enviar automaticamente
    // quando uma categoria é selecionada ou algo é digitado na caixa de pesquisa
    document.getElementById('category').addEventListener('change', function() {
        document.getElementById('searchForm').submit();
    });

    document.querySelector('input[name="q"]').addEventListener('input', function() {
        document.getElementById('searchForm').submit();
    });