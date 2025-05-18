<?php
// Supabase configuration
define('SUPABASE_URL', 'https://cxtnarqtqtfdoplmmoth.supabase.co');
define('SUPABASE_KEY', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImN4dG5hcnF0cXRmZG9wbG1tb3RoIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NDY5ODM4MDEsImV4cCI6MjA2MjU1OTgwMX0._KNCXwZ1m-N_KP442KoYC4I3c7O414OBxJ83CH7k40U');

// Create a function to make Supabase API calls
function supabaseApi($endpoint, $method = 'GET', $data = null) {
    $ch = curl_init(SUPABASE_URL . $endpoint);
    
    $headers = [
        'apikey: ' . SUPABASE_KEY,
        'Authorization: Bearer ' . SUPABASE_KEY,
        'Content-Type: application/json',
        'Prefer: return=minimal'
    ];

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
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