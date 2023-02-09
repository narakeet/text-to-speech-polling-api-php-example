<?php

$apikey = getenv('NARAKEET_API_KEY');
$format = "wav";
$text = "Hi there from the long content polling API.";
$voice = "victoria";
function print_progress($task_progress) {
  // do something more useful here, to print progress using percent and message
  var_dump($task_progress);
}


require_once "narakeet_api_client.php";

$narakeet_api_client = new NarakeetApiClient($apikey /*, poll interval defaults to 5 seconds*/);

// start a build task and wait for it to finish
// if the text is not UTF8 encoded, make sure to use utf8_encode($text);
// if the text is already UTF8 encoded, this is not needed
$task = $narakeet_api_client->request_audio_task($format, $text, $voice);
$task_result = $narakeet_api_client->poll_until_finished($task["statusUrl"], "print_progress");

if ($task_result["succeeded"]) {
  $result_file =  "output.$format";
  $narakeet_api_client->download_to_file($task_result["result"], $result_file);
  echo "downloaded result to $result_file";
  echo " file size " . filesize($result_file);
} else {
  echo "there was a problem building the audio" . $task_result["message"];
}

?>
