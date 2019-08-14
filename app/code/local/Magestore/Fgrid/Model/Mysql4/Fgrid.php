<?php

class Magestore_Fgrid_Model_Mysql4_Fgrid extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the fgrid_id refers to the key field in your database table.
        $this->_init('fgrid/fgrid', 'fgrid_id');
    }
}