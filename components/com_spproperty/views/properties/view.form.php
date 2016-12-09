<?php

/**
 * @package     SP Property
 *
 * @copyright   Copyright (C) 2010 - 2015 JoomShaper. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

defined('_JEXEC') or die();

class SppropertyViewProperties extends FOFViewForm{

	public function display($tpl = null){

		// Get model
		$model = $this->getModel();
		$this->items = $model->getItemList();

		$app = JFactory::getApplication();
		// get the active item
		$params  = $app->getMenu()->getActive()->params;
		$order_by = $params->get('order_by', '');

		// get current menu id
		$Itemid = $this->input->get('Itemid', 0, 'INT');

		// get component params
		jimport('joomla.application.component.helper');
		$this->cParams 	= JComponentHelper::getParams('com_spproperty');
		// get columns
		$this->columns 	= $this->cParams->get('properties_columns', 2);
		// get property types
		$this->property_total 		= $model->countProperties('', $order_by);
		$this->property_types 		= $model->getCategories(0, $order_by);
		// al property URL
		$this->all_properties_url 	= 'index.php?option=com_spproperty&view=properties&Itemid=' . $Itemid;

		foreach ($this->items as $this->item) {
			$this->item->url = JRoute::_('index.php?option=com_spproperty&view=property&id='. $this->item->spproperty_property_id .':'. $this->item->slug . SppropertyHelper::getItemid('properties'));
			$this->item->price = SppropertyHelper::generateCurrency($this->item->price);
		}
		

		//Generate Item Meta
		if(count($this->items)) {
			$itemMeta = array();
			//$itemMeta['image'] = JURI::base() . $this->items[0]->image;
			SppropertyHelper::itemMeta($itemMeta);
		}

		return parent::display($tpl = null);
	}
}