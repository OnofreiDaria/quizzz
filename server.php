<?php
require "./config.php";
require "./func.php";

$data = file_get_contents('php://input');
//file_put_contents('1.json', $data);

if (!isset($data) || empty($data) die("There are no data");

$json = json_decode($data, true)

$message = "New message from website!\n\n"

if ($json['step0']['question'] && $json['step0']['answers']) {
  $message .= $json['step0']['question'] . ": " . implode(", ", $json['step0']['answers']);
} else {
  $response = [
    "status" => "error",
    "message" => "Error: Smt went wrong!"
  ];
}

if ($json['step1']['question'] && $json['step1']['answers']) {
$message .= "\n" . $json['step1']['question'] . ": " . implode(", ", $json['step1']['answers']);
} else {
  $response = [
    "status" => "error",
    "message" => "Error: Smt went wrong!"
  ];
}

if ($json['step2']['question'] && $json['step2']['answers']) {
$message .= "\n" . $json['step2']['question'] . ": " . implode(", ", $json['step2']['answers']);
} else {
  $response = [
    "status" => "error",
    "message" => "Error: Smt went wrong!"
  ];
}

if ($json['step3']['question'] && $json['step3']['answers']) {
$message .= "\n" . $json['step3']['question'] . ": " . implode(", ", $json['step3']['answers']);
} else {
  $response = [
    "status" => "error",
    "message" => "Error: Smt went wrong!"
  ];
}

$data_empty = false;

foreach($json['step4'] as $item) {
  if (!$item) $data_empty = true;
}

if (!$data_empty) {

  $message .= "\nName: " . $json['step4']['name'];
  $message .= "\nPhone: " . $json['step4']['phone'];
  $message .= "\nEmail: " . $json['step4']['email'];
  $message .= "\nCall: " . $json['step4']['call'];

  $message_data = [
    "message" => $message
  ];
  http_build_query();
  get_data(BASE_URL . TOKEN . "/send?" . http_build_query($message_data));

  $response = [
    "status" => "ok",
    "message" => "thanks! We call you asap"
  ];

} else {
  if(!$json['step4']['name']) {
    $error_message = 'Enter your name';
  } else if(!$json['step4']['phone']) {
    $error_message = 'Enter your phone';
  } else if(!$json['step4']['email']) {
    $error_message = 'Enter your email';
  } else if(!$json['step4']['call']) {
    $error_message = 'Enter your call';
  } else {
    $error_message = 'WTF?!';
  }

  $response = [
    "status" => "error",
    "message" => $error_message
  ];
}

header("Content-Type: application/json; charset=utf-8");
echo json_encode($response);
