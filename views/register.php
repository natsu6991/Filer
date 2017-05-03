<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Home page</title>
        <link rel="stylesheet" href="web/style.css">
    </head>
    <body>
        <?php if (!empty($error)): ?>
        <p>Error : <?php echo $error ?></p>
        <?php endif; ?>
        <form action="?action=register" method="POST">
            <input placeholder="Pseudo" type="text" name="pseudo"><br>
            <input placeholder="Email" type="text" name="email"><br>
            <input placeholder="Password" type="password" name="password"><br>
            <input type="submit">
        </form>
        <a class="colorLink fontSize" href="?action=login">login is here</a>
    </body>
</html>
