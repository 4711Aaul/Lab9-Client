<?php

require_once 'Entity.php';

/**
 * Description of Task
 *
 * @author Andrew
 */
class Task extends Entity {
    private $task,
            $priority,
            $size,
            $group,
            $deadline,
            $status,
            $flag,
            $id;

    public function __toArray() {
        return array(
            'task' => $this->task,
            'priority' => $this->priority,
            'size' => $this->size,
            'group' => $this->group,
            'deadline' => $this->deadline,
            'status' => $this->status,
            'flag' => $this->flag,
            'id' => $this->id
        );
    }
    
    public function setTask($value) {
        if (is_string($value)) //&& str_len($value) <= 64)
            $this->task = $value;
    }

    public function setPriority($value) {
        if (is_int($value) && $value <= 3 && $value > 0)
            $this->priority = $value;
    }

    public function setSize($value) {
        if (is_int($value) && $value <= 3 && $value > 0)
            $this->size = $value;
    }

    function setId($id) {
        if (is_int($id) && $id >= 0)
            $this->id = $id;
    }

    public function setGroup($value) {
        if (is_int($value) && $value <= 4 && $value > 0)
            $this->group = $value;
    }

    function setDeadline($deadline) {
        if (is_int($deadline) && $deadline >= 20160000)
            $this->deadline = $deadline;
    }

    function setStatus($status) {
        if (is_int($status) && ($status == 1 || $status == 2))
            $this->status = $status;
    }

    function setFlag($flag) {
        if (is_int($flag) && $flag == 1)
            $this->flag = $flag;
    }

    function getTask() {
        return $this->task;
    }

    function getPriority() {
        return $this->priority;
    }

    function getSize() {
        return $this->size;
    }

    function getGroup() {
        return $this->group;
    }

    function getDeadline() {
        return $this->deadline;
    }

    function getStatus() {
        return $this->status;
    }

    function getFlag() {
        return $this->flag;
    }
    
    function getId() {
        return $this->id;
    }
}
