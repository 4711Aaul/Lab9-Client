<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * TaskListTest to verify that the collection of tasks has more uncompleted 
 * tasks than completed ones.
 *
 * @author Paul
 */
class TaskListTest extends PHPUnit_Framework_TestCase  {
    
    private $CI;

    public function setUp() 
    {
      // Load CI instance normally
      $this->CI = &get_instance();
    }

    public function testComplete() 
    {
        $tasks = $this->CI->tasks->all();
        
        $tasksComplete = 0;
        $tasksIncomplete = 0;

        foreach ($tasks as $task) {
            if ($task->status == 2){
                $tasksComplete++;
            } else  if ($task->status != 2){
                $tasksIncomplete++;
            }
        }
        
        $this->assertGreaterThan($tasksComplete, $tasksIncomplete);
    }
}
