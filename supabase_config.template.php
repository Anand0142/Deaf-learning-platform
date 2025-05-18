<?php
// Rename this file to supabase_config.php and fill in your credentials
$SUPABASE_URL = 'your-project-url';
$SUPABASE_KEY = 'your-anon-key';

function supabaseApi($endpoint, $method = 'GET', $data = null) {
    global $SUPABASE_URL, $SUPABASE_KEY;
    
    $ch = curl_init($SUPABASE_URL . $endpoint);
    
    $headers = [
        'apikey: ' . $SUPABASE_KEY,
        'Authorization: Bearer ' . $SUPABASE_KEY,
        'Content-Type: application/json',
        'Prefer: return=minimal'
    ];

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    if ($method !== 'GET') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        if ($data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
    }
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return [
        'status' => $httpCode,
        'data' => json_decode($response, true)
    ];
}
?> 