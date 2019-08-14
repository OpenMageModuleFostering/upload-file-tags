<?php
class Freaks_Quotes_Adminhtml_QuotesController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Upload Files'));

        $this->loadLayout();
        $this->_setActiveMenu('freaks_quotes');
        $this->_addBreadcrumb(Mage::helper('freaks_quotes')->__('Upload Files'), Mage::helper('freaks_quotes')->__('Upload'));
        $this->renderLayout();
    }
    
    public function newAction()
    {
        $this->_title($this->__('Add new file'));
        $this->loadLayout();
        $this->_setActiveMenu('freaks_quotes');
        $this->_addBreadcrumb(Mage::helper('freaks_quotes')->__('Add new file'), Mage::helper('freaks_quotes')->__('Add new file'));
        $this->renderLayout();
    }
    
    public function editAction()
    {
        $this->_title($this->__('Edit File Tags'));

        $this->loadLayout();
        $this->_setActiveMenu('freaks_quotes');
        $this->_addBreadcrumb(Mage::helper('freaks_quotes')->__('Edit tags'), Mage::helper('freaks_quotes')->__('Edit tags'));
        $this->renderLayout();
    }
    
    public function deleteAction()
    {
        $tipId = $this->getRequest()->getParam('id', false);
 
        try {
            Mage::getModel('freaks_quotes/quote')->setId($tipId)->delete();
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('freaks_quotes')->__('File successfully deleted'));
            
            return $this->_redirect('*/*/');
        } catch (Mage_Core_Exception $e){
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($this->__('Somethings went wrong'));
        }
 
        $this->_redirectReferer();
    }

    public function saveAction()
    {   
        $data = $this->getRequest()->getPost();
        if (!empty($data)) {
            try {
                Mage::getModel('freaks_quotes/quote')->setData($data)
                    ->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('freaks_quotes')->__('File successfully saved'));
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::logException($e);
                Mage::getSingleton('adminhtml/session')->addError($this->__('Somethings went wrong'));
            }
        }
        return $this->_redirect('*/*/');
    }
    
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('freaks_quotes/adminhtml_quotes_grid')->toHtml()
        );
    }

    public function massDeleteAction()
    {
        $taxIds = $this->getRequest()->getParam('quotesGrid');      // $this->getMassactionBlock()->setFormFieldName('tax_id'); from Mage_Adminhtml_Block_Tax_Rate_Grid
        if(!is_array($taxIds))
        {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select file(es).'));
        } 
        else
        {
            try 
            {
                $rateModel = Mage::getModel('freaks_quotes/quote');
                foreach ($taxIds as $taxId) {
                    $rateModel->load($taxId)->delete();
            }
            Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('tax')->__('Total of %d record(s) were deleted.', count($taxIds)));
            } 
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }
}
