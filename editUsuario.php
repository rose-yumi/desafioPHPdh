<?php

session_start();
if (!$_SESSION['usuario']){
	header('location: login.php');
}

if ($_GET && $_GET['id']) { 

    $id = $_GET['id'];
    
    $usuariosJson = file_get_contents('./includes/usuarios.json');
    $usuariosArray = json_decode($usuariosJson, true);
    
    foreach($usuariosArray as $usuario)
        if ($usuario['id'] == $id)
        return $usuario;
    return false;

}

if ($_POST) {
    $ok = [
      'nome' => '',
      'email' => '',
      'senha' => ''
    ];

    if (empty($_POST['nome'])) {
      $ok['nome'] = 'O campo nome é obrigatório';
    }

    if (empty($_POST['email'])) {
      $ok['email'] = 'O campo email é obrigatório';
    }

    if (strlen($_POST['senha']) < 6) {
      $ok['senha'] = 'A senha deve ter no mínimo 6 caracteres';
    }

    if ($_POST['senha'] != $_POST['confirmarSenha']) {
      $ok['senha'] = 'As senhas não coincidem';
    }

    if (
      empty($ok['nome']) &&
      empty($ok['email']) &&
      empty($ok['senha'])
    ){
      $usuario = [
        'nome' => $_POST['nome'],
        'email' => $_POST['email'],
        'senha' => password_hash($_POST['senha'], PASSWORD_DEFAULT),
      ];

        function editarUsuario($novoUsuario) {
        
        $usuariosJson = file_get_contents('./includes/usuarios.json');
        $usuariosArray = json_decode($usuariosJson, true);

        foreach($usuariosArray as $index => $usuario) {
            if ($usuario['id'] == $novoUsuario['id']) {
            $usuariosArray[$index] = $novoUsuario;
        
            $novousuariosJson = json_encode($usuariosArray);
            $editou = file_put_contents('./includes/usuarios.json', $novousuariosJson);
            }
        }

            if ($editou) {
                header('Location: createUsuario.php');
            }
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
				<a class="navbar-brand" href="#">Desafio PHP Estruturado</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
					<div class="navbar-nav w-100 d-flex justify-content-around">
						<a class="nav-link" href="createUsuario.php">Usuários</a>
						<a class="nav-link" href="indexProdutos.php">Lista de Produtos</a>
						<a class="nav-link" href="createProduto.php">Cadastrar Produtos</a>
						<a class="nav-link" href="logout.php">Logout</a>
					</div>
				</div>
			</div>
		</nav>
    </header>

	<!-- Formulário -->
	<div class="container">
        <div class="col-12">
            <h5 class="display-7 text-center mt-3">Editar dados do Usuário</h5>
            <form method = 'POST'>
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                <div class="form-group mt-3">
                    <label for="exampleInputEmail1">Nome</label>
                    <input
                        name='nome'
                        type="text"
                        class="form-control <?php if (isset($ok) && !empty($ok['nome'])) echo 'is-invalid' ?>"
                        id="nome1"
                        aria-describedby="nome"
                        placeholder="Digite seu nome"
                        value="<?= $usuario['nome'] ?>" 
                    >
                    <small id="emailHelp" class="form-text text-muted"></small>
                    <?php if(isset($ok) && !empty($ok['nome'])) : ?>
                        <div class="invalid-feedback"><?= $ok['nome'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input 
                        name='email' 
                        type="email" 
                        class="form-control <?php if (isset($ok) && !empty($ok['email'])) echo 'is-invalid' ?>" 
                        id="exampleInputEmail1" 
                        aria-describedby="emailHelp" 
                        placeholder="Digite o seu email"
                        value="<?= $usuario['email'] ?>" 
                    >
                    <small id="emailHelp" class="form-text text-muted"></small>
                    <?php if(isset($ok) && !empty($ok['email'])) : ?>
                        <div class="invalid-feedback"><?= $ok['email'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Senha</label>
                    <input 
                        name='senha' 
                        type="password" 
                        class="form-control <?php if (isset($ok) && !empty($ok['senha'])) echo 'is-invalid' ?>" 
                        id="exampleInputPassword1" 
                        placeholder="Digite a sua senha"
                    >
                    <?php if(isset($ok) && !empty($ok['senha'])) : ?>
                        <div class="invalid-feedback"><?= $ok['senha'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Confirme a sua Senha</label>
                    <input 
                        name='confirmarSenha' 
                        type="password" 
                        class="form-control <?php if (isset($ok) && !empty($ok['confirmarSenha'])) echo 'is-invalid' ?>" 
                        id="exampleInputPassword1" 
                        placeholder="Digite a sua senha novamente"
                    >
                    <?php if(isset($ok) && !empty($ok['confirmarSenha'])) : ?>
                        <div class="invalid-feedback"><?= $ok['confirmarSenha'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="row">
                <a href="createUsuario.php" class="btn btn-secondary mx-auto">Voltar</a>
                <button type="submit" class="btn btn-danger mx-auto">Editar</button>
                </div>
            </form>
        </div>  
    </div>

	<!-- Bootstrap -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

