<?php


namespace App\Core;


class View
{
    public string $path;
    public array $route;
    public string $layout = 'default';

    public function __construct(array $route)
    {
        $this->route = $route;
        $this->path = ucfirst($route['controller']).'/'.$route['action'];
    }

    /**
     * @param string $title
     * @param array $data
     */
    public function render(string $title, array $data = [])
    {
        extract($data);
        $pathView = 'App/Views/'.$this->path.'.php';
        $pathLayout = 'App/Views/Layouts/'.$this->layout.'.php';
        if (file_exists($pathView)){
            ob_start();
            require $pathView;
            $content = ob_get_clean();
            require $pathLayout;
        }
        else {
            die('Предcтавление '.$this->path.'.php не найдено');
        }
    }

    /**
     * @param string $url
     */
    public function redirect(string $url)
    {
        header('Location: '.$url);
        exit;
    }

    /**
     * @param $code
     */
    public static function errorCode($code)
    {
        http_response_code($code);
        $path = 'App/Views/Errors/'.$code.'.php';
        if (file_exists($path)) {
            require $path;
        }
        exit;
    }
}