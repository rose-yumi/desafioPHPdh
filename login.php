<?php

//login.php

if ($_POST) {
    $usuariosJson = file_get_contents('./includes/usuarios.json');
    $usuariosArray = json_decode($usuariosJson, true);

    foreach ($usuariosArray as $usuario) {
        if ($_POST['email'] == $usuario['email'] && password_verify($_POST['senha'], $usuario['senha'])) {
            return header('Location: indexProdutos.php');
        }       
    }
    $erro = 'Usuário e senha não coincidem';
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
			</div>
		</nav>
    </header>

	<!-- Formulário -->
	<div class="container">

		<h5 class="display-7 text-center mt-3">Login</h5>

        <?php if (isset($erro)) { ?>
            <div class="alert alert-danger"><?= $erro ?></div>
        <?php } ?>
            <form method='post' action="login.php">
            <div class="form-group mt-3">
                <label for="exampleInputEmail1">Email</label>
                <input 
                    name='email' 
                    type="email" 
                    class="form-control" 
                    id="exampleInputEmail1" 
                    aria-describedby="emailHelp" 
                    placeholder="Digite o seu email"
                >
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Senha</label>
                <input 
                    name='senha' 
                    type="password" 
                    class="form-control" 
                    id="exampleInputPassword1" 
                    placeholder="Senha"
                >
            </div>
                <button type="submit" class="btn btn-secondary mb-2">Enviar</button>
            </form>
            <a href="./createUsuario.php">Não sou cadastrado - Criar cadastro</a>

	</div>

	<!-- Bootstrap -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

