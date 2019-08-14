<?php

/**
 * Kerss Infotech
 * Kerss Twitter Tweets Magento Extension
 *
 * @category   Kerss
 * @package    Kerss_Tweets
 * @copyright  Copyright © 2015-2016 Kerss Infotech (http://kersstech.com/)
 */
class Kerss_Tweets_Model_System_Config_Source_Numbers {

    public function toOptionArray() {
        $array = array();
        for ($i = 1; $i <= 10; $i++) {
            $array[] = array('value' => $i, 'label' => ucfirst($i));
        }
        return $array;
    }

}
