<?php
namespace php7\functions
{
    function debug($str) {
        print_r($str);
    }
}

namespace php7
{
    class SomeClass
    {
        private $name;

        public function getName()
        {
            return $this->name;
        }

        public function setName($name)
        {
            $this->name = $name;
        }
    }

    /*namespace\functions\debug(123); // все равно, что \php7\functions\debug */
}