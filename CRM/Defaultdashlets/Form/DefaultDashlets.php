<?php

require_once 'CRM/Core/Form.php';

/**
 * Form controller class
 *
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC43/QuickForm+Reference
 */
class CRM_Defaultdashlets_Form_DefaultDashlets extends CRM_Core_Form {
	
	//~ function setDefaultValues() {
		//~ $defaults = array(
			//~ 'defaultdashlets' => ,
		//~ );
		//~ return $defaults;
	//~ }
	
	function buildQuickForm() {
		
	 $this->addButtons(array(
      array(
        'type' => 'submit',
        'name' => ts('Submit'),
        'isDefault' => TRUE,
      ),
    ));

	$groups = civicrm_api3('Group', 'get', array(
		'option.limit' => 0,
		'group_type' => '1'
	));
    $this->assign('groups', $groups['values']);
    
	$avalabledashlets = civicrm_api3("Dashboard", "get", array(
		'domain_id' => CRM_Core_Config::domainID(),
		'option.limit' => 0,
	));
	$this->assign('avalabledashlets', $avalabledashlets['values']);
	
	$defaultdashlets = CRM_Core_BAO_Setting::getItem('DefaultDashlets', 'defaultdashlets');
	$this->assign('defaultdashlets', $defaultdashlets);
 
	$this->assign('elementNames', $this->getRenderableElementNames());
    parent::buildQuickForm();
  }

  function postProcess() {
    $values = $this->getSubmitValues();
    
	CRM_Core_BAO_Setting::setItem($values['defaultdashlets'], 'DefaultDashlets', 'defaultdashlets');

    CRM_Core_Session::setStatus(ts('Saved!'));
    parent::postProcess();
  }
  
  /**
   * Get the fields/elements defined in this form.
   *
   * @return array (string)
   */
  function getRenderableElementNames() {
    // The _elements list includes some items which should not be
    // auto-rendered in the loop -- such as "qfKey" and "buttons".  These
    // items don't have labels.  We'll identify renderable by filtering on
    // the 'label'.
    $elementNames = array();
    foreach ($this->_elements as $element) {
      /** @var HTML_QuickForm_Element $element */
      $label = $element->getLabel();
      if (!empty($label)) {
        $elementNames[] = $element->getName();
      }
    }
    return $elementNames;
  }

}
