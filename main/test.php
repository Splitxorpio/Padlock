<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://numbersapi.p.rapidapi.com/random/trivia?json=true&fragment=true&max=20&min=10",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: numbersapi.p.rapidapi.com",
		"x-rapidapi-key: 1c74124f6amshe4f133aae307c96p148d3djsn206071992808"
	],
]);

$response = json_decode(curl_exec($curl), true);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response["number"].": ".$response["text"];
}
