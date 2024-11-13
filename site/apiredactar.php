<?php
//Reemplaza con tu clave API
$apiKey = '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'; // Asegúrate de que tu clave API esté aquí
$url = 'https://api.openai.com/v1/chat/completions';

//Recibe datos del formulario
$title = htmlspecialchars($_POST['titulo']);
$prompt = htmlspecialchars($_POST['frases']);



//echo $title." - ".$prompt;

//Datos para la solicitud
$data = [
    'model' => 'gpt-3.5-turbo',
    'messages' => [['role' => 'user', 'content' => "Genera un documento estructurado y profesional sobre un control de aplicación. Usa el siguiente título: '$title', y redacta profesionalmente las siguientes frases: $prompt"]],
];

//Opciones para la solicitud HTTP
$options = [
    'http' => [
        'header' => [
            "Content-Type: application/json",
            "Authorization: Bearer $apiKey"
        ],
        'method' => 'POST',
        'content' => json_encode($data),
    ],
];

//Crear contexto de la solicitud
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);


    // Paso 6: Manejo de errores
    if ($result === FALSE) {
        $responseContent = ["Error en la solicitud a la API."];
    } else {
        $response = json_decode($result, true);
        // Paso 7: Mostrar la respuesta
        if (isset($response['choices'][0]['message']['content'])) {
            // Obtener el contenido y convertir caracteres especiales
            $content = nl2br(htmlspecialchars($response['choices'][0]['message']['content']));
            // Convertir el contenido a un array, separando por saltos de línea
            $responseContent = explode("\n", trim($content)); // Dividir en líneas
        } else {
            $responseContent = ["No se obtuvo respuesta de la API."];
        }
    }

    if (!empty($responseContent)){
        foreach ($responseContent as $line){
            if (!empty(trim($line))){
                echo trim($line);
            }
        }
    }



?>