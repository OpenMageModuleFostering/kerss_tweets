<?php

/**
 * Kerss Infotech
 * Kerss Twitter Tweets Magento Extension
 *
 * @category   Kerss
 * @package    Kerss_Tweets
 * @copyright  Copyright © 2015-2016 Kerss Infotech (http://kersstech.com/)
 */
class Kerss_Tweets_Block_Tweets extends Mage_Core_Block_Template implements Mage_Widget_Block_Interface {

    protected function _toHtml() {
        $this->setTemplate('kerss/tweets/tweets.phtml');
        return parent::_toHtml();
    }

}
