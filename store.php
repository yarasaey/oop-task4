<?php

require_once 'Validation.php';
$validator = new Validation() ;

$data = [
    'firstname' => $_POST['firstname'] ?? '',
    'lastname' => $_POST['lastname'] ?? '',
    'phone' => $_POST['phone'] ?? '',
    'email' => $_POST['email'] ?? '',
    'password' => $_POST['password'] ?? ''
];
$rules = [
    'firstname' => ['required', 'string'],
    'lastname' => ['required', 'string'],
    'phone' => ['required', 'numeric'],
    'email' => ['required', 'email'],
    'password' => ['required', 'string', 'min:3']
];
$validator->validate($data, $rules);

    if(empty($validator->getErrors())){

    }else{
        var_dump($validator->getErrors());
    }