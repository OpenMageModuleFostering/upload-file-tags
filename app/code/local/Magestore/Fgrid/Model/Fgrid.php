<?php

class Magestore_Fgrid_Model_Fgrid extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('fgrid/fgrid');
    }
}