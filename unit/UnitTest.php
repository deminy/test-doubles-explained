<?php

declare(strict_types=1);

use CrowdStar\Reflection\Reflection;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class UnitTest extends TestCase
{
    /**
     * Test the class to make sure it should work as expected without mocking, stubbing, or anything else.
     */
    public function testWitoutTestDoubles(): void
    {
        $obj = new TestClass();

        self::assertSame(2, $obj->getVar(), 'Property $var is initialized with 2 in constructor.');
        $obj->setVar(3);
        self::assertSame(3, $obj->getVar(), 'Property $var is set to 3 explicitly using method setVar().');
    }

    /**
     * Test the "dummy" test double without enabling original constructor.
     *
     * How does a dummy work?
     * 1. Dummy is a test double that does not have any logic.
     * 2. All the methods can still be invoked, but none of them are actually executed.
     *
     * @see testDummyWithOriginalConstructorEnabled()
     */
    public function testDummyUsingCreateMock(): void
    {
        // Method call $this->createMock() is equivalent to the following statement when EXECUTED IN PARENT CLASS:
        //     $this->getMockBuilder($originalClassName)
        //         ->disableOriginalConstructor()
        //         ->disableOriginalClone()
        //         ->disableArgumentCloning()
        //         ->disallowMockingUnknownTypes()
        //         ->getMock();
        //
        // NOTE: If you replace $this->createMock() with $this->getMockBuilder()->...->getMock() directly in this file,
        //       the test will fail. The latter statement must be executed in parent class.
        $obj = $this->createMock(TestClass::class);

        self::assertSame(0, $obj->getVar(), 'Property $var is initialized with 2 in constructor.');
        $obj->setVar(3); // Method "setVar()" is not actually executed.
        self::assertSame(0, $obj->getVar(), '');

        // Property "var" holds an integer value "1", which is the default value of the property.
        // This is different from the next test case (testDummyWithOriginalConstructorEnabled).
        self::assertSame(1, Reflection::getProperty($obj, 'var'), 'The property actually holds a non-zero integer value "1".');
    }

    /**
     * Test the "dummy" test double with original constructor enabled.
     *
     * @see testDummyUsingCreateMock()
     */
    public function testDummyWithOriginalConstructorEnabled(): void
    {
        $obj = $this->getMockBuilder(TestClass::class)->setConstructorArgs([2])->getMock();

        self::assertSame(0, $obj->getVar(), 'Return value of method getVar() is a default value of the data type returned.');
        $obj->setVar(3); // Method "setVar()" is not actually executed.
        self::assertSame(0, $obj->getVar(), 'Return value of method getVar() is a default value of the data type returned.');

        // Property "var" holds an integer value "2", which is set in the constructor when the object was created.
        // This is different from the previous test case (testDummyUsingCreateMock).
        self::assertSame(2, Reflection::getProperty($obj, 'var'), 'The property actually holds a non-zero integer value "2".');
    }

    /**
     * Test the "mock" test double.
     *
     * How do mocks work?
     * 1. All the methods can be invoked, but only those are not mocked are actually executed.
     * 2. Mocked methods are not actually executed, although we do care if they are called as should.
     */
    public function testMockUsingGetMockBuilder(): void
    {
        $obj = $this->getMockBuilder(TestClass::class)
            ->setConstructorArgs([2])
            ->onlyMethods(['setVar'])
            ->getMock()
        ;
        $obj->expects($this->once())->method('setVar')->with(3);

        // Method "getVar()" can still be invoked and executed.
        self::assertSame(2, $obj->getVar(), 'Property $var was initialized with 2 in constructor.');
        $obj->setVar(3); // Method "setVar()" is not actually executed.
        self::assertSame(2, $obj->getVar(), 'Property $var was initialized with 2 in constructor.');
    }

    /**
     * Test the "stub" test double.
     *
     * How do stubs work?
     * 1. All the methods can be invoked, but none of them are actually executed.
     * 2. Stubbed methods are not actually executed, although they can still be invoked and return specified values.
     */
    public function testStubUsingGetMockBuilder(): void
    {
        $obj = $this->createStub(TestClass::class);
        $obj->method('getVar')->willReturn(4);

        // Method "getVar()" can still be invoked, but never executed.
        self::assertSame(4, $obj->getVar(), 'Return value of method getVar() is always 4.');
        $obj->setVar(3); // Method "setVar()" is not actually executed.
        self::assertSame(4, $obj->getVar(), 'Return value of method getVar() is always 4.');

        // Property "var" holds an integer value "1", which is the default value of the property.
        // This means that during the life cycle of the stubbed object, the property is never set to any value via any method.
        self::assertSame(1, Reflection::getProperty($obj, 'var'), 'The property actually holds a non-zero integer value "1".');
    }
}