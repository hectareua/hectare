<?php

namespace app\components\parser;
use yii\base\Component;
 
class Parser extends Component
{
    private $parse;
       
    public function __construct(ParseInterface $parse, $config = [])
    {
        $parse->path = $config['path'];
        $parse->component = $this;
        $this->parse = $parse;
       
        foreach ($config['events'] as $event => $handler) {
            $this->on($event, $handler);
        }
 
        parent::__construct();
    }

    public function __call($name, $params = []) {
        return call_user_func_array([$this->parse, $name], $params);

    }
}
