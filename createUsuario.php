<?php

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
        
    $usuariosJson = file_get_contents('./includes/usuarios.json');
    $usuariosArray = json_decode($usuariosJson, true);

    if (empty($usuariosArray)) {
        $usuariosArray = [];
        $novoUsuario['id'] = 0;
    } else {
        $novoUsuario['id'] = ++end($usuariosArray)['id'];    
    }

    $novoUsuario = [
        'id' => $novoUsuario['id'],
        'nome' => $_POST['nome'],
        'email' => $_POST['email'],
        'senha' => password_hash($_POST['senha'], PASSWORD_DEFAULT),
    ];

    $usuariosArray[] = $novoUsuario;

    $novousuariosJson = json_encode($usuariosArray);

    $cadastrou = file_put_contents('./includes/usuarios.json', $novousuariosJson);
    
        if ($cadastrou) {
            header('Location: login.php');
        }
    }
}

if ($_GET && $_GET['id']) {

    $id = $_GET['id'];

    if (!$_SESSION['usuario']) return header('Location: createUsuario.php');

    $usuariosJson = file_get_contents('./includes/usuarios.json');
    $usuariosArray = json_decode($usuariosJson, true);

    foreach($usuariosArray as $index => $usuario)
    if ($usuario['id'] == $id) {
        array_splice($usuariosArray, $index, 1);

        $usuariosJson = json_encode($usuariosArray);
        return file_put_contents('./includes/usuarios.json', $usuariosJson);
    }
}

$usuariosJson = file_get_contents('./includes/usuarios.json');
$usuariosArray = json_decode($usuariosJson, true);

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
			</div>
		</nav>
    </header>

	<!-- Formulário -->
	<div class="container">
        <div class="row">
            <div class="col-7">
                <h5 class="display-7 text-center mt-3">Cadastro de Usuários</h5>
                <form method = 'POST' action = 'createUsuario.php'>
                    <div class="form-group mt-3">
                        <label for="exampleInputEmail1">Nome</label>
                        <input
                            name='nome'
                            type="text"
                            class="form-control <?php if (isset($ok) && !empty($ok['nome'])) echo 'is-invalid' ?>"
                            id="nome1"
                            aria-describedby="nome"
                            placeholder="Digite seu nome">
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
                    <button type="submit" class="btn btn-secondary mb-2">Enviar</button>
                </form>
                <a href="./login.php">Já sou cadastrado - Login</a>
            </div>

            <div class="col-5 scroll-column border-left">
                <h5 class="display-7 text-center my-3">Usuários</h5>
                <?php foreach($usuariosArray as $usuario) : ?>
                    <div class="border-top my-2 p-2">
                        <div class="row">
                            <div class="col-md-8">
                            <p class="m-0 my-2"><?= $usuario['nome'] ?></p>
                            <p class="m-0 my-2"><?= $usuario['email'] ?></p>
                            </div>
                            <div class="col-md-4 row">
                            <a href="editUsuario.php?id=<?= $usuario['id'] ?>" class="btn btn-secondary col mt-2">Editar</a>
                            <form class="w-100" action="" method="GET">
                                <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                                <button class="btn btn-danger col my-2">Excluir</button>
                            </form>
                            </div>
                        </div>
                    </div>
                 <?php endforeach; ?>
            </div>
        </div>    
    </div>

	<!-- Bootstrap -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

