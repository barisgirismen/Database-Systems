<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <?php
        session_start();
        if(session_destroy())
        {
        header("Location: index.html");
        }
    ?>
</body>
</html>
