<?php

namespace Sitemap\Xml\Node;
/**
 * Beschreibt die Priorität einer URL im Verhältnis zu allen anderen URLs 
 * auf der Website. Diese Priorität kann von 1.0 (sehr wichtig) 
 * bis 0.1 (unwichtig) reichen. 
 * 
 * Dieser Wert wirkt sich nicht auf das Ranking Ihrer Website in den 
 * Google-Suchergebnissen aus. Da dieser Wert nur im Verhältnis zu den 
 * anderen Seiten Ihrer Website gilt, verbessern Sie das Ranking Ihrer 
 * Website in den Suchergebnissen nicht, indem Sie bestimmten URLs eine 
 * hohe Priorität zuweisen. Auch die Zuweisung derselben Priorität für 
 * alle Seiten hat keine Auswirkungen.
 *
 * @required Optional
 * @author Andy Weichler <andy.weichler@googlemail.com>
 */
class Priority extends \Sitemap\Xml\Node {

	public static function getTagName() {
		return 'priority';
	}

}

?>
