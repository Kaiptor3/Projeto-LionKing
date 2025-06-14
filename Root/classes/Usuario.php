<?php
require_once __DIR__ . '/../conexao.php';

class Usuario {
    private $conn;

    private $idUsuario;
    private $cpf;
    private $nomeCompleto;
    private $dataNascimento;
    private $nomeMae;
    private $email;
    private $telefone;
    private $estado;
    private $cidade;
    private $rua;
    private $numero;
    private $bairro;
    private $login;
    private $senha;
    private $idPermissao;

    public function __construct() {
        $this->conn = conectaPDO();
    }

    // Setters
    public function setIdUsuario($id) { $this->idUsuario = $id; }
    public function setCpf($cpf) { $this->cpf = $cpf; }
    public function setNomeCompleto($nome) { $this->nomeCompleto = $nome; }
    public function setDataNascimento($data) { $this->dataNascimento = $data; }
    public function setNomeMae($nomeMae) { $this->nomeMae = $nomeMae; }
    public function setEmail($email) { $this->email = $email; }
    public function setTelefone($tel) { $this->telefone = $tel; }
    public function setEstado($estado) { $this->estado = $estado; }
    public function setCidade($cidade) { $this->cidade = $cidade; }
    public function setRua($rua) { $this->rua = $rua; }
    public function setNumero($numero) { $this->numero = $numero; }
    public function setBairro($bairro) { $this->bairro = $bairro; }
    public function setLogin($login) { $this->login = $login; }
    public function setSenha($senha) { $this->senha = $senha; }
    public function setIdPermissao($idPermissao) { $this->idPermissao = $idPermissao; }

    // Inserir novo usuário
    public function inserir() {
        $sql = "INSERT INTO usuario (
            cpf, nomeCompleto, dataNascimento, nomeMae, email, telefone, estado, cidade, rua, numero, bairro, login, senha, idPermissao
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $this->cpf,
            $this->nomeCompleto,
            $this->dataNascimento,
            $this->nomeMae,
            $this->email,
            $this->telefone,
            $this->estado,
            $this->cidade,
            $this->rua,
            $this->numero,
            $this->bairro,
            $this->login,
            $this->senha,
            $this->idPermissao
        ]);
    }

    // Atualizar usuário existente
    public function atualizar() {
        $sql = "UPDATE usuario SET
            cpf = ?, nomeCompleto = ?, dataNascimento = ?, nomeMae = ?, email = ?, telefone = ?, estado = ?, cidade = ?, rua = ?, numero = ?, bairro = ?, login = ?, senha = ?, idPermissao = ?
            WHERE idUsuario = ?";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $this->cpf,
            $this->nomeCompleto,
            $this->dataNascimento,
            $this->nomeMae,
            $this->email,
            $this->telefone,
            $this->estado,
            $this->cidade,
            $this->rua,
            $this->numero,
            $this->bairro,
            $this->login,
            $this->senha,
            $this->idPermissao,
            $this->idUsuario
        ]);
    }

    // Listar todos os usuários
    public static function listarTodos() {
        $conn = conectaPDO();
        $stmt = $conn->prepare("SELECT idUsuario, nomeCompleto, email, login FROM usuario ORDER BY idUsuario DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar usuário por ID
    public static function buscarPorId($id) {
        $conn = conectaPDO();
        $stmt = $conn->prepare("SELECT * FROM usuario WHERE idUsuario = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Deletar usuário por ID
    public function deletar($id) {
        $sql = "DELETE FROM usuario WHERE idUsuario = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
