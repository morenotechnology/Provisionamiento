<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Base de Datos - Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            max-width: 900px;
            margin: 0 auto;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #667eea;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .error {
            color: red;
            padding: 15px;
            background-color: #ffe6e6;
            border-radius: 5px;
            margin: 10px 0;
        }
        .success {
            color: green;
            padding: 15px;
            background-color: #e6ffe6;
            border-radius: 5px;
            margin: 10px 0;
        }
        .back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📊 Lista de Usuarios</h1>
        
        <?php
        // Configuración de conexión
        $host = "192.168.56.11";
        $port = "5432";
        $dbname = "webappdb";
        $user = "webuser";
        $password = "webpass123";
        
        // Cadena de conexión
        $conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";
        
        // Intentar conectar
        $conn = @pg_connect($conn_string);
        
        if (!$conn) {
            echo '<div class="error">❌ Error: No se pudo conectar a la base de datos<br>';
            echo 'Verifica que la máquina DB esté corriendo: <code>vagrant status</code></div>';
            exit;
        }
        
        echo '<div class="success">✅ Conexión exitosa a PostgreSQL en 192.168.56.11</div>';
        
        // Consultar datos
        $query = "SELECT * FROM usuarios ORDER BY id";
        $result = pg_query($conn, $query);
        
        if (!$result) {
            echo '<div class="error">Error en la consulta: ' . pg_last_error($conn) . '</div>';
            exit;
        }
        
        $num_rows = pg_num_rows($result);
        echo "<p><strong>Total de registros:</strong> $num_rows</p>";
        
        // Mostrar datos en tabla
        echo '<table>';
        echo '<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Fecha Registro</th></tr>';
        
        while ($row = pg_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
            echo '<td>' . htmlspecialchars($row['nombre']) . '</td>';
            echo '<td>' . htmlspecialchars($row['email']) . '</td>';
            echo '<td>' . htmlspecialchars($row['fecha_registro']) . '</td>';
            echo '</tr>';
        }
        
        echo '</table>';
        
        // Cerrar conexión
        pg_close($conn);
        ?>
        
        <a href="index.html" class="back">← Volver al inicio</a>
    </div>
</body>
</html>
