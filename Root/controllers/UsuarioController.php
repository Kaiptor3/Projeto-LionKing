<?php
require_once __DIR__ . '/../classes/Usuario.php';

class UsuarioController {

    public static function inserirUsuario($dados) {
        try {
            $usuario = new Usuario();

            $usuario->setCpf($dados['cpf']);
            $usuario->setNomeCompleto($dados['nomeCompleto']);
            $usuario->setDataNascimento($dados['dataNascimento']);
            $usuario->setNomeMae($dados['nomeMae']);
            $usuario->setEmail($dados['email']);
            $usuario->setTelefone($dados['telefone']);
            $usuario->setCep($dados['cep']);
            $usuario->setEstado($dados['estado']);
            $usuario->setCidade($dados['cidade']);
            $usuario->setRua($dados['rua']);
            $usuario->setNumero($dados['numero']);
            $usuario->setBairro($dados['bairro']);
            $usuario->setLogin($dados['login']);
            $usuario->setSenha(password_hash($dados['senha'], PASSWORD_DEFAULT));
            $usuario->setIdPermissao($dados['idPermissao'] ?? 2); // padrão 2, ex cliente

            if (!$usuario->inserir()) {
                throw new Exception('Erro ao inserir usuário no banco de dados.');
            }

            return true;

        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function listarUsuarios() {
        return Usuario::listarTodos();
    }

    public static function buscarPorId($idUsuario) {
        return Usuario::buscarPorId($idUsuario);
    }

    public static function atualizarUsuario($idUsuario, $dados) {
        $usuario = new Usuario();
        $usuario->setIdUsuario($idUsuario); // novo setter para idUsuario

        $usuario->setCpf($dados['cpf']);
        $usuario->setNomeCompleto($dados['nomeCompleto']);
        $usuario->setDataNascimento($dados['dataNascimento']);
        $usuario->setNomeMae($dados['nomeMae']);
        $usuario->setEmail($dados['email']);
        $usuario->setTelefone($dados['telefone']);
        $usuario->setCep($dados['cep']);
        $usuario->setEstado($dados['estado']);
        $usuario->setCidade($dados['cidade']);
        $usuario->setRua($dados['rua']);
        $usuario->setNumero($dados['numero']);
        $usuario->setBairro($dados['bairro']);
        $usuario->setLogin($dados['login']);

        if (isset($dados['senha']) && $dados['senha'] !== '') {
            $usuario->setSenha(password_hash($dados['senha'], PASSWORD_DEFAULT));
        } else {
            // Se não atualizar a senha, busca a senha atual para manter
            $usuarioAtual = self::buscarPorId($idUsuario);
            $usuario->setSenha($usuarioAtual['senha']);
        }

        $usuario->setIdPermissao($dados['idPermissao'] ?? 2);

        return $usuario->atualizar();
    }

    public static function excluirUsuario($idUsuario) {
        $conn = conectaPDO();
        $stmt = $conn->prepare("DELETE FROM usuario WHERE idUsuario = ?");
        return $stmt->execute([$idUsuario]);
    }
}
