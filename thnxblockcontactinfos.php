<?php
use PrestaShop\PrestaShop\Core\Module\WidgetInterface;
class thnxblockcontactinfos extends Module implements WidgetInterface
{
	protected static $contact_fields = array(
		'thnxblckcntctnfs_CMPNY',
		'thnxblckcntctnfs_ADRS',
		'thnxblckcntctnfs_PHN',
		'thnxblckcntctnfs_EML'
	);
	public function __construct()
	{
		$this->name = 'thnxblockcontactinfos';
		$this->author = 'thanksit.com';
		$this->tab = 'front_office_features';
		$this->version = '1.0.0';
		$this->bootstrap = true;
		parent::__construct();	
		$this->displayName = $this->l('Platinum Contact information block');
		$this->description = $this->l('This module will allow you to display your e-stores contact information in a customizable block.');
		$this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
	}
	public function install()
	{
		if(!parent::install()
			|| !$this->registerHook('Footer')
			)
		return false;
			Configuration::updateValue('thnxblckcntctnfs_CMPNY', Configuration::get('PS_SHOP_NAME'));
			Configuration::updateValue('thnxblckcntctnfs_ADRS', trim(preg_replace('/ +/', ' ', Configuration::get('PS_SHOP_ADDR1').' '.Configuration::get('PS_SHOP_ADDR2')."\n".Configuration::get('PS_SHOP_CODE').' '.Configuration::get('PS_SHOP_CITY')."\n".Country::getNameById(Configuration::get('PS_LANG_DEFAULT'), Configuration::get('PS_SHOP_COUNTRY_ID')))));
			Configuration::updateValue('thnxblckcntctnfs_PHN', Configuration::get('PS_SHOP_PHONE'));
			Configuration::updateValue('thnxblckcntctnfs_EML', Configuration::get('PS_SHOP_EMAIL'));
		return true;
	}
	public function uninstall()
	{
		if(!parent::uninstall())
			return false;
		if(isset(thnxblockcontactinfos::$contact_fields) && !empty(thnxblockcontactinfos::$contact_fields)){
			foreach(thnxblockcontactinfos::$contact_fields as $field){
				Configuration::deleteByName($field);
			}
		}
		return true;
	}
	public function getContent()
	{
		$html = '';
		if (Tools::isSubmit('submitModule'))
		{	
			if(isset(thnxblockcontactinfos::$contact_fields) && !empty(thnxblockcontactinfos::$contact_fields)){
				foreach(thnxblockcontactinfos::$contact_fields as $field){
					Configuration::updateValue($field, Tools::getValue($field), true);
				}
			}
			$html = $this->displayConfirmation($this->l('Configuration updated'));
		}
		return $html.$this->renderForm();
	}
	public function renderWidget($hookName = null, array $configuration = [])
	{
	    $this->smarty->assign($this->getWidgetVariables($hookName,$configuration));
	    return $this->fetch('module:'.$this->name.'/views/templates/front/'.$this->name.'.tpl');	
	}
	public function getWidgetVariables($hookName = null, array $configuration = [])
	{
		$return_arr = array();
	    if(isset(thnxblockcontactinfos::$contact_fields) && !empty(thnxblockcontactinfos::$contact_fields)){
	    	foreach(thnxblockcontactinfos::$contact_fields as $field){
	    		$return_arr[$field] = Configuration::get($field);
	    	}
	    }
	    $return_arr['hookName'] = $hookName;
	    return $return_arr;
	}
	public function renderForm()
	{
		$fields_form = array(
			'form' => array(
				'legend' => array(
					'title' => $this->l('Settings'),
					'icon' => 'icon-cogs'
				),
				'input' => array(
					array(
						'type' => 'text',
						'label' => $this->l('Company name'),
						'name' => 'thnxblckcntctnfs_CMPNY',
					),
					array(
						'type' => 'textarea',
						'label' => $this->l('Address'),
						'name' => 'thnxblckcntctnfs_ADRS',
					),
					array(
						'type' => 'text',
						'label' => $this->l('Phone number'),
						'name' => 'thnxblckcntctnfs_PHN',
					),
					array(
						'type' => 'text',
						'label' => $this->l('Email'),
						'name' => 'thnxblckcntctnfs_EML',
					),
				),
				'submit' => array(
					'title' => $this->l('Save')
				)
			),
		);
		$helper = new HelperForm();
		$helper->show_toolbar = false;
		$helper->table =  $this->table;
		$lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
		$helper->default_form_language = $lang->id;
		$helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
		$this->fields_form = array();
		$helper->identifier = $this->identifier;
		$helper->submit_action = 'submitModule';
		$helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->tpl_vars = array(
			'fields_value' => array(),
			'languages' => $this->context->controller->getLanguages(),
			'id_language' => $this->context->language->id
		);
		if(isset(thnxblockcontactinfos::$contact_fields) && !empty(thnxblockcontactinfos::$contact_fields)){
			foreach(thnxblockcontactinfos::$contact_fields as $field){
				$helper->tpl_vars['fields_value'][$field] = Tools::getValue($field, Configuration::get($field));
			}
		}
		return $helper->generateForm(array($fields_form));
	}
}