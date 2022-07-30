<?php
    function getUserPlayer($accessToken) {
        $url = "https://api.spotify.com/v1/me/player";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
        $headers = array(
        "Authorization: Bearer " . $accessToken,
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    
        $resp = curl_exec($curl);
        curl_close($curl);
        
        return json_decode($resp);
    }
?>