<?php
session_start();
// Destroy the user's session
session_destroy();
header('Location: /LogingController');
exit;
