<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Carrega o autoloader do PHPMailer (se não houver, pode baixar em github.com/PHPMailer/PHPMailer)
require '../assets/vendor/PHPMailer/src/Exception.php';
require '../assets/vendor/PHPMailer/src/PHPMailer.php';
require '../assets/vendor/PHPMailer/src/SMTP.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $assunto = $_POST['subject'] ?? 'Mensagem via site';
    $mensagem = $_POST['message'] ?? '';

    // Configurações do e-mail
    $mail = new PHPMailer(true);

    try {
        // Configuração do servidor Gmail SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'fernandoabcexcursoes@gmail.com'; // Seu Gmail
        $mail->Password   = 'yonzlvzmhljagcdd';              // Senha de app (16 caracteres)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Remetente e destinatário
        $mail->setFrom($email, $nome);
        $mail->addAddress('fernandoabcexcursoes@gmail.com', 'ABC Excursões');

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = "📬 Nova mensagem de contato - $assunto";
        $mail->Body    = "
            <h3>Nova mensagem de contato pelo site</h3>
            <p><strong>Nome:</strong> {$nome}</p>
            <p><strong>E-mail:</strong> {$email}</p>
            <p><strong>Assunto:</strong> {$assunto}</p>
            <p><strong>Mensagem:</strong><br>{$mensagem}</p>
        ";
        $mail->AltBody = "Nome: {$nome}\nE-mail: {$email}\nAssunto: {$assunto}\nMensagem:\n{$mensagem}";

        $mail->send();

        // Retorno AJAX (JSON)
        echo json_encode(['status' => 'success', 'message' => '✅ Mensagem enviada com sucesso!']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => '❌ Falha ao enviar: ' . $mail->ErrorInfo]);
    }
}
?>
