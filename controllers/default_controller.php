<?php

require_once('model/user.php');

function home_action()
{
    if (!empty($_SESSION['user_id']))
    {
        $user = get_user_by_id($_SESSION['user_id']);
        //$user = get_user_by_id(1);
        $pseudo = $user['pseudo'];
        require('views/home.php');
    }
    else {
        header('Location: ?action=login');
        exit(0);
    }
}
