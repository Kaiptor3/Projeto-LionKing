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
    private $cep;
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
    public function setCep($cep) { $this->cep = $cep; }
    public function setEstado($estado) { $this->estado = $estado; }
    public function setCidade($cidade) { $this->cidade = $cidade; }
    public function setRua($rua) { $this->rua = $rua; }
    public function setNumero($numero) { $this->numero = $numero; }
    public function setBairro($bairro) { $this->bairro = $bairro; }
    public function setLogin($login) { $this->login = $login; }
    public function setSenha($senha) { $this->senha = $senha; }
    public function setIdPermissao($idPermissao) { $this->idPermissao = $idPermissao; }

    public function inserir() {
        $sql = "INSERT INTO usuario (
            cpf, nomeCompleto, dataNascimento, nomeMae, email, telefone, cep, estado, cidade, rua, numero, bairro, login, senha, idPermissao
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $this->cpf,
            $this->nomeCompleto,
            $this->dataNascimento,
            $this->nomeMae,
            $this->email,
            $this->telefone,
            $this->cep,
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

    public function atualizar() {
        $sql = "UPDATE usuario SET
            cpf = ?, nomeCompleto = ?, dataNascimento = ?, nomeMae = ?, email = ?, telefone = ?, cep = ?, estado = ?, cidade = ?, rua = ?, numero = ?, bairro = ?, login = ?, senha = ?, idPermissao = ?
            WHERE idUsuario = ?";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $this->cpf,
            $this->nomeCompleto,
            $this->dataNascimento,
            $this->nomeMae,
            $this->email,
            $this->telefone,
            $this->cep,
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

    public static function listarTodos() {
        $conn = conectaPDO();
        $stmt = $conn->prepare("SELECT * FROM usuario ORDER BY idUsuario DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscarPorId($id) {
        $conn = conectaPDO();
        $stmt = $conn->prepare("SELECT * FROM usuario WHERE idUsuario = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deletar($id) {
        $sql = "DELETE FROM usuario WHERE idUsuario = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
