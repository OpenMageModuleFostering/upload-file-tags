<?php
class Magestore_Fgrid_Block_Fgrid extends Mage_Core_Block_Template
{
    public function __construct()
    {  
        parent::__construct();
        $tags = $_GET['q'];
        $collection = Mage::getModel('fgrid/fgrid')->getCollection()->addFieldToFilter('name', array('like' => '%'.$tags.'%'));
        $this->setCollection($collection);
    }

	public function _prepareLayout()
    {
		parent::_prepareLayout();
        $pager= $this->getLayout()->createBlock('page/html_pager', 'fgrid.pager')->setCollection($this->getCollection());
        $this->setChild('pager', $pager);
        return $this;
    }
    
    public function getFgrid()     
    { 
        if (!$this->hasData('fgrid')) {
            $this->setData('fgrid', Mage::registry('fgrid'));
        }
        return $this->getData('fgrid');
        
    }

    public function getPagerHtml()
    {   
        return $this->getChildHtml('pager');
    }

}