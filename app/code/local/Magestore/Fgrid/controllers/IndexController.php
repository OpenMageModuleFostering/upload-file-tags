<?php
class Magestore_Fgrid_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/fgrid?id=15 
    	 *  or
    	 * http://site.com/fgrid/id/15 	
    	 */
    	/* 
		$fgrid_id = $this->getRequest()->getParam('id');

  		if($fgrid_id != null && $fgrid_id != '')	{
			$fgrid = Mage::getModel('fgrid/fgrid')->load($fgrid_id)->getData();
		} else {
			$fgrid = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($fgrid == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$fgridTable = $resource->getTableName('fgrid');
			
			$select = $read->select()
			   ->from($fgridTable,array('fgrid_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$fgrid = $read->fetchRow($select);
		}
		Mage::register('fgrid', $fgrid);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
}