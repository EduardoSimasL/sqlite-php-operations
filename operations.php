<?php
$dbname = "SGN.db";

try {

    $pdo = new PDO("sqlite:$dbname");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    function inserirDados($pdo, $nome, $email, $RA) {
        $stmt = $pdo->prepare("INSERT INTO Alunos (nome, email, RA) VALUES (:nome, :email, :RA)");
        $stmt->execute([':nome' => $nome, ':email' => $email, ':RA' => $RA]);
    }

    function listarPrimeiraLinha($pdo) {
        $stmt = $pdo->query("SELECT * FROM Alunos LIMIT 1");
        $linha = $stmt->fetch(PDO::FETCH_ASSOC);
        print_r($linha);
    }

    function atualizarRegistro($pdo, $id, $novoNome) {
        $stmt = $pdo->prepare("UPDATE Alunos SET nome = :nome WHERE ID = :id");
        $stmt->execute([':nome' => $novoNome, ':id' => $id]);
    }

    function excluirRegistro($pdo, $id) {
        $stmt = $pdo->prepare("DELETE FROM Alunos WHERE ID = :id");
        $stmt->execute([':id' => $id]);
    }

    function listarTodosRegistros($pdo) {
        $stmt = $pdo->query("SELECT * FROM Alunos");
        while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
            print_r($linha);
        }
    }

    inserirDados($pdo, 'João Silva', 'joao@example.com', '123456');
    inserirDados($pdo, 'Maria Oliveira', 'maria@example.com', '654321');

    echo "Primeira linha da tabela:\n";
    listarPrimeiraLinha($pdo);

    atualizarRegistro($pdo, 1, 'João da Silva');

    excluirRegistro($pdo, 2);

    echo "Todos os registros da tabela:\n";
    listarTodosRegistros($pdo);

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
