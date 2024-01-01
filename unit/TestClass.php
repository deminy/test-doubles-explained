<?php

declare(strict_types=1);

namespace Deminy\UnitTests;

/**
 * A test class to be stubbed or mocked when running unit tests.
 */
class TestClass
{
    /**
     * A public integer property with a default value of 1.
     *
     * The value of this property could be changed in two ways:
     * 1. pass in a different integer value when creating an object of this class.
     * 2. by calling method $this->setVar().
     *
     * @var int
     */
    public $var = 1;

    public function __construct(int $var = 2)
    {
        $this->debug(sprintf('Method %s() is executed with an integer argument of %d.', __METHOD__, $var));
        $this->var = $var;
    }

    public function setVar(int $var): self
    {
        $this->debug(sprintf('Method %s() is executed with an integer argument of %d.', __METHOD__, $var));
        $this->var = $var;
        return $this;
    }

    public function getVar(): int
    {
        $this->debug(sprintf('Method %s() is executed with a return value of %d.', __METHOD__, $this->var));
        return $this->var;
    }

    public function otherMethod(): int
    {
        $this->debug(sprintf('Method %s() is executed with a return value of -1.', __METHOD__));
        return -1;
    }

    /**
     * To print out a debug message to the console.
     */
    protected function debug(string $message): void
    {
        fwrite(STDOUT, $message . PHP_EOL);
    }
}
