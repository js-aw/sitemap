<?php

namespace Sitemap\Xml;

/**
 * 
 * @version	1.0
 * @copyright Copyright (c) 09.08.2017, werbeagentur aufwind GmbH
 * @author Andy Weichler <andy.weichler@aufwind-group.de>
 */
class Sitemap {

    protected $_url_set;
    protected $_file_name;

    public function __construct() {
        $this->setUrlSet(new \Sitemap\Xml\Node\Urlset());
    }

    /**
     *
     * @return \Sitemap\Xml\Node\Urlset
     */
    public function getUrlSet() {
        return $this->_url_set;
    }

    /**
     *
     * @param \Sitemap\Xml\Node\Urlset $url_set
     * @return Sitemap_Xml_Sitemap
     */
    public function setUrlSet(\Sitemap\Xml\Node\Urlset $url_set) {
        $this->_url_set = $url_set;
        return $this;
    }

    /**
     *
     * @param \Sitemap\Xml\Node\Url|string $url
     * @return \Sitemap\Xml\Node\Url
     */
    public function addUrl($url) {
        return $this->getUrlSet()->addUrl($url);
    }

    public function __toString() {
        return (string) $this->getUrlSet()->render();
    }

    /**
     *
     * @return string
     */
    public function getFileName() {
        return $this->_file_name;
    }

    /**
     *
     * @param string $file_name
     * @return \Sitemap_Xml_Sitemap
     */
    public function setFileName($file_name) {
        $this->_file_name = $file_name;
        return $this;
    }

}
