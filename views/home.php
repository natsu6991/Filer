<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Home page</title>
        <link rel="stylesheet" href="web/style.css">
    </head>
    <body>
        <h2>Hello <span id="pseudo"><?php echo $pseudo ?></span>, this is so cool ? :p</h2>
        <a class="colorLink" href="?action=logout">logout is here</a>
        <br><br>
        <form method="POST" action="?action=upload" enctype="multipart/form-data">
          <input type="file" name="file">
          <input type="submit" name="upload" value="Envoyer les fichiers !">
        </form>
        <?php include('view.php');?>
    </body>
</html>
