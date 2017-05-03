<?php

require_once('model/db.php');

function get_user_by_id($id)
{
    $id = (int)$id;
    $data = find_one("SELECT * FROM users WHERE id = ".$id);
    return $data;
}

function get_user_by_pseudo($pseudo)
{
    $data = find_one_secure("SELECT * FROM users WHERE pseudo = :pseudo",
                            ['pseudo' => $pseudo]);
    return $data;
}

function user_check_register($data)
{
    if (empty($data['pseudo']) OR empty($data['email']) OR empty($data['password']))
        return false;
    $data = get_user_by_pseudo($data['pseudo']);
    if ($data !== false)
        return false;
    // TODO : Check valid email
    return true;
}

function user_hash($pass)
{
    $hash = password_hash($pass, PASSWORD_BCRYPT, ['salt' => 'saltysaltysaltysalty!!']);
    return $hash;
}

function user_register($data)
{
    $user['pseudo'] = $data['pseudo'];
    $user['password'] = user_hash($data['password']);
    $user['email'] = $data['email'];
    db_insert('users', $user);

    mkdir('views/uploads/upload_of_'.$user['pseudo']);
}

function user_check_login($data)
{
    if (empty($data['pseudo']) OR empty($data['password']))
        return false;
    $user = get_user_by_pseudo($data['pseudo']);
    if ($user === false)
        return false;
    $hash = user_hash($data['password']);
    if ($hash !== $user['password'])
    {
        return false;
    }
    return true;
}

function user_login($pseudo)
{
    $data = get_user_by_pseudo($pseudo);
    if ($data === false)
        return false;
    $_SESSION['user_id'] = $data['id'];
    $_SESSION['current_user'] = $data;
    return true;
}
