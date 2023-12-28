<?php 
namespace src;
use League\Plates\Engine;
/**
 * Classe Plates responsavel por rederizar as views
 */
class Plates {
    /**
     * Método responsavel por redenrizar as views
     *
     * @param string $view - nome da view
     * @param array $data -dados enviados para view
     * @return void
     */
    public static function view(string $view, array $data = []) {
        $viewsPath = dirname(__FILE__,2)."/resouce/view";
        $templates = new Engine($viewsPath);

        echo $templates->render($view, $data);
    }
}