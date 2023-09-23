<?php

use App\core\Assets;
use App\services\Auth;
// Get the authenticated user
// Get the authenticated user
$auth = new Auth();
$user = $auth->getUser();

// Check if the user is logged in
if (isset($user)) {
    // Store the user ID and roles in variables
    $username = $user['username'];
    $user_id = $user['user_id'];
    $roles = $user['roles'];
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
    <link rel="stylesheet" href="<?php Assets::assets('assets/css/style.css'); ?>">
</head>

<body>