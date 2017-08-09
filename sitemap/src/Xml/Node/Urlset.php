<?php

namespace Sitemap\Xml\Node;

/**
 * Beinhaltet alle Informationen über die in der XML-Sitemap enthaltene 
 * Gruppe von URLs.
 *
 * @required Erforderlich
 * @author Andy Weichler <andy.weichler@googlemail.com>
 */
class Urlset extends \Sitemap\Xml\Node {

	public static function getTagName() {
		return 'urlset';
	}

	public static function getNameSpace() {
		return '';
	}

	public static function getNameSpaceUrl() {
		return 'http://www.sitemaps.org/schemas/sitemap/0.9';
	}

	/**
	 * 
	 * @param \Sitemap\Xml\Node\Url|string $url
	 * @return \Sitemap\Xml\Node\Url
	 * @throws Exception
	 */
	public function addUrl($url) {
		if ($url instanceof \Sitemap\Xml\Node\Url) {
			
		} elseif (is_string($url)) {
			$url = new \Sitemap\Xml\Node\Url($url);
		} else {
			throw new Exception('Fehler. Es wurde ein falscher Typ übergeben.');
		}
		$this->addChildNode($url);
		return $url;
	}

}

?>
