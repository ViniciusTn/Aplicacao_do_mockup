<?php

define('USERS_FILE', 'users.json');

function loadUsers() {
    if (file_exists(USERS_FILE)) {
        $data = file_get_contents(USERS_FILE);
        return json_decode($data, true) ?: [];
    }
    return [];
}

function saveUsers($users) {
    file_put_contents(USERS_FILE, json_encode($users, JSON_PRETTY_PRINT));
}

function addUser($name, $email, $password) {
    $users = loadUsers();
    if (isset($users[$email])) {
        return false; 
    }
    $users[$email] = [
        'name' => $name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT)
    ];
    saveUsers($users);
    return true;
}


function getUser($email) {
    $users = loadUsers();
    if (isset($users[$email])) {
        $user = $users[$email];
        unset($user['password']); 
        return $user;
    }
    return null;
}

/
function updateUser($email, $name, $password) {
    $users = loadUsers();
    if (!isset($users[$email])) {
        return false; 
    $users[$email]['name'] = $name;
    if (!empty($password)) {
        $users[$email]['password'] = password_hash($password, PASSWORD_DEFAULT);
    }
    saveUsers($users);
    return true;
}


function deleteUser($email) {
    $users = loadUsers();
    if (!isset($users[$email])) {
        return false; 
    }
    unset($users[$email]);
    saveUsers($users);
    return true;
}


function verifyUser($email, $password) {
    $users = loadUsers();
    if (isset($users[$email])) {
        return password_verify($password, $users[$email]['password']);
    }
    return false;
}

?>
