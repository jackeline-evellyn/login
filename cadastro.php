<?php
	require_once '_classes/usuarios.php';
	$u = new Usuario;
?>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title> Login </title>
		<link rel="stylesheet" href="_css/estilo.css">

	</head>
	<body>
		<div id="formulario-Cad">
		<h1> Cadastrar </h1>
		<form method="POST">
			<input type="text" name="nome" placeholder="Nome Completo" maxlength="45">
			<input type="text" name="telefone" placeholder="Telefone" maxlength="11">
			<input type="email" name="email" placeholder="Email" maxlength="45">
			<input type="password" name="senha" placeholder="Senha">
			<input type="password" name="conf_senha" placeholder="Confirmar Senha" maxlength="15">
			<input type="submit" value="Cadastrar">

		</form>
        <a href="index.php">Já é inscrito? Fazer Login</a>
	</div>
	<?php
		if (isset($_POST['nome']))
        {
			$nome = addslashes($_POST['nome']);
			$telefone = addslashes($_POST['telefone']);
			$email = addslashes($_POST['email']);
			$senha = addslashes($_POST['senha']);
			$conf_senha = addslashes($_POST['conf_senha']);

			//verificar se não há variaveis vazias

			if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($conf_senha)){
            
			$u->conectar("login","localhost","root","");
			if($u->msgErro == "")//Se não há mensagem de erro está ok
			{
                if($senha == $conf_senha){
 				  if($u->cadastrar($nome,$telefone,$email,$senha)){
                      ?>
                    <div id="msg-sucesso">
                        Cadastrado com sucesso
                    </div>
                    <?php
                  }  else{
                      ?>
                    <div class="msg-erro">
                         Email já cadastrado!
                    </div>
                    <?php
                  }
                }
                else{
                    ?>
                    <div class="msg-erro">
                       Senhas não correspondem
                    </div>
                <?php
                }
			}
			else{
                ?>
                <div class="msg-erro">
				<?php echo "Erro: ".$u->msgErro; ?>
                </div>
            
                <?php
        
		}
		} else {
                ?>
            <div class="msg-erro">
			 Preencha todos os campos
            </div>
            <?php
	
	}
		}

	?>

	</body>

</html>