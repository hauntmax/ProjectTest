<?php


namespace App\Core;


class View
{
    private string $path;
    private string $layout = 'default';

    public function __construct()
    {
        $params = Router::getInstance()->getParams();
        $this->path = ucfirst($params['controller']) . '/' . $params['action'];
    }

    /**
     * @param string $title
     * @param array $data
     */
    public function render(string $title, array $data = [])
    {
        extract($data);
        $pathView = 'App/Views/' . $this->path . '.php';
        $pathLayout = 'App/Views/Layouts/' . $this->layout . '.php';
        if (file_exists($pathView)) {
            ob_start();
            require $pathView;
            $content = ob_get_clean();
            require $pathLayout;
        } else {
            die('Предcтавление ' . $this->path . '.php не найдено');
        }
    }

    /**
     * @param string $url
     */
    public function redirect(string $url)
    {
        header('Location: ' . $url);
        exit;
    }

    /**
     * @param int $code
     */
    public static function errorCode(int $code)
    {
        http_response_code($code);
        $path = 'App/Views/Errors/' . $code . '.php';
        if (file_exists($path)) {
            require $path;
        }
        exit;
    }

    /**
     * @param int $status
     * @param string $message
     */
    public function message(int $status, string $message)
    {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }
}