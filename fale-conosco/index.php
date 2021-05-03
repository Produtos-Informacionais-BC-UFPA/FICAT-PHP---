
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--<!DOCTYPE html>-->
<!--<html xmlns="http://www.w3.org/1999/xhtml">-->

<head>
	<meta name = "viewport" content = "width=device-width, user-scalable = no, initial-scale=1.0">
	<title>Fale conosco | FICAT | Sistema de Geração Automática de Ficha Catalográfica da Universidade Federal do Pará</title>

	<meta name="description" content="Sistema de geração automática de Fichas Catalográficas padronizado para a Universidade Federal do Pará e Região Norte">
	<meta name="author" content"SEDEPTI | João Henrique Rabelo Barbosa | Paulo Victor Lobato Sarmento">

	<link rel="icon" href="../assets/imgs/favicon.png" />
	<link rel="stylesheet" href="../assets/css/FicatStyleSheet.css">
	<link rel="stylesheet" href="../assets/css/animate.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<script type="text/javascript" src="../assets/js/jquery-1.6.4.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="../assets/js/ficatjavascript.js"></script>

	<script src='https://www.google.com/recaptcha/api.js?hl=pt-BR'></script>

	<script type="text/javascript" src="../assets/js/prefix-free.js"></script>
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-126015084-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-126015084-1');
	</script>
</head>
<body>

	<div class="container">
		<header>
			<img src="../assets/imgs/header.png" alt="Ficat 2.0">
		</header>

		<br><br>

		<nav class="navResponsive"><a href="#" ><i class="fa fa-bars" onclick="mostrarMenu()"></i></a></nav>

		<nav class="navegacao animated fadeInDown" id="menu">
			<ul class="menu">
				<li><a href="../"><i class="fa fa-home" style="font-size:25px"></i>Página Inicial</a>
				</li>
				<li><a href="../sobre/"><i class="fa fa-info-circle" style="font-size:25px"></i>Sobre</a></li>
				<li class="active"><a href=""><i class="fa fa-envelope" style="font-size:25px"></i>Fale conosco</a></li>
			</ul>
		</nav>


		<fieldset>
			<p style="margin:15px 15px">Tem alguma dúvida, sugestão ou problema a reportar?</p>
			<p style="margin:15px 15px">Entre em contato conosco pelo formulário abaixo. Sua mensagem será respondida assim que possível!</p>
			<p style="margin:15px 15px">Em caso de  problemas, lembre-se de o descrever bem na mensagem.</p>
			<fieldset class="campo campo1">
				<legend>Fale conosco</legend>
				<form action="index.php" method="POST" name="formContato" enctype="multipart/form-data">
					<p><label for="nome">Nome<span>*</span>:</label>
						<input type="text" size="30" name="nome">
					</p>

					<p><label for="email">E-mail<span>*</span>:</label>
						<input type="text" size="30" name="email">
					</p>

					<p><label for="telefone">Telefone<span>*</span>:</label>
						<input type="text" size="30" name="telefone">
					</p>

					<p><label for="email">Mensagem<span>*</span>:</label>
						<textarea name="mensagem" cols="40" rows="5"></textarea>
					</p>

					<p><label for="email">Arquivo adicional:</label>
						<input type="file" name="uploaded_file" id="uploaded_file">
					</p>
					<div class="captcha">
						<div class="g-recaptcha" data-sitekey=""></div>

					</div>

				</fieldset>

				<!-- CAPTCHA -->


				<input class="botao" type="submit" name="BTEnvia" value="Enviar" onclick="return validarFaleConosco();">
			</fieldset>

		</form>
		<br>
		<footer><img src="../assets/imgs/footer.png" alt="Ficat 2.0"</footer>
	</br>

	<div class="second-footer">
		<hr>
		<p>Desenvolvido e mantido por SEDEPTI.</p>
	</div>
</div>

</body>
<?php
if (isset($_POST['BTEnvia'])){
// des-comente para reativar o captcha

	$captcha;
	if(isset($_POST['g-recaptcha-response'])){
		$captcha=$_POST['g-recaptcha-response'];
	}

	if(!$captcha){
		?>
		<script>
			alert("Confirme o captcha");
		window.close()</script>
		<?php
	}
	$secretKey = "";
	$ip = $_SERVER['REMOTE_ADDR'];
	$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".urlencode($secretKey)."&response=".urlencode($captcha)."&remoteip=".$ip);
	$responseKeys = json_decode($response,true);
	if($responseKeys["success"] != true) {
		?>
		<script>
			alert("Não foi possivel verificar a sua autenticidade");
		window.close()</script>
		<?php
	} else { 
		include_once('../assets/phpmailer/class.phpmailer.php');
		require_once('../assets/phpmailer/class.smtp.php');
        }
  // Inicia a classe PHPMailer
		$mail = new PHPMailer(true);

  // Define os dados do servidor e tipo de conexão
  // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
  $mail->IsSMTP(); // Define que a mensagem será SMTP
  $mail -> IsHTML (true);

  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $telefone = $_POST['telefone'];
  $mensagem = $_POST['mensagem'];
  try {

  //Configuração do e-mail
  // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
  //$mail->SMTPDebug = 2;
  $mail->Host = ''; // Endereço do servidor SMTP (Autenticação, utilize o host smtp.seudomínio.com.br)
  $mail->SMTPAuth   = true;  // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
  $mail->SMTPSecure = 'ssl'; //secure transfer enabled
  $mail->Port       = 465; //  Usar 587 porta SMTP
  $mail->Username = ''; // Usuário do servidor SMTP (endereço de email)
  $mail->Password = ''; // Senha do servidor SMTP (senha do email usado)
  //Define o remetente
  //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
  $mail->setFrom('','Ficat 2.0');
  $mail->AddReplyTo($email);//e-mail para enviar resposta
  $mail->Subject = 'Modulo FICAT - Contato: '.utf8_decode($nome);//Assunto do e-mail

  //Define os destinatário(s)
  //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
  $mail->AddAddress('', '');

  $mail->MsgHTML('<b>De: </b>'.$nome. '<br><b>E-mail: </b>'.$email.'<br><b>Telefone: </b>'.$telefone."<br><br>".$mensagem);

  if (isset($_FILES['uploaded_file']) &&
  	$_FILES['uploaded_file']['error'] == UPLOAD_ERR_OK) {
  	$mail->AddAttachment($_FILES['uploaded_file']['tmp_name'],
  		$_FILES['uploaded_file']['name']);
}

  //Caso queira colocar o conteudo de um arquivo utilize o método abaixo ao invés da mensagem no corpo do e-mail.
  //$mail->MsgHTML(file_get_contents('arquivo.html'));

?>
<script>
	alert("Mensagem registrada. Retornaremos em breve!");
window.close()</script>
<?php

$mail->Send();
echo '<script language="javascript">';
echo 'alert("E-mail enviado com sucesso. Retornaremos assim que possível"); window.location.href="index.php";';
echo '</script>';

//caso apresente algum erro é apresentado abaixo com essa exceção.
}catch (phpmailerException $e) {
    echo $e->errorMessage(); //Mensagem de erro costumizada do PHPMailer
}

}


?>
