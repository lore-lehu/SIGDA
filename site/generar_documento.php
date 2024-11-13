<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del POST
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // Verificar que se proporcionaron palabras
    /*if (!isset($data['palabras']) || empty($data['palabras'])) {
        http_response_code(400);
        echo json_encode(['error' => 'No se proporcionaron palabras o frases']);
        exit();
    }*/

    // Crear el prompt con las palabras proporcionadas
    //$palabras = implode(', ', $data['palabras']);

    echo $data;
    
    /*
    $prompt = "Genera un documento estructurado y profesional sobre un control de aplicación usando las siguientes frases: $palabras.";

    // Configurar la clave API de OpenAI
    $api_key = 'tu-clave-api';  // Reemplazar con tu clave API de OpenAI

    // Hacer la solicitud a la API de OpenAI usando cURL
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.openai.com/v1/chat/completions",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            "model" => "gpt-3.5-turbo",
            "messages" => [
                ["role" => "user", "content" => $prompt]
            ]
        ]),
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $api_key",
            "Content-Type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    // Manejar la respuesta de la API
    if ($err) {
        http_response_code(500);
        echo json_encode(['error' => 'Error al hacer la solicitud a OpenAI']);
    } else {
        $decoded_response = json_decode($response, true);
        $texto_generado = $decoded_response['choices'][0]['message']['content'];
        echo json_encode(['text' => $texto_generado]);
    }*/
}
?>