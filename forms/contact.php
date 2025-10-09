<?php
/**
 * Envio de formulário de contato via Gmail SMTP
 * ABC Excursões
 */

$receiving_email_address = 'fernandoabcexcursoes@gmail.com'; // Seu e-mail de recebimento

// Caminho da biblioteca PHP Email Form
if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
  include($php_email_form);
} else {
  die('Erro: não foi possível carregar a biblioteca PHP Email Form!');
}

$contact = new PHP_Email_Form;
$contact->ajax = true;

// Configuração do Gmail SMTP
$contact->smtp = array(
    'host' => 'smtp.gmail.com',
    'username' => 'fernandoabcexcursoes@gmail.com',
    'password' => 'yonz lvzm hlja gcdd', 
    'port' => '587',
    'encryption' => 'tls'
  );

// Dados do remetente e assunto
$contact->to = $receiving_email_address;
$contact->from_name = isset($_POST['name']) ? $_POST['name'] : 'Visitante';
$contact->from_email = isset($_POST['email']) ? $_POST['email'] : $receiving_email_address;
$contact->subject = "📬 Nova mensagem de contato pelo site";

// Corpo da mensagem
if (isset($_POST['name'])) $contact->add_message($_POST['name'], 'Nome');
if (isset($_POST['email'])) $contact->add_message($_POST['email'], 'E-mail');
if (isset($_POST['phone'])) $contact->add_message($_POST['phone'], 'Telefone');
if (isset($_POST['subject'])) $contact->add_message($_POST['subject'], 'Assunto');
if (isset($_POST['message'])) $contact->add_message($_POST['message'], 'Mensagem', 10);

// Envia e retorna o status
echo $contact->send();
?>
