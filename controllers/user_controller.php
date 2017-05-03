<?php

require_once('model/user.php');

function login_action()
{
    $error = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if (user_check_login($_POST))
        {
            user_login($_POST['pseudo']);
            header('Location: ?action=home');
            exit(0);
        }
        else {
            $error = "Invalid pseudo or password";
        }
    }
    require('views/login.php');
}

function logout_action()
{
    session_destroy();
    header('Location: ?action=login');
    exit(0);
}


function register_action()
{
    $error = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if (user_check_register($_POST))
        {
            user_register($_POST);
            header('Location: ?action=home');
            exit(0);
        }
        else {
            $error = "Invalid data";
        }
    }
    require('views/register.php');
}

function upload_action()
{
  if (isset($_POST['upload'])) {
      $file = $_FILES['file'];
      $name = $file['name'];
      $data = $_SESSION['current_user'];
      $path = "uploads/upload_of_". $data['pseudo'] . '/' . $name;
      move_uploaded_file($file['tmp_name'], $path);

      try{
          $dbh = new PDO('mysql:host=localhost;dbname=Antoine', 'root', 'root');
          $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $sql = "INSERT INTO `filer` (`id`, `name`, `path`) VALUES (:id, :name, :pathfile);";
          $statement = $dbh->prepare($sql);
          $statement->execute([
              'id' => NULL,
              'name' => $name,
              'pathfile' => $path
          ]);
      }

      catch(PDOException $e){
          echo $e;
      }
  }
  header("Location: ?action=home");
  exit();
}

function delete_action()
{
  $dbh = new PDO('mysql:host=localhost;dbname=Antoine', 'root', 'root');
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $path = $_GET['path'];
  $req = $dbh->prepare('SELECT \'path\' FROM filer WHERE path = :path');
  $req->execute([
      'path' => $path,
      ]);
  $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
  $delete = 'DELETE from filer WHERE path="' . $path . '"';
  $req = $dbh->prepare($delete);
  $req->execute();

  unlink($path);
  header("Location: ?action=home");
  exit();
}
