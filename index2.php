<? require __DIR__ . '/vendor/autoload.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>trabalhando com files</title>
</head>
<body>
    
    <form action="./app/Controller/ClientController.php" method="post" enctype="multipart/form-data">

        <input type="hidden" name="method" value="store">

        <label for="file">Arquivo</label>
        <input type="file" name="file">

        <br><br>

        <button type="submit" name="enviar">Enviar</button>
    </form>

</body>
</html>