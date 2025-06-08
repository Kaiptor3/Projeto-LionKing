<?php
require_once __DIR__ . '/../conexao.php';

class Carro {
    private $conn;
    private $modelo, $preco, $velocidadeMaxima, $potencia, $numeroPortas;
    private $aceleracao, $numeroAssentos, $pesoTotal, $consumoMedio;
    private $imagem1, $imagem2;

    public function __construct() {
        $this->conn = conectaPDO();
    }

    // SETTERS...
    public function setModelo($modelo) { $this->modelo = $modelo; }
    public function setPreco($preco) { $this->preco = $preco; }
    public function setVelocidadeMaxima($v) { $this->velocidadeMaxima = $v; }
    public function setPotencia($p) { $this->potencia = $p; }
    public function setNumeroPortas($n) { $this->numeroPortas = $n; }
    public function setAceleracao($a) { $this->aceleracao = $a; }
    public function setNumeroAssentos($n) { $this->numeroAssentos = $n; }
    public function setPesoTotal($p) { $this->pesoTotal = $p; }
    public function setConsumoMedio($c) { $this->consumoMedio = $c; }
    public function setImagem1($img) { $this->imagem1 = $img; }
    public function setImagem2($img) { $this->imagem2 = $img; }

    public function inserir() {
        $sql = "INSERT INTO carro 
        (modelo, preco, velocidadeMaxima, potencia, numeroPortas, aceleracao, numeroAssentos, pesoTotal, consumoMedio, imagem1, imagem2)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $this->modelo,
            $this->preco,
            $this->velocidadeMaxima,
            $this->potencia,
            $this->numeroPortas,
            $this->aceleracao,
            $this->numeroAssentos,
            $this->pesoTotal,
            $this->consumoMedio,
            $this->imagem1,
            $this->imagem2
        ]);
    }

    public static function listarTodos() {
        $conn = conectaPDO();
        $stmt = $conn->prepare("SELECT idCarro, modelo, preco, imagem1 FROM carro ORDER BY idCarro DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deletar($id) {
    $sql = "DELETE FROM carro WHERE idCarro = ?";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([$id]);
}
}
?>
