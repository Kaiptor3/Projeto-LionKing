$(document).ready(function () {

    // Máscara para o CPF (xxx.xxx.xxx-xx)
    $('#cpf').mask('000.000.000-00', {reverse: false});

    // Máscara para o telefone (xx) xxxxx-xxxx
    $('#telefone').mask('(00) 00000-0000', {reverse: false});

    let nomeInput = $('#nome');
    let nomeError = $('#nomeError');
    let emailInput = $('#email');
    let emailError = $('#emailError');
    let cpfInput = $('#cpf');
    let cpfError = $('#cpfError');
    let numeroInput = $('#numero');
    let numeroError = $('#numeroError');
    let nascimentoInput = $('#nascimento');
    let nascimentoError = $('#nascimentoError');
    let senhaInput = $('#senha');
    let senhaError = $('#senhaError');
    let confirmaSenhaInput = $('#confirma-senha');
    let confirmaError = $('#confirmaError');
    let cadastroBtn = $('#cadastro');

    // Validação do Nome
    function validarNome() {
        let nome = nomeInput.val().trim();
        let nomeValido = /^[A-Za-zÀ-ÿ]+(?:[-'\s][A-Za-zÀ-ÿ]+)*$/;

        nomeError.text('');
        nomeInput.removeClass('error');

        if (nome.length < 2 || !nomeValido.test(nome)) {
            nomeError.text('Insira um nome válido.');
            nomeInput.addClass('error');
            return false;
        }
        return true;
    }

    // Validação do E-mail
    function validarEmail() {
        let email = emailInput.val().trim();
        let emailValido = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        emailError.text('');
        emailInput.removeClass('error');

        if (!emailValido.test(email)) {
            emailError.text('Insira um e-mail válido.');
            emailInput.addClass('error');
            return false;
        }
        return true;
    }

    // Validação do CPF
    function validarCPF() {
        let cpf = cpfInput.val().trim();
        let cpfValido = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/; // Exemplo: 123.456.789-01

        cpfError.text('');
        cpfInput.removeClass('error');

        if (!cpfValido.test(cpf)) {
            cpfError.text('Insira um CPF válido (formato: 123.456.789-01).');
            cpfInput.addClass('error');
            return false;
        }
        return true;
    }

    // Validação do Número
    function validarNumero() {
        let numero = numeroInput.val().trim();
        let numeroValido = /^\(\d{2}\)\s\d{4,5}-\d{4}$/; // Exemplo: (12) 12345-6789

        numeroError.text('');
        numeroInput.removeClass('error');

        if (!numeroValido.test(numero)) {
            numeroError.text('Insira um número válido (formato: (12) 12345-6789).');
            numeroInput.addClass('error');
            return false;
        }
        return true;
    }

    function validarNascimento() {
        let nascimento = nascimentoInput.val().trim(); // Obtém o valor do campo
    
        console.log("Valor do nascimento:", nascimento); // Adicione para depurar o valor retornado
    
        nascimentoError.text('');
        nascimentoInput.removeClass('error');
    
        // Verifica se o campo está vazio ou não preenchido
        if (!nascimento || isNaN(new Date(nascimento))) {
            nascimentoError.text('Selecione uma data de nascimento.');
            nascimentoInput.addClass('error');
            return false;
        }
    
        // Convertendo o valor do nascimento para um objeto Date
        let dataNascimento = new Date(nascimento);
        let hoje = new Date();
    
        // Calcula a idade
        let idade = hoje.getFullYear() - dataNascimento.getFullYear();
        let mesAtual = hoje.getMonth();
        let diaAtual = hoje.getDate();
        let mesNascimento = dataNascimento.getMonth();
        let diaNascimento = dataNascimento.getDate();
    
        if (mesAtual < mesNascimento || (mesAtual === mesNascimento && diaAtual < diaNascimento)) {
            idade--; // Ajusta a idade caso o aniversário não tenha ocorrido ainda
        }
    
        console.log("Idade calculada:", idade); // Depuração para verificar a idade
    
        // Valida se a idade é maior ou igual a 18
        if (idade < 18) {
            nascimentoError.text('Você deve ter pelo menos 18 anos.');
            nascimentoInput.addClass('error');
            return false;
        }
    
        return true; // Validação passou
    }
    
    

    // Validação da Senha
    function validarSenha() {
        let senha = senhaInput.val().trim();

        senhaError.text('');
        senhaInput.removeClass('error');

        if (senha.length < 6) {
            senhaError.text('A senha deve conter pelo menos 6 caracteres.');
            senhaInput.addClass('error');
            return false;
        }
        return true;
    }

    // Validação de Confirmação de Senha
    function validarConfirmaSenha() {
        let senha = senhaInput.val().trim();
        let confirmaSenha = confirmaSenhaInput.val().trim();

        confirmaError.text('');
        confirmaSenhaInput.removeClass('error');

        if (senha !== confirmaSenha) {
            confirmaError.text('As senhas não conferem.');
            confirmaSenhaInput.addClass('error');
            return false;
        }
        return true;
    }

    nomeInput.on('blur', validarNome);
    emailInput.on('blur', validarEmail);
    cpfInput.on('blur', validarCPF);
    numeroInput.on('blur', validarNumero);
    nascimentoInput.on('blur', validarNascimento);
    senhaInput.on('blur', validarSenha);
    confirmaSenhaInput.on('blur', validarConfirmaSenha);

    // Ação no botão de cadastro
    cadastroBtn.on('click', function (event) {
        event.preventDefault();

        let nomeValido = validarNome();
        let emailValido = validarEmail();
        let cpfValido = validarCPF();
        let numeroValido = validarNumero();
        let nascimentoValido = validarNascimento();
        let senhaValida = validarSenha();
        let confirmaSenhaValida = validarConfirmaSenha();

        if (nomeValido && emailValido && cpfValido && numeroValido && nascimentoValido && senhaValida && confirmaSenhaValida) {
            alert('Cadastro realizado com sucesso!');
            $('#login')[0].reset(); // Limpa o formulário
        }
    });

    
});
