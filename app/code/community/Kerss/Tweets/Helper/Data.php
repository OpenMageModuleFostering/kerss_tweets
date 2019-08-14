<?php

/**
 * Kerss Infotech
 * Kerss Twitter Tweets Magento Extension
 *
 * @category   Kerss
 * @package    Kerss_Tweets
 * @copyright  Copyright © 2015-2016 Kerss Infotech (http://kersstech.com/)
 */
class Kerss_Tweets_Helper_Data extends Mage_Core_Helper_Abstract {

    public function getConfigValue($value) {
        $storeid = Mage::app()->getStore()->getStoreId();
        return Mage::getStoreConfig($value, $storeid);
    }

    public function getTwitterId() {
        return $this->getConfigValue('tweets/twittersettings/twitterid');
    }

    public function getKeys() {
        $consumerkey = $this->getConfigValue('tweets/twittersettings/consumerkey');
        $consumersecret = $this->getConfigValue('tweets/twittersettings/consumersecret');
        $accesstoken = $this->getConfigValue('tweets/twittersettings/accesstoken');
        $accesstokensecret = $this->getConfigValue('tweets/twittersettings/accesstokensecret');

        if ($consumerkey && $consumersecret && $accesstoken && $accesstokensecret) {
            return array(
                'consumerkey' => $consumerkey,
                'consumersecret' => $consumersecret,
                'accesstoken' => $accesstoken,
                'accesstokensecret' => $accesstokensecret
            );
        } else {
            return false;
        }
    }

    public function getNoFollow() {
        return $this->getConfigValue('tweets/displaysettings/usenofollow');
    }

    public function getNumberOfTweets() {
        return $this->getConfigValue('tweets/displaysettings/numberoftweets');
    }

    public function getTagPref() {
        return $this->getConfigValue('tweets/displaysettings/showlinks');
    }

    public function getNewWindow() {
        return $this->getConfigValue('tweets/displaysettings/opennew');
    }

    public function getHashtags() {
        return $this->getConfigValue('tweets/displaysettings/hashtags');
    }

    public function getAttags() {
        return $this->getConfigValue('tweets/displaysettings/attags');
    }

    private function changeLink($string, $tags = true, $nofollow = true, $newwindow = true, $attags = true, $hashtags = true) {
        if (!$tags) {
            $string = strip_tags($string);
        }
        if ($nofollow) {
            $string = str_replace('<a ', '<a rel="nofollow"', $string);
        }
        if ($newwindow) {
            $string = str_replace('<a ', '<a target="_blank"', $string);
        }
        return $string;
    }

    public function getTweets($tweets) {
        $t = array();
        $i = 0;

        foreach ($tweets as $tweet) {
            $text = $tweet->text;
            $urls = $tweet->entities->urls;
            $mentions = $tweet->entities->user_mentions;
            $hashtags = $tweet->entities->hashtags;
            if ($urls) {
                foreach ($urls as $url) {
                    if (strpos($text, $url->url) !== false) {
                        $text = str_replace($url->url, '<a href="' . $url->url . '">' . $url->url . '</a>', $text);
                    }
                }
            }
            if ($mentions && $this->getAttags()) {
                foreach ($mentions as $mention) {
                    if (strpos($text, $mention->screen_name) !== false) {
                        $text = str_replace("@" . $mention->screen_name . " ", '<a href="http://twitter.com/' . $mention->screen_name . '">@' . $mention->screen_name . '</a> ', $text);
                    }
                }
            }
            if ($hashtags && $this->getHashtags()) {
                foreach ($hashtags as $hashtag) {
                    if (strpos($text, $hashtag->text) !== false) {
                        $text = str_replace('#' . $hashtag->text . " ", '<a href="http://twitter.com/search?q=%23' . $hashtag->text . '">#' . $hashtag->text . '</a> ', $text);
                    }
                }
            }
            $t[$i]["screen_name"] = '<a class="tweetHover" target="_blank" href="http://twitter.com/@' . $tweet->user->screen_name . '">@' . $tweet->user->screen_name . '</a>';
            $t[$i]["user_name"] = $tweet->user->name;
            $t[$i]["id"] = $tweet->id_str;
            $t[$i]["user_image"] = $tweet->user->profile_image_url;
            $t[$i]["tweet"] = trim($this->changeLink($text, $this->getTagPref(), $this->getNoFollow(), $this->getNewWindow()));
            $t[$i]["time"] = $tweet->created_at;
            $t[$i]["url"] = $tweet->entities->media[0]->media_url;
            $t[$i]["like"] = $tweet->favorite_count;
            $i++;
        }
        return $t;
    }

    public function getLatestTweets() {
        require_once('twitteroauth/twitteroauth.php');

        $screenName = $this->getTwitterId();
        $not = $this->getNumberOfTweets();
        $keys = $this->getKeys();
        $consumerkey = $keys['consumerkey'];
        $consumersecret = $keys['consumersecret'];
        $accesstoken = $keys['accesstoken'];
        $accesstokensecret = $keys['accesstokensecret'];
        if (!$screenName) {
            return false;
        }

        $twitterconn = new TwitterOAuth($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
        $latesttweets = $twitterconn->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=" . $screenName . "&count=" . $not);

//        echo '<pre>';
//        print_r($latesttweets);
//        exit;
        
        if (!$latesttweets->errors) {
            return($this->getTweets($latesttweets));
        }
    }

}
