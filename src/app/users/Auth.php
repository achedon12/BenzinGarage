<?php

namespace app\users;

class Auth
{
    public static function isConnected(): bool {
        if (isset($_SESSION['isConnected'])) {
            return true;
        }
        return false;
    }

    public static function getPseudo(): string {
        $pseudo = '';
        if (isset($_SESSION['pseudo'])) {
            $pseudo = $_SESSION['pseudo'];
        }
        return $pseudo;
    }

    public static function disconnect(): void {
        session_destroy();
    }

    public static function setCookieServer($name, $data) {
        $_SESSION[$name] = $data;
    }

    public static function hasCookieServer($name): bool {
        return isset($_SESSION[$name]);
    }

    public static function removeCookieServer($name): void {
        if (self::hasCookieServer($name)) {
            unset($_SESSION[$name]);
        }
    }
}