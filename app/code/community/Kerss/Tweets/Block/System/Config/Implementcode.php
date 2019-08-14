<?php

/**
 * Kerss Infotech
 * Kerss Twitter Tweets Magento Extension
 *
 * @category   Kerss
 * @package    Kerss_Tweets
 * @copyright  Copyright © 2015-2016 Kerss Infotech (http://kersstech.com/)
 */
class Kerss_Tweets_Block_System_Config_Implementcode extends Mage_Adminhtml_Block_System_Config_Form_Field {

    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element) {

        return '
<div class="entry-edit-head collapseable"><a onclick="Fieldset.toggleCollapse(\'tweetbox_template\'); return false;" href="#" id="tweetbox_template-head" class="open">Manually Implement Code</a></div>
<input id="tweetbox_template-state" type="hidden" value="1" name="config_state[tweetbox_template]">
<fieldset id="tweetbox_template" class="config collapseable" style="">
<h4 class="icon-head head-edit-form fieldset-legend">Code for Twitter Tweets</h4>

<div id="messages">
    <ul class="messages">
        <li class="notice-msg">
            <ul>
                <li>' . Mage::helper('tweets')->__('Add code below to a template file') . '</li>
            </ul>
        </li>
    </ul>
</div>
<ul>
	<li>
		<code>
			$this->getLayout()->createBlock(' . '"tweets/tweets"' . ')->setTemplate(' . '"kerss/tweets/tweets.phtml"' . ')->toHtml();
		</code>
	</li>
</ul>
<br>
<div id="messages">
    <ul class="messages">
        <li class="notice-msg">
            <ul>
                <li>' . Mage::helper('tweets')->__('Add below code to a CMS page') . '</li>
            </ul>
        </li>
    </ul>
</div>
<ul>
	<li>
		<code>
			{{block type="tweets/tweets" name="tweets.cms" template="kerss/tweets/tweets.phtml"}}
		</code>
	</li>
</ul>
<br>
<div id="messages">
    <ul class="messages">
        <li class="notice-msg">
            <ul>
                <li>' . Mage::helper('tweets')->__('Add below code to xml layout files') . '</li>
            </ul>
        </li>
    </ul>
</div>

<ul>
	<li>
		<code>
		 &lt;block type="tweets/tweets" name="fblikebox.fblikebox" template="kerss/tweets/tweets.phtml"&gt;<br>
		
		&lt;/block&gt;
		</code>	
	</li>
</ul>
</fieldset>';
    }

}
