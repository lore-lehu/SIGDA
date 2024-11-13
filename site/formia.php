<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Documento con IA</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Generar Documento con IA</h2>

    <form id="formulario-generar-documento">
        <label for="palabras">Introduce palabras (separadas por comas):</label><br>
        <input type="text" id="palabras" name="palabras" required><br><br>
        <input type="submit" value="Generar Documento">
    </form>

    <h3>Resultado:</h3>
    <div id="resultado"></div>

    <script>
        $(document).ready(function() {
            $('#formulario-generar-documento').on('submit', function(event) {
                event.preventDefault();  // Evitar recarga de la página

                // Obtener las palabras ingresadas
                const palabras = $('#palabras').val().split(',').map(p => p.trim());

                // Realizar la solicitud AJAX
                $.ajax({
                    url: 'generar_documento.php',  // Archivo PHP que procesará la solicitud
                    type: 'POST',
                    dataType: 'json',
                    contentType: 'application/json',
                    data: JSON.stringify({ palabras: palabras }),
                    success: function(response) {
                        alert(response);
                        // Mostrar el texto generado
                        $('#resultado').html('<pre>' + response.text + '</pre>');
                    },
                    error: function() {
                        $('#resultado').html('<p>Error al generar el documento</p>');
                    }
                });
            });
        });
    </script>
</body>
</html>