<?php

class Log
{
    private $pointer_log1;
    private $pointer_log2;

    function __construct($pointer_log1, $pointer_log2)
    {
        $this->pointer_log1 = $pointer_log1;
        $this->pointer_log2 = $pointer_log2;
    }

    function debug($text)
    {
        if ($this->pointer_log1 !== null) {
            $this->pointer_log1->debug($text);
        }
        if ($this->pointer_log2 !== null) {
            $this->pointer_log2->debug($text);
        }
    }

    function info($text)
    {
        if ($this->pointer_log1 !== null) {
            $this->pointer_log1->info($text);
        }
        if ($this->pointer_log2 !== null) {
            $this->pointer_log2->info($text);
        }
    }

    function warning($text)
    {
        if ($this->pointer_log1 !== null) {
            $this->pointer_log1->warning($text);
        }
        if ($this->pointer_log2 !== null) {
            $this->pointer_log2->warning($text);
        }
    }

    function error($text)
    {
        if ($this->pointer_log1 !== null) {
            $this->pointer_log1->error($text);
        }
        if ($this->pointer_log2 !== null) {
            $this->pointer_log2->error($text);
        }
    }
}