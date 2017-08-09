<?php

namespace Sitemap\Xml\Node;
/**
 * Description of \Sitemap\Xml\Node\Sitemapindex
 *
 * @author Andy Weichler <andy.weichler@googlemail.com>
 */
class Sitemapindex extends \Sitemap\Xml\Node {

	public static function getTagName() {
		return 'sitemapindex';
	}

	public static function getAllowedTags() {
		return array(
			\Sitemap\Xml\Node\Sitemap::getTagName()
		);
	}

	public static function getNameSpace() {
		return '';
	}

	public static function getNameSpaceUrl() {
		return 'http://www.sitemaps.org/schemas/sitemap/0.9';
	}

	/**
	 * 
	 * @param \Sitemap\Xml\Node\Sitemap|string $sitemap
	 * @return \Sitemap\Xml\Node\Sitemapindex
	 */
	public function addSitemap($sitemap) {
		if ($sitemap instanceof \Sitemap\Xml\Node\Sitemap) {
			
		} elseif (is_string($sitemap)) {
			$sitemap = new \Sitemap\Xml\Node\Sitemap($sitemap);
		}
		$this->addChildNode($sitemap);
		return $this;
	}

}

?>