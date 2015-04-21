<?php

require_once 'CRM/Core/Form.php';

/**
 * Form controller class
 *
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC43/QuickForm+Reference
 */
class CRM_Defaultdashlets_Form_DefaultDashlets extends CRM_Core_Form {
  function buildQuickForm() {

    //~ // add form elements
    //~ $this->add(
      //~ 'select', // field type
      //~ 'favorite_color', // field name
      //~ 'Favorite Color', // field label
      //~ $this->getColorOptions(), // list of options
      //~ true // is required
    //~ );
    //~ $this->addButtons(array(
      //~ array(
        //~ 'type' => 'submit',
        //~ 'name' => ts('Submit'),
        //~ 'isDefault' => TRUE,
      //~ ),
    //~ ));

	$groups = civicrm_api3('Group', 'get', array(
		'option.limit' => 0,
	));
    $this->assign('groups', $groups['values']);
    
	$avalabledashlets = civicrm_api3("Dashboard", "get", array(
		'domain_id' => CRM_Core_Config::domainID(),
		'option.limit' => 0,
	));
	$this->assign('avalabledashlets', $avalabledashlets['values']);
	echo '<pre>',print_r($avalabledashlets['values'],true),'</pre>';
 
    parent::buildQuickForm();
  }

  function postProcess() {
    //~ $values = $this->exportValues();
    CRM_Core_Session::setStatus(ts('Saved!'));
    parent::postProcess();
  }

}
