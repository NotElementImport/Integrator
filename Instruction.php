<?php

namespace notelementimport;

/**
 * This is just an example.
 */
class Instruction
{
    protected $urlRoot = '';
    protected $typeContent = 'application/json';
    protected $unicodeConverter = false;

    public function send(array $package) {
        $urlCURL = $this->urlRoot;

        if($package != null && sizeof($package) != 0) {
            $pack = [];
            foreach($package as $key=>$val) {
                array_push($pack, $key.'='.$val);
            }

            $urlCURL .= '?'.implode('&', $pack);
        }

        $curlObject = curl_init($urlCURL);

        curl_setopt($curlObject, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curlObject, CURLOPT_HTTPHEADER, array('Content-Type: ' . $this->typeContent));
        curl_setopt($curlObject, CURLOPT_RETURNTRANSFER, TRUE);

        $result = curl_exec($curlObject);

        if($this->unicodeConverter) {
            $result = iconv("Windows-1251", "UTF-8", $result);
        }

        $result = $this->proccesing($result);

        return $result;
    }

    public function proccesing($result) {
        return $result;
    }
}