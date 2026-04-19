<?php

$domain = "sandboxf35cc55610c746c9a42bdf3cdf277817.mailgun.org";
$apiKey = "822f417531f9e583fb535bddcd9158b3"; // API KEY thật

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.mailgun.net/v3/$domain/messages");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_USERPWD, "api:$apiKey");

curl_setopt($ch, CURLOPT_POSTFIELDS, [
    'from' => "Mailgun Sandbox <postmaster@$domain>",
    'to' => 'dt.congg@gmail.com',
    'subject' => 'Hello!',
    'text' => 'Test message'
]);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

echo "Status: $status\n";
echo "Response: $response\n";

curl_close($ch);
