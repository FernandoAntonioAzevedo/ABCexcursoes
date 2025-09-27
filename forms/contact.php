<?php
  /**
   * Formulário de contato - ABC Excursões
   * Envio via Gmail SMTP
   */

  // Seu e-mail de recebimento
  $receiving_email_address = 'fernandoabcexcursoes@gmail.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  // Configuração SMTP Gmail
  $contact->smtp = array(
    'host' => 'smtp.gmail.com',
    'username' => 'fernandoabcexcursoes@gmail.com',
    'password' => 'yonz lvzm hlja gcdd', 
    'port' => '587',
    'encryption' => 'tls'
  );

  // Assunto e remetente
  $contact->to = $receiving_email_address;
  $contact->from_name = isset($_POST['name']) ? $_POST['name'] : 'Visitante';
  $contact->from_email = isset($_POST['email']) ? $_POST['email'] : $receiving_email_address;
  $contact->subject = "📩 Nova solicitação de viagem pelo site";

  // Campos de contato
  if(isset($_POST['name'])) $contact->add_message($_POST['name'], 'Nome');
  if(isset($_POST['email'])) $contact->add_message($_POST['email'], 'E-mail');
  if(isset($_POST['phone'])) $contact->add_message($_POST['phone'], 'Telefone');

  // Campos da viagem
  if(isset($_POST['destination'])) $contact->add_message($_POST['destination'], 'Destino');
  if(isset($_POST['checkin'])) $contact->add_message($_POST['checkin'], 'Data de saída');
  if(isset($_POST['checkout'])) $contact->add_message($_POST['checkout'], 'Data de retorno');
  if(isset($_POST['adults'])) $contact->add_message($_POST['adults'], 'Professores');
  if(isset($_POST['children'])) $contact->add_message($_POST['children'], 'Formandos');
  if(isset($_POST['tour_type'])) $contact->add_message($_POST['tour_type'], 'Tipo de viagem');

  // Mensagem do cliente
  if(isset($_POST['message'])) $contact->add_message($_POST['message'], 'Mensagem', 10);

  // Envia e retorna a resposta
  echo $contact->send();
?>
