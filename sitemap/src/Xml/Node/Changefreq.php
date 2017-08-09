<?php

namespace Sitemap\Xml\Node;
/**
 * Bietet einen Hinweis darauf, wie oft die Seite wahrscheinlich 
 * geändert werden wird. 
 * Gültige Werte sind:
 * 
 * always (Verwenden Sie diesen Wert für Seiten, die bei jedem Zugriff geändert werden.)
 * hourly (stündlich)
 * daily (täglich)
 * weekly (wöchentlich)
 * monthly (monatlich)
 * yearly (jährlich)
 * never (nie). 
 * 
 * Verwenden Sie diesen Wert für archivierte URLs.
 *
 * 
 * @author Andy Weichler <andy.weichler@googlemail.com>
 * @required Optional
 * @see https://support.google.com/webmasters/answer/183668
 */
class Changefreq extends \Sitemap\Xml\Node {

	/**
	 * Verwenden Sie diesen Wert für Seiten, die bei jedem Zugriff geändert werden.
	 */
	const ALWAYS = 'always';

	/**
	 * stündlich
	 */
	const HOURLY = 'hourly';

	/**
	 * täglich
	 */
	const DAILY = 'daily';

	/**
	 * wöchentlich
	 */
	const WEEKLY = 'weekly';

	/**
	 * jährlich
	 */
	const YEARLY = 'yearly';

	/**
	 * nie
	 */
	const NEVER = 'never';

	public static function getTagName() {
		return 'changefreq';
	}
}

?>
