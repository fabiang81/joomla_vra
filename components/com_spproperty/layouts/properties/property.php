<?php
/**
 * @package     SP Property
 *
 * @copyright   Copyright (C) 2010 - 2016 JoomShaper. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

defined('_JEXEC') or die('Restricted Access');

// get component params
jimport('joomla.application.component.helper');
$this->cParams = JComponentHelper::getParams('com_spproperty');
$property_rm_btn = $this->cParams->get('prpry_rm_btn_text', JText::_('COM_SPPROPERTY_PROPERTIES_BTN_TEXT'));

$property     = $displayData['property'];

if ($property) { ?>
    <div class="sp-properties-wrapper">
        <div class="property-image">
            <img src="<?php echo JUri::root() . $property->image; ?>" alt="<?php echo $property->title; ?>">
        </div>
        <div class="property-details">
            <span class="property-category"><?php echo $property->category_name; ?></span>
            <h3 class="property-title">
                <a href="<?php echo $property->url; ?>">
                    <?php echo $property->title; ?>
                </a>
            </h3>

            <span class="property-price">
                <?php echo $property->price; ?>/<?php echo JText::_('COM_SPPROPERTY_PROPERTIES_SQFT'); ?>
            </span>
            
            <span class="property-summery">
                <ul>
                    <?php if($property->psize){ ?>
                    <li class="area-size"><?php echo $property->psize; ?> <?php echo JText::_('COM_SPPROPERTY_PROPERTIES_SQFT'); ?></li>
                    <?php } if($property->beds){ ?>
                    <li class="bedroom"><?php echo $property->beds; ?> <?php echo JText::_('COM_SPPROPERTY_PROPERTIES_BEDROOMS'); ?></li>
                    <?php } if($property->baths){ ?>
                    <li class="bathroom"><?php echo $property->baths; ?> <?php echo JText::_('COM_SPPROPERTY_PROPERTIES_BATHS'); ?></li>
                    <?php } if($property->garages){ ?>
                    <li class="parking"><?php echo $property->garages; ?> <?php echo JText::_('COM_SPPROPERTY_PROPERTIES_PARKING'); ?></li>
                    <?php } ?>
                </ul>
            </span>

            <span class="properties-search-button">
                <a href="<?php echo $property->url; ?>" class="sppb-btn sppb-btn-primary sppb-btn-sm" role="button"><?php echo $property_rm_btn; ?></a>
            </span>
        </div>
    </div> <!-- /.sp-properties-wrapper -->
<?php } ?>
