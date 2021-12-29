<?php
include_once(__DIR__ . '/config.php');
include_once(PRIVATE_DIR . '/db.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$data = json_decode(stripslashes(file_get_contents("php://input")));
$subs = new DB('test');
if (isset($data->email) && isset($data->checkbox)) {
  $subs->add([
    'emails' => $data->email
  ]);
}


if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $checkbox = $_POST['checkbox'];
  if (empty($email) && !isset($_POST['checkbox'])) {
    header("Location: /index.php?fail=empty");
    exit();
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !isset($_POST['checkbox'])) {
    header("Location: /index.php?fail=invalid");
  } elseif (str_ends_with($email, '.co') && !isset($_POST['checkbox'])) {
    header("Location: /index.php?fail=ending");
  } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) && !isset($_POST['checkbox'])) {
    header("Location: /index.php?fail=check");
  } elseif (empty($email) && isset($_POST['checkbox'])) {
    header("Location: /index.php?check=first");
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && isset($_POST['checkbox'])) {
    header("Location: /index.php?check=second");
  } elseif (str_ends_with($email, '.co') && isset($_POST['checkbox'])) {
    header("Location: /index.php?check=third");
  } else {
    header("Location: /index.php?subscribe=success");
    $subs->add([
      'emails' => $data->email
    ]);
  }
}
