<?php

declare(strict_types=1);

class TestClass
{
    public int $var = 1;

    public function __construct(int $var = 2)
    {
        $this->debug("TestClass::__construct() is invoked with parameter {$var}.");
        $this->var = $var;
    }

    public function setVar(int $var): self
    {
        $this->debug("TestClass::setVar() is invoked with parameter {$var}.");
        $this->var = $var;
        return $this;
    }

    public function getVar(): int
    {
        $this->debug("TestClass::getVar() is invoked with return value {$this->var}.");
        return $this->var;
    }

    protected function debug(string $message): void
    {
        fwrite(STDOUT, $message . PHP_EOL);
    }
}
