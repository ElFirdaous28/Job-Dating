<?php

namespace App\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    private static $twig;

    public static function initialize()
    {
        $loader = new FilesystemLoader('../App/Views');
        self::$twig = new Environment($loader, [
            'cache' => '../cache',
            'auto_reload' => true, // Useful during development
            'debug'=>true,
        ]);

        $debugExtension = new \Twig\Extension\DebugExtension();
        self::$twig->addExtension($debugExtension);
        // Add CSRF function to Twig
        self::$twig->addFunction(new \Twig\TwigFunction('csrf', function () {
            return '<input type="hidden" name="csrf_token" value="' . Security::generateCSRFToken() . '">';
        }, ['is_safe' => ['html']]));

        // Add error function
        self::$twig->addFunction(new \Twig\TwigFunction('error', function ($field) {
            if (isset($_SESSION['errors'][$field])) {
                $error = $_SESSION['errors'][$field];
                unset($_SESSION['errors'][$field]);
                return "<div class='text-red-500 text-xs mt-1'>$error</div>";
            }
            return '';
        }, ['is_safe' => ['html']]));
        
        self::$twig->addFunction(new \Twig\TwigFunction('session', function ($key, $default = null) {
            return $_SESSION[$key] ?? $default;
        }));
    }

    public static function render($view, $data = [])
    {
        if (!self::$twig) {
            self::initialize();
        }

        // Change .php extension to .twig
        $template = str_replace('.php', '.twig', $view);

        try {
            echo self::$twig->render($template . '.php', $data);
        } catch (\Exception $e) {
            // Handle template errors appropriately
            throw new \Exception("Error rendering template: " . $e->getMessage());
        }
    }
}
