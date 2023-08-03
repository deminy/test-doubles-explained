<?php

declare(strict_types=1);

class TestClass
{
    /**
     * A public integer property with a default value of 1.
     *
     * The value of this property could be changed in two ways:
     * 1. pass in a different integer value when creating an object of this class.
     * 2. by calling method $this->setVar().
     */
    public int $var = 1;

    public function __construct(int $var = 2)
    {
        $this->debug("TestClass::__construct() is executed with an integer argument {$var}.");
        $this->var = $var;
    }

    public function setVar(int $var): self
    {
        $this->debug("TestClass::setVar() is executed with an integer argument {$var}.");
        $this->var = $var;
        return $this;
    }

    public function getVar(): int
    {
        $this->debug("TestClass::getVar() is executed with an integer return value {$this->var}.");
        return $this->var;
    }

    public function otherMethod(): int
    {
        $this->debug('TestClass::otherMethod() is executed.');
        return -1;
    }

    protected function debug(string $message): void
    {
        fwrite(STDOUT, $message . PHP_EOL);
    }
}
