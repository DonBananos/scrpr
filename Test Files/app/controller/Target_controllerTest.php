<?php

/**
 * Generated by PHPUnit_SkeletonGenerator.
 * @author HLO & Boeck
 * REMINDER! Remember comment out session_start() in top of Config.php
 * Some of the preceeding method calls use Config.php, and the test will
 * FAIL because of some session issues.
 * 
 * Consideration: Should users only be aloved to enter domains; and not also IP?
 * Because then we could make strct regex for validating URL's.
 */
class Target_controllerTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Target_controller
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Target_controller;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers Target_controller::check_on_url
     * @todo   Implement testCheck_on_url().
     */
    public function testUrlIsValid() {
        $url = "http://dr.dk";
        $this->assertEquals($url, $this->object->check_on_url($url));
    }
    
    /**
     * @covers Target_controller::check_on_url
     * @todo   Implement testCheck_on_url().
     */
    public function testUrlIsNotValid() {
        $url = "randomness";
        $this->assertNotEquals($url, $this->object->check_on_url($url));
    }
    
    /**
     * @covers Target_controller::check_on_url
     * @todo   Implement testCheck_on_url().
     */
    public function testHttpsIsValid() {
        $url = "https://dr.dk";
        $this->assertEquals($url, $this->object->check_on_url($url));
    }
    
    /**
     * @covers Target_controller::check_on_url
     * @todo   Implement testCheck_on_url().
     */
    public function testHttpIsValid() {
        $url = "dr.dk";
        $expected = 'http://'.$url;
        $result = $this->object->check_on_url($url);
        $this->assertEquals($expected, $result);
    }
    
    
    
    

}
