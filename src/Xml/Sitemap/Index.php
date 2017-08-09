<?php

namespace Sitemap\Xml\Sitemap;

/**
 * 
 * @version	1.0
 * @copyright Copyright (c) 09.08.2017, werbeagentur aufwind GmbH
 * @author Andy Weichler <andy.weichler@aufwind-group.de>
 */
class Index {

    /**
     *
     * @var \Sitemap\Xml\Node\Sitemapindex
     */
    protected $_sitemap_index;
    protected $_file_name;

    public function __construct() {
        $this->setSitemapIndex(new \Sitemap\Xml\Node\Sitemapindex());
    }

    /**
     *
     * @return \Sitemap\Xml\Node\Sitemapindex
     */
    public function getSitemapIndex() {
        return $this->_sitemap_index;
    }

    /**
     *
     * @param \Sitemap\Xml\Node\Sitemapindex $sitemap_index
     * @return Sitemap_Xml_Sitemap_Index
     */
    public function setSitemapIndex(\Sitemap\Xml\Node\Sitemapindex $sitemap_index) {
        $this->_sitemap_index = $sitemap_index;
        return $this;
    }

    /**
     *
     * @param \Sitemap\Xml\Node\Sitemap|string $sitemap
     * @return Sitemap_Xml_Sitemap_Index
     */
    public function addSitemap($sitemap) {
        $this->getSitemapIndex()->addSitemap($sitemap);
        return $this;
    }

    public function findSitemap($sitemap) {
        foreach ($this->getSitemapIndex()->getChildNodes() As $child) {
            $child instanceof \Sitemap\Xml\Node\Sitemap;
            $nodes = $child->getChildNodes();
            $loc = reset($nodes);
            if (!$loc) {
                continue;
            }
            if ($sitemap == $loc->getValue()) {
                return true;
            }
        }
        return false;
    }

    public function __toString() {
        return (string) $this->getSitemapIndex()->render();
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
     * @return \Sitemap_Xml_Sitemap_Index
     */
    public function setFileName($file_name) {
        $this->_file_name = $file_name;
        return $this;
    }

}
