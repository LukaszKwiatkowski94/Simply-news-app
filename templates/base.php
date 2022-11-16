<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simply news app</title>
    <link rel="stylesheet" href="./public/css/main.min.css">
</head>
<body>
    <nav class="nav">

    </nav>
    <header class="header">
        <h1>
        <?php echo "{$params['header']}" ?? ''; ?>
    </h1>
    </header>
    <main>
        <div class="content">
            <?php
                include_once("./templates/pages/{$page}.php")
            ?>
        </div>
    </main>
</body>
</html>