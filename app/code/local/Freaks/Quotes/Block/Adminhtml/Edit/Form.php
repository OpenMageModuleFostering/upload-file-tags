<?php
class Freaks_Quotes_Block_Adminhtml_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
    {   
        $quote = Mage::registry('current_quote');
        $form = new Varien_Data_Form(array(
            'enctype'=> 'multipart/form-data'
        ));
        $fieldset = $form->addFieldset('edit_quote', array(
            'legend' => Mage::helper('freaks_quotes')->__('File Tags Details')
        ));

        if ($quote->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name'      => 'id',
                'required'  => true
            ));
        }
 
        $fieldset->addField('name', 'text', array(
            'name'      => 'name',
            'title'     => Mage::helper('freaks_quotes')->__('Tags'),
            'label'     => Mage::helper('freaks_quotes')->__('Tags'),
            'maxlength' => '250',
            'note'      => Mage::helper('cms')->__('Format tags (pdf;video;)'),
            'required'  => true,
        ));

        $fieldset->addField('title', 'text', array(
            'name'      => 'title',
            'title'     => Mage::helper('freaks_quotes')->__('Title'),
            'label'     => Mage::helper('freaks_quotes')->__('Title'),
            'maxlength' => '250',
            'note'      => Mage::helper('cms')->__('Document title'),
            'required'  => true,
        ));
         
        $fieldset->addField('image', 'file', array(
            'name'      => 'image',
            'label'     => Mage::helper('freaks_quotes')->__('File'),
            'note'      => 'Max file size: '.ini_get('upload_max_filesize'),
        ));
 
 		$form->setMethod('post');
        $form->setUseContainer(true);
        $form->setId('edit_form');
        $form->setAction($this->getUrl('*/*/save'));
        
        $data = $quote->getData();
        $data['image'] = $quote->getImage();

        $form->setValues($data);
 
        $this->setForm($form);
    }
}
