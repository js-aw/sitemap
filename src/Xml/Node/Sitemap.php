<?php

namespace Sitemap\Xml\Node;
/**
 * Description of \Sitemap\Xml\Node\Sitemap
 *
 * @author Andy Weichler <andy.weichler@googlemail.com>
 */
class Sitemap extends \Sitemap\Xml\Node {

	public function __construct($value = null) {
		if (is_string($value)) {
			$value = new \Sitemap\Xml\Node\Loc($value);
		}
		parent::__construct($value);
	}

	public static function getTagName() {
		return 'sitemap';
	}

	public static function getAllowedTags() {
		return array(
			\Sitemap\Xml\Node\Loc::getTagName(),
			\Sitemap\Xml\Node\Lastmod::getTagName()
		);
	}

}

?>
