<?php

/**
 * TuringMachine.php
 * User: joshua
 * Date: 24/09/15
 */
class TuringMachine {
    private $state = 'S0';
    private $tape = '_';
    private $head = 0;

    private $rules = [];

    public function __construct($file = null) {
        if (!is_null($file)) {
            $this->loadFile($file);
        }
    }

    public function loadFile($file) {
        $content = file_get_contents(__DIR__ . '/programs/' . $file);
        $content = explode("\n", $content);

        foreach ($content as $row) {
            if (preg_match('/^state\:/', $row)) $this->state = trim(explode(':', $row)[1]);
            if (preg_match('/^tape\:/', $row)) $this->tape = trim(explode(':', $row)[1]);
            if (preg_match('/^head\:/', $row)) $this->head = trim(explode(':', $row)[1]);

            $matches = [];

            if (preg_match('/d\(([A-Za-z0-9\_]*) ?\, ?([A-Za-z0-9\_]*)\) ?\-\> ?\(([A-Za-z0-9\_]*) ?\, ?([A-Za-z0-9\_]*) ?\, ?(r|l|\*)\)/', $row, $matches)) {
                if (!isset($this->rules[$matches[1]])) $this->rules[$matches[1]] = [];
                $this->rules[$matches[1]][$matches[2]] = [$matches[3], $matches[4], $matches[5]];
            }

        }
    }
}
