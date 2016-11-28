<?php

class ratings {
     
        private $data_file = './ratings.data.txt';
        private $widget_id;
        private $data = array();
        
    function __construct($wid) {
     
        $this->widget_id = $wid;

        $all = file_get_contents($this->data_file);

        if($all) {
            $this->data = unserialize($all);
        }
    }
}

    ?>
    