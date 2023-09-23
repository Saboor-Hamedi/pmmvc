<?php

namespace App\core;

trait Direction
{
    public function redirect($url)
    {
        // echo "<script>window.location.href = '$url'</script>";
        header("Location: $url");
        exit;
    }
}
