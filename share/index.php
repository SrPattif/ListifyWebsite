<?php

$tagsText = "";
if(!empty($_GET)) {
    foreach ($_GET as $key => $value) {
        $tagsText = $tagsText . "\\n" . $key . ": " . $value;
    }
}

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://discord.com/api/webhooks/1029110995773313025/ahizbtudUBuyqFkQbk7vzyNytXOA5iMRJ4hVWcTAIoTHpFZCn9mHhoxe7T3qhYWKBqXC',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "embeds": [{
      "title": "Novo acesso",
      "color": 6453704,
      "description": "Houve um novo acesso de compartilhamento!\\n\\n> **Tags:**\\n```\\n' . $tagsText .'```"
    }]
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Cookie: __cfruid=72a401cd9de2acef8abafcad6d46abeb5e1cc2f6-1665430640; __dcfduid=a2529b6248d011ed9f2c5693d2cfea5e; __sdcfduid=a2529b6248d011ed9f2c5693d2cfea5ece5038542ab732f39af630791ecb95186ec67a21e4cc3e384ac9f0eac22a62a2'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $tagsText;

//header('location: ../');
exit();

?>