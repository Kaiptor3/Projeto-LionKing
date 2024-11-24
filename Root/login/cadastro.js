$(document).ready(function () {
    // Máscara para o CPF (xxx.xxx.xxx-xx)
    $('#cpf').mask('000.000.000-00', { reverse: false });

    // Máscara para o telefone (xx) xxxxx-xxxx
    $('#telefone').mask('(00) 00000-0000', { reverse: false });

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
        let cpf = cpfInput.val().trim().replace(/\D/g, '');
        let cpfValido = /^\d{11}$/;

        cpfError.text('');
        cpfInput.removeClass('error');

        if (!cpfValido.test(cpf)) {
            cpfError.text('Insira um CPF válido.');
            cpfInput.addClass('error');
            return false;
        }

        if (/^(\d)\1+$/.test(cpf)) {
            cpfError.text('CPF inválido (todos os dígitos iguais).');
            cpfInput.addClass('error');
            return false;
        }

        let soma = 0;
        for (let i = 0; i < 9; i++) {
            soma += parseInt(cpf[i]) * (10 - i);
        }
        let resto = (soma * 10) % 11;
        let digito1 = resto === 10 ? 0 : resto;

        if (parseInt(cpf[9]) !== digito1) {
            cpfError.text('CPF inválido.');
            cpfInput.addClass('error');
            return false;
        }

        soma = 0;
        for (let i = 0; i < 10; i++) {
            soma += parseInt(cpf[i]) * (11 - i);
        }
        resto = (soma * 10) % 11;
        let digito2 = resto === 10 ? 0 : resto;

        if (parseInt(cpf[10]) !== digito2) {
            cpfError.text('CPF inválido.');
            cpfInput.addClass('error');
            return false;
        }

        return true;
    }

    // Validação do Número
    function validarNumero() {
        let numero = numeroInput.val().trim();
        let numeroValido = /^\(\d{2}\)\s\d{4,5}-\d{4}$/;

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
        let nascimento = nascimentoInput.val().trim();
        nascimentoError.text('');
        nascimentoInput.removeClass('error');

        if (!nascimento || isNaN(new Date(nascimento))) {
            nascimentoError.text('Selecione uma data de nascimento.');
            nascimentoInput.addClass('error');
            return false;
        }

        let dataNascimento = new Date(nascimento);
        let hoje = new Date();
        let idade = hoje.getFullYear() - dataNascimento.getFullYear();
        let mesAtual = hoje.getMonth();
        let diaAtual = hoje.getDate();
        let mesNascimento = dataNascimento.getMonth();
        let diaNascimento = dataNascimento.getDate();

        if (mesAtual < mesNascimento || (mesAtual === mesNascimento && diaAtual < diaNascimento)) {
            idade--;
        }

        if (idade < 18) {
            nascimentoError.text('Você deve ter pelo menos 18 anos.');
            nascimentoInput.addClass('error');
            return false;
        }

        return true;
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
            let usuario = {
                nome: nomeInput.val().trim(),
                email: emailInput.val().trim(),
                cpf: cpfInput.val().trim(),
                telefone: numeroInput.val().trim(),
                nascimento: nascimentoInput.val().trim(),
                senha: senhaInput.val().trim(),
                estaLogado: false
            };

            localStorage.setItem("usuario", JSON.stringify(usuario)); // Salva no localStorage
            window.location.href = "login.html"; // Redireciona para a página de login
        }
    });
});
