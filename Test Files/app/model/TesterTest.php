<?php

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-09-28 at 13:32:25.
 */
class TesterTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Tester
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Tester;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers Tester::add
     * @todo   Implement testAdd().
     */
    public function testAdd()  {
        // Remove the following lines when you implement this test.
        $this->assertEquals(4, $this->object->add(2, 2));
    }

}
