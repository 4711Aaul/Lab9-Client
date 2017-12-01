<?php
/**
 * This controller is for the help wanted section of the website.
 *
 * @author Andrew
 */
class Helpme extends Application
{
    public function index() {
        $this->data['pagetitle'] = 'Help Wanted!';
        $stuff = file_get_contents('../data/jobs.md');
        $this->data['content'] = $this->parsedown->parse($stuff);
        $this->render(); 
    }
}
