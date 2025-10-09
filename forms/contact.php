<?php
/**
 * ABC Excursões - Envio de formulário de contato via Gmail SMTP
 */

$receiving_email_address = 'fernandoabcexcursoes@gmail.com';

if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
  include($php_email_form);
} else {
  die(json_encode(['status' => 'error', 'message' => 'Erro interno: biblioteca PHP Email Form não encontrada.']));
}

$contact = new PHP_Email_Form;
$contact->ajax = true;

// Configuração do Gmail SMTP
$contact->smtp = array(
    'host' => 'smtp.gmail.com',
    'username' => 'fernandoabcexcursoes@gmail.com',
    'password' => 'yonzlvzmhljagcdd', 
    'port' => '587',
    'encryption' => 'tls'
  );

// Configuração básica do e-mail
$contact->to = $receiving_email_address;
$contact->from_name = $_POST['name'] ?? 'Visitante';
$contact->from_email = $_POST['email'] ?? $receiving_email_address;
$contact->subject = $_POST['subject'] ?? 'Mensagem via site';

// Corpo da mensagem
$contact->add_message($_POST['name'] ?? '', 'Nome');
$contact->add_message($_POST['email'] ?? '', 'E-mail');
$contact->add_message($_POST['subject'] ?? '', 'Assunto');
$contact->add_message($_POST['message'] ?? '', 'Mensagem', 10);

// Envio
if ($contact->send()) {
  echo json_encode(['status' => 'success', 'message' => '✅ Mensagem enviada com sucesso!']);
} else {
  echo json_encode(['status' => 'error', 'message' => '❌ Ocorreu um erro ao enviar. Tente novamente.']);
}
?>
