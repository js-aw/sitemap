<?php

namespace Sitemap\Xml\Node;
/**
 * Gibt die URL an. Bei Bildern und Videos gibt dieses Tag die Zielseite 
 * (Wiedergabeseite, Verweisseite) an. 
 * Die URL muss eindeutig sein.
 *
 * @required Erforderlich
 * @author Andy Weichler <andy.weichler@googlemail.com>
 */
class Loc extends \Sitemap\Xml\Node {

	public static function getTagName() {
		return 'loc';
	}

}

?>
