<?php

/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('resticted aceess');

class SppagebuilderAddonGmap extends SppagebuilderAddons {

    public function render() {

        $class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
        $title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
        $heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';

        //Options
        $map = (isset($this->addon->settings->map) && $this->addon->settings->map) ? $this->addon->settings->map : '';
        $gmap_api = (isset($this->addon->settings->gmap_api) && $this->addon->settings->gmap_api) ? $this->addon->settings->gmap_api : '';
        $type = (isset($this->addon->settings->type) && $this->addon->settings->type) ? $this->addon->settings->type : '';
        $zoom = (isset($this->addon->settings->zoom) && $this->addon->settings->zoom) ? $this->addon->settings->zoom : '';
        $mousescroll = (isset($this->addon->settings->mousescroll) && $this->addon->settings->mousescroll) ? $this->addon->settings->mousescroll : '';

        $water_color = (isset($this->addon->settings->water_color) && $this->addon->settings->water_color) ? $this->addon->settings->water_color : '';
        $highway_stroke_color = (isset($this->addon->settings->highway_stroke_color) && $this->addon->settings->highway_stroke_color) ? $this->addon->settings->highway_stroke_color : '';
        $highway_fill_color = (isset($this->addon->settings->highway_fill_color) && $this->addon->settings->highway_fill_color) ? $this->addon->settings->highway_fill_color : '';
        $local_stroke_color = (isset($this->addon->settings->local_stroke_color) && $this->addon->settings->local_stroke_color) ? $this->addon->settings->local_stroke_color : '';
        $local_fill_color = (isset($this->addon->settings->local_fill_color) && $this->addon->settings->local_fill_color) ? $this->addon->settings->local_fill_color : '';
        $poi_fill_color = (isset($this->addon->settings->poi_fill_color) && $this->addon->settings->poi_fill_color) ? $this->addon->settings->poi_fill_color : '';
        $administrative_color = (isset($this->addon->settings->administrative_color) && $this->addon->settings->administrative_color) ? $this->addon->settings->administrative_color : '';
        $landscape_color = (isset($this->addon->settings->landscape_color) && $this->addon->settings->landscape_color) ? $this->addon->settings->landscape_color : '';
        $road_text_color = (isset($this->addon->settings->road_text_color) && $this->addon->settings->road_text_color) ? $this->addon->settings->road_text_color : '';
        $road_arterial_fill_color = (isset($this->addon->settings->road_arterial_fill_color) && $this->addon->settings->road_arterial_fill_color) ? $this->addon->settings->road_arterial_fill_color : '';
        $road_arterial_stroke_color = (isset($this->addon->settings->road_arterial_stroke_color) && $this->addon->settings->road_arterial_stroke_color) ? $this->addon->settings->road_arterial_stroke_color : '';

        if ($map) {
            $map = explode(',', $map);
            $output = '<div id="sppb-addon-map-' . $this->addon->id . '" class="sppb-addon sppb-addon-gmap ' . $class . '">';
            $output .= ($title) ? '<' . $heading_selector . ' class="sppb-addon-title">' . $title . '</' . $heading_selector . '>' : '';
            $output .= '<div class="sppb-addon-content">';
            $output .= '<div id="sppb-addon-gmap-' . $this->addon->id . '" class="sppb-addon-gmap-canvas" data-lat="' . trim($map[0]) . '" data-lng="' . trim($map[1]) . '" data-maptype="' . $type . '" data-mapzoom="' . $zoom . '" data-mousescroll="' . $mousescroll . '" data-water_color="' . $water_color . '"
			data-highway_stroke_color="' . $highway_stroke_color . '"
			data-highway_fill_color="' . $highway_fill_color . '"
			data-local_stroke_color="' . $local_stroke_color . '"
			data-local_fill_color="' . $local_fill_color . '"
			data-poi_fill_color="' . $poi_fill_color . '"
			data-administrative_color="' . $administrative_color . '"
			data-landscape_color="' . $landscape_color . ' "
			data-road_text_color="' . $road_text_color . '"
			data-road_arterial_fill_color="' . $road_arterial_fill_color . '"
			data-road_arterial_stroke_color="' . $road_arterial_stroke_color . '"></div>';
            $output .= '</div>';
            $output .= '</div>';
            return $output;
        }

        return;
    }

    public function scripts() {

        jimport('joomla.application.component.helper');
        $app = JFactory::getApplication();
        $params = JComponentHelper::getParams('com_sppagebuilder');
        $gmap_api = $params->get('gmap_api', '');

        return array(
            '//maps.googleapis.com/maps/api/js?key=' . $gmap_api,
            JURI::base() . '/templates/' . $app->getTemplate() . '/js/gmap.js'
        );
    }

    // public function scripts() {
    //
  	// 	jimport('joomla.application.component.helper');
  	// 	$params = JComponentHelper::getParams('com_sppagebuilder');
  	// 	$gmap_api = $params->get('gmap_api', '');
    //
  	// 	return array(
  	// 		'//maps.googleapis.com/maps/api/js?key='. $gmap_api,
  	// 		JURI::base(true) . '/components/com_sppagebuilder/assets/js/gmap.js'
  	// 	);
  	// }

    public function css() {
        $addon_id = '#sppb-addon-' . $this->addon->id;
        $height = (isset($this->addon->settings->height) && $this->addon->settings->height) ? $this->addon->settings->height : 0;

        $css = '';
        if ($height) {
            $css .= $addon_id . ' .sppb-addon-gmap-canvas {';
            $css .= 'height:' . (int) $height . 'px;';
            $css .= '}';
        }

        return $css;
    }

}
