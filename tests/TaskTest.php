<?php

/**
 * Description of TaskTest
 *
 * @author Andrew
 */
class TaskTest extends PHPUnit_Framework_TestCase {

    private $task;

    public function setUp() 
    {
        $this->task = new Task();
    }

    public function testSetValid() 
    {
        $this->task->setTask("Do stuff");
        $this->task->setSize(1);
        $this->task->setPriority(1);
        $this->task->setGroup(2);
        
        $task = $this->task->getTask();
        $size = $this->task->getSize();
        $priority = $this->task->getPriority();
        $group = $this->task->getGroup();
                
        $this->assertEquals("Do stuff", $task);
        $this->assertEquals(1, $size);
        $this->assertEquals(1, $priority);
        $this->assertEquals(2, $group);
    }
    
    public function testSetInvalid()
    {
        $this->task->setTask(20);
        $this->task->setSize(-100);
        $this->task->setPriority(100);
        $this->task->setGroup(200);
        
        $task = $this->task->getTask();
        $size = $this->task->getSize();
        $priority = $this->task->getPriority();
        $group = $this->task->getGroup();
        
        $this->assertNotEquals(20, $task);
        $this->assertNotEquals(-100, $size);
        $this->assertNotEquals(100, $priority);
        $this->assertNotEquals(200, $group);
    }
}
