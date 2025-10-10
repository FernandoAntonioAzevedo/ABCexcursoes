<?php
/**
 * PHPMailer class - simplified version placeholder
 * Download full library at https://github.com/PHPMailer/PHPMailer
 */
namespace PHPMailer\PHPMailer;
class PHPMailer {
  const ENCRYPTION_STARTTLS = 'tls';
  public $isSMTP;
  public function isSMTP() {}
  public function setFrom($email, $name = '') {}
  public function addAddress($email, $name = '') {}
  public function isHTML($bool) {}
  public function send() { return true; }
}
?>