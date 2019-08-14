<?php

/**
 * Kerss Infotech
 * Kerss Twitter Tweets Magento Extension
 *
 * @category   Kerss
 * @package    Kerss_Tweets
 * @copyright  Copyright © 2015-2016 Kerss Infotech (http://kersstech.com/)
 */
class Kerss_Tweets_Block_System_Config_Form_Field_Colorpicker extends Mage_Adminhtml_Block_System_Config_Form_Field {

    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element) {
        $html = $element->getElementHtml();
        $jsPath = $this->getJsUrl('kerss/jquery/jquery-1.8.3.min.js');
        $mcpPath = $this->getJsUrl('kerss/jquery/plugins/mcolorpicker/');

        if (!Mage::registry('jqueryLoaded')) {
            $html .= '<script type="text/javascript" src="' . $jsPath . '"></script>
                <script type="text/javascript">jQuery.noConflict();</script>';
            Mage::register('jqueryLoaded', 1);
        }

        if (!Mage::registry('colorpickerLoaded')) {
            $html .= '<script type="text/javascript" src="' . $mcpPath . 'mcolorpicker.min.js"></script>
			    <script type="text/javascript">
				    jQuery.fn.mColorPicker.init.replace = false;
				    jQuery.fn.mColorPicker.defaults.imageFolder = "' . $mcpPath . 'images/";
				    jQuery.fn.mColorPicker.init.allowTransparency = true;
				    jQuery.fn.mColorPicker.init.showLogo = false;
			    </script>';
            Mage::register('colorpickerLoaded', 1);
        }

        $html .= '<script type="text/javascript">
				jQuery(function($){
					$("#' . $element->getHtmlId() . '").attr("data-hex", true).width("250px").mColorPicker();
				});
			</script>';

        return $html;
    }

}
