<?php

require_once 'defaultdashlets.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function defaultdashlets_civicrm_config(&$config) {
  _defaultdashlets_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param $files array(string)
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function defaultdashlets_civicrm_xmlMenu(&$files) {
  _defaultdashlets_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function defaultdashlets_civicrm_install() {
  _defaultdashlets_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function defaultdashlets_civicrm_uninstall() {
  _defaultdashlets_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function defaultdashlets_civicrm_enable() {
  _defaultdashlets_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function defaultdashlets_civicrm_disable() {
  _defaultdashlets_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function defaultdashlets_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _defaultdashlets_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function defaultdashlets_civicrm_managed(&$entities) {
  _defaultdashlets_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function defaultdashlets_civicrm_caseTypes(&$caseTypes) {
  _defaultdashlets_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function defaultdashlets_civicrm_angularModules(&$angularModules) {
_defaultdashlets_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function defaultdashlets_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _defaultdashlets_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function defaultdashlets_civicrm_preProcess($formName, &$form) {

}

*/

function defaultdashlets_civicrm_dashboard_defaults($availableDashlets, &$defaultDashlets){
	
	$defaultDashlets = array();
	
	$selecteddashlets = CRM_Core_BAO_Setting::getItem('DefaultDashlets', 'defaultdashlets');
	if (empty($selecteddashlets)) return;
	
	$contactID = CRM_Core_Session::singleton()->get('userID');
	
	try {
		$groups = civicrm_api3('Contact', 'get', array(
			'id' => $contactID,
			'return' => 'group',
		));
	} catch (Exception $e) {
		CRM_Core_Error::debug_log_message(
			'com.civicon2015.defaultdashlets - '.$e->getMessage()
		);
		return;
	}
	if (empty($groups['values'])) return;
	
	foreach ($groups['values'] as $group) {
		if (!empty($selecteddashlets[$group['id']])) {
			$group_id = $group['id'];
			break;
		}
	}
	if (empty($group_id)) return;
	
	$i = 0;
	foreach ($selecteddashlets[$group_id] as $dashlet_id => $dashlets) {
	
		$i = $i%2;
	
		$defaultDashlets[] = array(
			'dashboard_id' => $dashlet_id,
			'is_active' => 1,
			'column_no' => $i,
			'contact_id' => $contactID,
		);
		
		$i++;
	}
	
}
