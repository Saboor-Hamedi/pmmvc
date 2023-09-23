<?php

namespace App\core;

use Exception;

class FlashMessage
{
    private $sessionKey = 'flash_messages';

    public function __construct()
    {
        // Start or resume the session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Initialize flash messages if not already set
        if (!isset($_SESSION[$this->sessionKey])) {
            $_SESSION[$this->sessionKey] = [];
        }
    }

    public function setMessage(string $message, string $type = 'info')
    {
        $_SESSION[$this->sessionKey][] = [
            'message' => $message,
            'type' => $type,
        ];
    }

    public function getMessages()
    {
        $messages = $_SESSION[$this->sessionKey];
        unset($_SESSION[$this->sessionKey]);
        return $messages;
    }

    public function displayMessages()
    {
        $messages = $this->getMessages();
        if (!empty($messages)) {
            echo '<div class="flash-messages">';
            foreach ($messages as $message) {
                echo '<div class="flash-message alert alert-' . $message['type'] . '" role="alert">' . $message['message'] . '</div>';
            }
            echo '</div>';
        }
    }

    public function addMessageWithException(string $message, Exception $exception, string $type = 'danger')
    {
        $this->setMessage($message . ' ' . $exception->getMessage(), $type);
    }
}
?>
<script>
    // Automatically close flash messages after 3 seconds
    setTimeout(function() {
        var flashMessages = document.querySelectorAll('.flash-message');
        flashMessages.forEach(function(message) {
            message.classList.add('fade-out');
            setTimeout(function() {
                message.remove();
            }, 500); // Time to match the CSS transition duration
        });
    }, 3000); // 3000 milliseconds = 3 seconds
</script>