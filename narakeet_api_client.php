<?php

class NarakeetApiClient {
  private $api_key;
  private $poll_interval;
  private $api_url;
  public function __construct($api_key,$poll_interval = 5, $api_url = "https://api.narakeet.com") {
    $this->api_key = $api_key;
    $this->poll_interval = $poll_interval;
    $this->api_url = $api_url;
  }
  public function request_audio_task($format, $text, $voice) {
    $options = [
      CURLOPT_URL => "$this->api_url/text-to-speech/$format?voice=$voice",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => $text,
      CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        "x-api-key: $this->api_key",
      ]
    ];

    $curl = curl_init();
    curl_setopt_array($curl, $options);
    $taskResponse = curl_exec($curl);
    $taskResponseData = json_decode($taskResponse, true);
    curl_close($curl);
    return $taskResponseData;
  }
  public function poll_until_finished($task_url, $progress_callback) {
    $options = [
      CURLOPT_URL => $task_url,
      CURLOPT_RETURNTRANSFER => true
    ];

    $curl = curl_init();
    curl_setopt_array($curl, $options);

    while (true) {
      $statusResponse = curl_exec($curl);
      $statusResponseData = json_decode($statusResponse, true);
      if ($statusResponseData["finished"]) {
        break;
      } else if ($progress_callback) {
        $progress_callback($statusResponseData);
      }
      sleep($this->poll_interval);
    }
    curl_close($curl);
    return $statusResponseData;
  }
  public function download_to_file($url, $file) {
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FILE, fopen($file, "w"));

    $result = curl_exec($curl);
    $error = curl_error($curl);
    curl_close($curl);

    if ($result === false) {
      throw new Exception("Error: $error");
    }
  }
}
?>
