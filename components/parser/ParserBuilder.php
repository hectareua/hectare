<?php
 
 namespace app\components\parser;
 
 use ParceInterface;
 
 class ParserBuilder
 {
    public static function build($parseTypeConfig, $path, $events)
    {
        return function () use ($parseTypeConfig, $path, $events) {
            $parseType = \Yii::createObject($parseTypeConfig);
            $parser = new Parser($parseType, ['path' => $path['path'], 'events' => $events]);
            return $parser;
        };
    }
}
