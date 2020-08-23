<?php

// We have a few same objects where property "next" are new object

// Example:
class obj
{
    public $int;
    public $next;

    public function __construct($int)
    {
        $this->int = $int;
    }
}

$a = new obj(1);
$b = new obj(2);
$c = new obj(3);
$d = new obj(4);
$a->next = $b;
$b->next = $c;
$c->next = $d;

// Need make function that will revert object tree: first will be last and last will be first.

// Solution

function revert(obj $obj)
{
    if($obj->next !== null)
    {
        $last = revert($obj->next);
        $obj->next = null;

        $l = $last->next;
        while (true) {
            if($l !== null) {
                if($l->next === null) {
                    $l->next = $obj;
                    break;
                }
                $l = $l->next;
            }

            if($l === null){
                $last->next = $obj;
                break;
            }
        }
        return $last;
    }

    return $obj;
}

$test = revert($a);
var_dump($test);
