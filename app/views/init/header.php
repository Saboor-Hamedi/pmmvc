<?php

use App\core\Assets;
use App\services\Auth;

$auth = new Auth();
// check if user is authenticated 
if ($auth->isAuthenticated()) {
    $user = $auth->user();
    // access to the data 
    $user_id = $user->id;
    $username = $user->username;
    $roles = $user->roles;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME ?? 'Free Website'; ?></title>

    <link rel="stylesheet" href="<?php Assets::assets('assets/bootstrap/login.css'); ?>">
    <link rel="stylesheet" href="<?php Assets::assets('assets/bootstrap/cover.css'); ?>">
    <link rel="stylesheet" href="<?php Assets::assets('assets/bootstrap/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php Assets::assets('assets/bootstrap/blog.css'); ?>">
    <link rel="stylesheet" href="<?php Assets::assets('assets/bootstrap/footer.css'); ?>">
    <link rel="stylesheet" href="<?php Assets::assets('assets/bootstrap/post-profile.css'); ?>">
    <link rel="stylesheet" href="<?php Assets::assets('assets/bootstrap/editor.css'); ?>">
    <link rel="stylesheet" href="<?php Assets::assets('assets/bootstrap/tags.css'); ?>">
    <link rel="stylesheet" href="<?php Assets::assets('assets/bootstrap/style.css'); ?>">
    <link rel="stylesheet" href="<?php Assets::assets('assets/bootstrap/front.css'); ?>">
    <link rel="stylesheet" href="<?php Assets::assets('assets/awesome-font/css/all.css');?>">
</head>

<body>