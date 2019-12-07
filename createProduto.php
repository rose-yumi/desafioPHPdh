
<?php

session_start();
if (!$_SESSION['usuario']){
	header('location: login.php');
}

if ($_POST) {
    $ok = [
      'nome' => '',
      'preco' => '',
	  'descricao' => '',
	  'foto' => ''
	];

    if (empty($_POST['nome'])) {
      $ok['nome'] = 'O campo nome é obrigatório';
    }

    if (empty($_POST['preco'])) {
      $ok['preco'] = 'O campo preço deve ser numérico';
    }
	
    if (empty($_FILES['foto']['name'])) {
		$erros['foto'] = 'O campo foto é obrigatório';
	  } else if ($_FILES['foto']['error'] === 0) {
		$nomeFoto = $_FILES['foto']['name'];
		$caminhoTmp = $_FILES['foto']['tmp_name'];
		move_uploaded_file($caminhoTmp, './assets/img/' . $nomeFoto);
	  }

    if (
		empty($erros['nome']) &&
		empty($erros['preco']) &&
		empty($erros['descricao']) &&
		empty($erros['foto'])
	) {
        
    $produtosJson = file_get_contents('./includes/produtos.json');
    $produtosArray = json_decode($produtosJson, true);

    if (empty($produtosArray)) {
        $produtosArray = [];
        $novoProduto['id'] = 0;
    } else {
        $novoProduto['id'] = ++end($produtosArray)['id'];    
    }

    $novoProduto = [
        'id' => $novoProduto['id'],
        'nome' => $_POST['nome'],
        'preco' => $_POST['preco'],
		'descricao' => $_POST['descricao'],
		'foto' => $nomeFoto,
    ];

    $produtosArray[] = $novoProduto;

    $novoprodutosJson = json_encode($produtosArray);

    $cadastrou = file_put_contents('./includes/produtos.json', $novoprodutosJson);
    
        if ($cadastrou) {
            header('Location: indexProdutos.php');
        }
    }
}

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
					<a class="nav-link" href="indexProdutos.php">Lista de Produtos</a>
					<a class="nav-item nav-link active" href="createProduto.php">Cadastrar Produtos<span class="sr-only">(current)</span></a>
					<a class="nav-link" href="logout.php">Logout</a>
					</div>
				</div>
			</div>
		</nav>
    </header>

	<!-- Formulário -->
	<div class="container">

		<h5 class="display-7 text-center mt-3">Cadastro de Produtos</h5>
		
		<form method="POST" enctype="multipart/form-data">

			<div class="col-12 my-3">
				<label for="nome">Nome do Produto</label>
				<input
					name="nome"
					type="text"
					id="nome"
					class="form-control <?php if(isset($erros) && !empty($erros['nome'])) echo 'is-invalid' ?>"
					placeholder="Digite o nome do Produto"
					required
				>
				<?php if(isset($erros) && !empty($erros['nome'])) : ?>
            		<div class="invalid-feedback"><?= $erros['nome'] ?></div>
          		<?php endif; ?>
			</div>

			<div class="col-12 my-3">
				<label for="preco">Preço</label>
				<input
					type="number"
					class="form-control <?php if(isset($erros) && !empty($erros['preco'])) echo 'is-invalid' ?>"
					name="preco"
					id="preco"
					placeholder="Digite o preço do produto"
					required
				>
				<?php if(isset($erros) && !empty($erros['preco'])) : ?>
					<div class="invalid-feedback"><?= $erros['preco'] ?></div>
				<?php endif; ?>
			</div>

			<div class="col-12 my-3">
				<label for="descricao">Descrição do Produto</label>
				<textarea
					name="descricao"
					id="descricao"
					cols="30"
					rows="5"
					class="form-control"
					placeholder="Digite a descrição do Produto"
				>
				</textarea>
			</div>

			<div class="form-group col-12 my-3">
				<label for="foto">Selecione a foto do Produto</label>
				<input class="form-control-file <?php if(isset($erros) && !empty($erros['foto'])) echo 'is-invalid' ?>"
					name="foto"
					type="file"
					id="foto"
					required
				>
				<div class="invalid-feedback">Arquivo inválido</div>
			</div>

			<button class="btn btn-secondary" type="submit">Cadastrar Produto</button>
		</form>
	</div>

	<!-- Bootstrap -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

