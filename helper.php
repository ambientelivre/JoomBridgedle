<?php
class ModJoomBridgedleHelper
{
    public static function getData($params)
    {
        include_once dirname(__FILE__) . '/codes.php';
        $function = $params->get('function');
        $result = null;

        switch ($function) {
            case 'function1':
                $result = ModJoomBridgedleCodes::getAlunos($params);
                break;
            case 'function2':
                $result = ModJoomBridgedleCodes::getVideos($params);
                break;
            case 'function3':
                $result = ModJoomBridgedleCodes::getSlides($params);
                break;
            case 'function4':
                $result = ModJoomBridgedleCodes::getHacks($params);
                break;
        }

        return $result;
    }
}
