<?php
if (isset($_POST['BTEnvia'])){
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

		header('Location: index.php');
	}
	$secretKey = "";
	$ip = $_SERVER['REMOTE_ADDR'];
	$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
	$responseKeys = json_decode($response,true);
	if(intval($responseKeys["success"]) !== 1) {
		?>
		<script>
			alert("Não foi possivel verificar a sua autenticidade");
		window.close()</script>
		<?php

		header('Location: index.php');
	} else {
		include_once('../assets/phpmailer/class.phpmailer.php');
		require_once('../assets/phpmailer/class.smtp.php');

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
  $mail->AddAddress('', ''); // (email, usuario)

  $mail->MsgHTML('<b>De: </b>'.$nome. '<br><b>E-mail: </b>'.$email.'<br><b>Telefone: </b>'.$telefone."<br><br>".$mensagem);

  //Caso queira colocar o conteudo de um arquivo utilize o método abaixo ao invés da mensagem no corpo do e-mail.
  //$mail->MsgHTML(file_get_contents('arquivo.html'));

  ?>
		<script>
			alert("Mensagem Registrada.");
		window.close()</script>
	<?php

  $mail->Send();
  echo '<script language="javascript">';
  echo 'alert("E-mail enviado com sucesso. Retornaremos assim que possível"); window.location.href="index.php";';
  echo '</script>';
  header('Location: index.php');

  

//caso apresente algum erro é apresentado abaixo com essa exceção.
}catch (phpmailerException $e) {
    echo $e->errorMessage(); //Mensagem de erro costumizada do PHPMailer
  }
}
}


?>