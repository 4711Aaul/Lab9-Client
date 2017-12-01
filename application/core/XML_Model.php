<?php

require_once __DIR__.'/../models/Task.php';

/**
 * XML_Model.
 * A model for accessing XML.
 *
 * @author Andrew
 */
class XML_Model extends Memory_Model {

    /**
     * Constructor.
     * @param string $origin Filename of the XML file
     * @param string $keyfield  Name of the primary key field
     * @param string $entity	Entity name meaningful to the persistence
     */
    function __construct($origin = null, $keyfield = 'id', $entity = null) {
        parent::__construct();

        // guess at persistent name if not specified
        if ($origin == null)
            $this->_origin = get_class($this);
        else
            $this->_origin = $origin;

        // remember the other constructor fields
        $this->_keyfield = $keyfield;
        $this->_entity = $entity;

        // start with an empty collection
        $this->_data = array(); // an array of objects
        $this->fields = array(); // an array of strings
        // and populate the collection
        $this->load();
    }

    /**
     * Load the collection state appropriately, depending on persistence choice.
     * OVER-RIDE THIS METHOD in persistence choice implementations
     */
    protected function load() {
        $xml = simplexml_load_file($this->_origin);
        
        foreach ($xml->children() as $child) {
            $attributes = $child->attributes();

            $record = new stdClass();
            $record->{"priority"} = $this->validate(intval($attributes['priority']));
            $record->{"size"} = $this->validate(intval($attributes['size']));
            $record->{"group"} = $this->validate(intval($attributes['group']));
            $record->{"deadline"} = $attributes['deadline'];
            $record->{"status"} = $this->validate(intval($attributes['status']));
            $record->{"flag"} = $this->validate(intval($attributes['flag']));
            $record->{"id"} = $this->validate(intval($attributes['id']));
            $record->{"task"} = (string) $child;
            
            $key = $record->id;
            $this->_data[$key] = $record;
        }
        foreach((array)$record as $key=>$val)
            $this->_fields[] = $key;
        
        $this->reindex();
    }

    /**
     * Store the collection state appropriately, depending on persistence choice.
     * OVER-RIDE THIS METHOD in persistence choice implementations
     */
    protected function store() {
        $xmlstr = '<?xml version="1.0" encoding="UTF-8"?> <tasks></tasks>';
        $xml = new SimpleXMLElement($xmlstr);
        
        foreach($this->_data as $id=>$object){
            $xmlelem = $xml->addChild('task', $object->task);
            foreach((array)$object as $field=>$contents){
            if (!($field === "task" || $field === "submit")) {
                    $xmlelem->addAttribute($field, $contents);
                }
            }
        }
        $xml -> asXML($this->_origin);
    }
        
    private function validate($num)
    {
        if ($num == 0)
            return '';
        return $num;
    }
}
