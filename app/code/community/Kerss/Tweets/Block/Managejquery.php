<?php

/**
 * Kerss Infotech
 * Kerss Twitter Tweets Magento Extension
 *
 * @category   Kerss
 * @package    Kerss_Tweets
 * @copyright  Copyright © 2015-2016 Kerss Infotech (http://kersstech.com/)
 */
class Kerss_Tweets_Block_Managejquery extends Mage_Core_Block_Template {

    public function addJqueryCss() {
        $helper = Mage::helper('tweets/data');
        $disable_output = Mage::getStoreConfig('advanced/modules_disable_output/Kerss_Tweets');
        if ($disable_output == 0) {
            $enabled = $helper->getConfigValue('tweets/twittersettings/active');
            if ($enabled) {
                $jquery_enabled = $helper->getConfigValue('tweets/displaysettings/enablejq');
                $_head = $this->__getHeadBlock();
                $_head->addCss('css/twitter/tweets.css');
                $_head->addCss('css/twitter/lionbars.css');
                $_head->addCss('css/twitter/font-awesome.min.css');
                if ($jquery_enabled) {
                    $_head->addJs('kerss/jquery/jquery-1.8.3.min.js');
                    $_head->addJs('kerss/jquery/jquery.noconflict.js');
                }
                $_head->addJs('kerss/jquery/jquery.lionbars.0.3.js');
                return $_head;
            }
        }
    }

    private function __getHeadBlock() {
        return $this->getLayout()->getBlock('head');
    }

}
