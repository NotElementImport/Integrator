<?php

namespace notelementimport;

use notelementimport\Instruction;

class Integrator
{
    private $_instructions = null;
    
    public function __construct(string $instruction) {
        $this->_instructions = new $instruction();
    }

    public function send(array $package) {
        if(sizeof($_POST) != 0) {
            return $this->_instructions->send($_POST);
        }
        else {
            return $this->_instructions->send($package);
        }
    }
}