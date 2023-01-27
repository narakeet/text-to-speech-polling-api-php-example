# Narakeet Long Content (Polling) text to speech API example in PHP

This repository provides a quick example demonstrating how to access the
Narakeet [Long Content API](https://www.narakeet.com/docs/automating/text-to-speech-api/#polling) from PHP.

The long content API is suitable for large audio conversion tasks, and can
produce professional quality uncompressed WAV files using realistic text to
speech.

Note that Narakeet also has a simpler text to speech API, suitable for smaller conversion tasks, that directly streams back the results. 
See the [Streaming Text to Speech API Example](https://github.com/narakeet/text-to-speech-api-php-example) for more information on how to use that API from PHP.

The example sends a request to generate an audio file, then downloads the resulting audio into a local file. 

## Prerequisites

This example works with PHP 7.4 and later. You can run it inside Docker (then it does not require a local PHP installation), or on a system with a PHP 7.4 or later.

## Running the example

1. set and export a local environment variable called `NARAKEET_API_KEY`, containing your API key (or modify [audio.php](audio.php) line 3 to include your API key).
2. optionally edit [audio.php](audio.php) and modify the video text, the main voice, and the function that handles progress notification (lines 4, 5 and 6).
2. to run inside docker, execute `make run`
3. Or to run outside docker, on a system with `php` command line, execute `php audio.php`

## More information

Check out <https://www.narakeet.com/docs/automating/text-to-speech-api/> for more information on the Narakeet text to speech API. 
