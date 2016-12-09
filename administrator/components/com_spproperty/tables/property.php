<?php
/**
 * @package     SP Property
 *
 * @copyright   Copyright (C) 2010 - 2016 JoomShaper. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die('Restricted access!');

class SppropertyTableProperty extends FOFTable{

	public function check() {

		$result = true;

		//features
		if (is_array($this->features)){
			if (!empty($this->features)){
				$this->features = json_encode($this->features);
			}
		}
		if (is_null($this->features) || empty($this->features)){
			$this->features = '';
		}

		return $result;
	}

	public function onAfterLoad(&$result) {

		// features
		if(!is_array($this->features)) {
			if(!empty($this->features)) {
				$this->features = json_decode($this->features, true);
			}
		}

		if(is_null($this->features) || empty($this->features)) {
			$this->features = array();
		}

		return parent::onAfterLoad($result);
	}
}