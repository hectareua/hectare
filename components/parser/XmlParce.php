<?php

namespace app\components\parser;

use \yii\base\Event;
use Yii;

class XmlParce implements ParseInterface
{
    public $path;
    public $component;
    public $fileName = null;
    const FORM_FILE_WRITE = 'formfilewrite';

    private function XMLToArray($xml) {

        $parser = xml_parser_create('UTF-8');
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        xml_parse_into_struct($parser, $xml, $values);
        xml_parser_free($parser);

        $return = array();
        $stack = array();
        $index = 0;
        foreach($values as $val) {
            if($val['type'] == "open") {
                array_push($stack, $val['tag'].($index++ ? $index-1 : ''));
            } elseif($val['type'] == "close") {
                array_pop($stack);
            } elseif($val['type'] == "complete") {
                array_push($stack, $val['tag']);
                $this->setArrayValue($return, $stack, $val['value']);
                array_pop($stack);
            }
        }
        return $return;
    }

    private function setArrayValue(&$array, $stack, $value) {
        if ($stack) {
            $key = array_shift($stack);
            $this->setArrayValue($array[$key], $stack, $value);
            return $array;
        } else {
            $array = $value;
        }
    }

    public function getArray($params = []) {

        if (isset($params['name'])) {
      
            $fileFullPath = Yii::getAlias('@app') . '/' . $this->path . $params['name'] . '.xml';
            $xml = false;

            if (is_file($fileFullPath)) {
                $xml = file_get_contents($fileFullPath, 'w');
            }

            if ($xml) {
                $array = $this->XMLToArray($xml);
                return $array;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function deleteXML($params = []) {
        return unlink(Yii::getAlias('@app') . '/' . $this->path . $params['name'] . '.xml');
    }
}
