<?php

namespace Sitemap\Xml\Node;
/**
 * Datum, an dem die URL zuletzt geändert wurde, im Format JJJJ-MM-TTTss:mmZZZ. 
 * Der Zeitwert ist optional.
 * @author Andy Weichler <andy.weichler@googlemail.com>
 * @required Optional
 */
class Lastmod extends \Sitemap\Xml\Node {

	const DATE_FORMAT = 'JJJJ-MM-TTTss:mmZZZ';

	public static function getTagName() {
		return 'lastmod';
	}

}

?>
