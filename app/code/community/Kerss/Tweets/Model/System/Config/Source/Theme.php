<?php

/**
 * Kerss Infotech
 * Kerss Twitter Tweets Magento Extension
 *
 * @category   Kerss
 * @package    Kerss_Tweets
 * @copyright  Copyright © 2015-2016 Kerss Infotech (http://kersstech.com/)
 */
class Kerss_Tweets_Model_System_Config_Source_Theme {

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray() {
        return array(
            array('value' => 'light', 'label' => Mage::helper('adminhtml')->__('Light')),
            array('value' => 'dark', 'label' => Mage::helper('adminhtml')->__('Dark')),
        );
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray() {
        return array(
            'light' => Mage::helper('adminhtml')->__('Light'),
            'dark' => Mage::helper('adminhtml')->__('Dark'),
        );
    }

}
