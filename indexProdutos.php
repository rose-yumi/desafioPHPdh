
<?php
//indexProdutos.php

$produtosJson = file_get_contents('./includes/produtos.json');
		
$arrayProdutos = json_decode($produtosJson, true);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=form, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Desafio PHP - FS7 DH</title>
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<!-- CSS -->
	<link rel="stylesheet" href="./assets/css/styles.css">
</head>
<body>

	<!-- Barra de Navegação -->
	<header>
		<nav class="navbar navbar-expand-md navbar-dark bg-secondary">
			<div class="container">
				<a class="navbar-brand" href="indexProdutos.php">Desafio PHP Estruturado</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
					<div class="navbar-nav w-100 d-flex justify-content-around">
					<a class="nav-link" href="createUsuario.php">Usuários</a>
                    <a class="nav-item nav-link active" href="indexProdutos.php">Lista de Produtos<span class="sr-only">(current)</span></a>
					<a class="nav-link" href="createProduto.php">Cadastrar Produtos</a>
					<a class="nav-link" href="logout.php">Logout</a>
					</div>
				</div>
			</div>
		</nav>
    </header>

	<!-- Tabela de Produtos -->
	<div class="container">
        <h5 class="display-7 text-center my-3">Lista de Produtos</h5>
        <table class="table table-striped col-12 text-center">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome do Produto</th>
                    <th scope="col">Descrição do Produto</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Ação</th>
                </tr>   
            </thead>
            <tbody>
                <?php foreach($arrayProdutos as $produto) : ?>    
                    <tr>
                        <th scope="row"><?= $produto['id'] ?></th>
                        <td><?= $produto['nome'] ?></td>
                        <td><?= $produto['descricao'] ?></td>
                        <td>R$ <?= $produto['preco'] ?></td>
                        <td>
                        <a href="editProduto.php?id=<?= $produto['id'] ?>" class="btn btn-secondary">Editar</a>
                        <a href="showProduto.php?id=<?= $produto['id'] ?>" class="btn btn-danger">Ver</a>
                        </td>
                    </tr>
                <?php endforeach; ?>    
            </tbody>
        </table>
	</div>

	<!-- Bootstrap -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>