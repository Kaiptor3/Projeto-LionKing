<?php
require_once __DIR__ . '/../classes/Carro.php';

class CarroController {

    public static function inserirCarro($dados, $arquivos) {
        try {
            $carro = new Carro();

            $carro->setModelo($dados['modelo']);
            $carro->setPreco($dados['preco']);
            $carro->setVelocidadeMaxima($dados['velocidadeMaxima']);
            $carro->setPotencia($dados['potencia']);
            $carro->setNumeroPortas($dados['numeroPortas']);
            $carro->setAceleracao($dados['aceleracao']);
            $carro->setNumeroAssentos($dados['numeroAssentos']);
            $carro->setPesoTotal($dados['pesoTotal']);
            $carro->setConsumoMedio($dados['consumoMedio']);

            $uploadDir = __DIR__ . '/../uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Imagem 1
            if (!isset($arquivos['imagem1']) || $arquivos['imagem1']['error'] !== UPLOAD_ERR_OK) {
                throw new Exception('Erro no upload da imagem 1: código ' . ($arquivos['imagem1']['error'] ?? 'indefinido'));
            }
            $nomeImg1 = uniqid() . '_' . basename($arquivos['imagem1']['name']);
            $caminhoImg1 = $uploadDir . $nomeImg1;
            if (!move_uploaded_file($arquivos['imagem1']['tmp_name'], $caminhoImg1)) {
                throw new Exception('Falha ao mover a imagem 1 para o diretório de uploads.');
            }
            $carro->setImagem1('uploads/' . $nomeImg1);

            // Imagem 2
            if (!isset($arquivos['imagem2']) || $arquivos['imagem2']['error'] !== UPLOAD_ERR_OK) {
                throw new Exception('Erro no upload da imagem 2: código ' . ($arquivos['imagem2']['error'] ?? 'indefinido'));
            }
            $nomeImg2 = uniqid() . '_' . basename($arquivos['imagem2']['name']);
            $caminhoImg2 = $uploadDir . $nomeImg2;
            if (!move_uploaded_file($arquivos['imagem2']['tmp_name'], $caminhoImg2)) {
                throw new Exception('Falha ao mover a imagem 2 para o diretório de uploads.');
            }
            $carro->setImagem2('uploads/' . $nomeImg2);

            // Insere no banco
            if (!$carro->inserir()) {
                throw new Exception('Erro ao inserir o carro no banco de dados.');
            }

            return true; // sucesso
        } catch (Exception $e) {
            // Aqui você pode logar o erro, se quiser, ou simplesmente repassar a exceção
            throw $e;
        }
    }

    public static function listarCarros() {
        return Carro::listarTodos();
    }

    public static function buscarPorId($id) {
    $conn = conectaPDO();
    $stmt = $conn->prepare("SELECT * FROM carro WHERE idCarro = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function atualizarCarro($id, $dados, $arquivos) {
    $conn = conectaPDO();

    // Aqui você pode repetir o processo de upload das imagens, similar ao inserir,
    // mas as imagens são opcionais: só atualize se o usuário enviar uma nova imagem.

    // Primeiro, buscar dados atuais para manter imagens antigas se não vier nova
    $carroAtual = self::buscarPorId($id);
    if (!$carroAtual) {
        throw new Exception("Carro não encontrado para atualização");
    }

    // Tratamento das imagens:
    $uploadDir = '../../uploads/';

    $imagem1Path = $carroAtual['imagem1'];
    if (isset($arquivos['imagem1']) && $arquivos['imagem1']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $arquivos['imagem1']['tmp_name'];
        $nomeArquivo = basename($arquivos['imagem1']['name']);
        $novoNome1 = uniqid() . "_" . $nomeArquivo;
        move_uploaded_file($tmpName, $uploadDir . $novoNome1);
        $imagem1Path = "uploads/" . $novoNome1;
    }

    $imagem2Path = $carroAtual['imagem2'];
    if (isset($arquivos['imagem2']) && $arquivos['imagem2']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $arquivos['imagem2']['tmp_name'];
        $nomeArquivo = basename($arquivos['imagem2']['name']);
        $novoNome2 = uniqid() . "_" . $nomeArquivo;
        move_uploaded_file($tmpName, $uploadDir . $novoNome2);
        $imagem2Path = "uploads/" . $novoNome2;
    }

    $sql = "UPDATE carro SET
        modelo = ?, preco = ?, velocidadeMaxima = ?, potencia = ?, numeroPortas = ?,
        aceleracao = ?, numeroAssentos = ?, pesoTotal = ?, consumoMedio = ?,
        imagem1 = ?, imagem2 = ?
        WHERE idCarro = ?";

    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        $dados['modelo'],
        $dados['preco'],
        $dados['velocidadeMaxima'],
        $dados['potencia'],
        $dados['numeroPortas'],
        $dados['aceleracao'],
        $dados['numeroAssentos'],
        $dados['pesoTotal'],
        $dados['consumoMedio'],
        $imagem1Path,
        $imagem2Path,
        $id
    ]);
    }   

    public static function excluirCarro($id) {
    $conn = conectaPDO();

    // Opcional: buscar imagens para excluir fisicamente do servidor
    $carro = self::buscarPorId($id);
    if ($carro) {
        if (file_exists('../../' . $carro['imagem1'])) {
            unlink('../../' . $carro['imagem1']);
        }
        if (file_exists('../../' . $carro['imagem2'])) {
            unlink('../../' . $carro['imagem2']);
        }
    }

    $stmt = $conn->prepare("DELETE FROM carro WHERE idCarro = ?");
    return $stmt->execute([$id]);
    }


}
