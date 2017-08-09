<?php

namespace Sitemap;

/**
 * 
 * @version	1.0
 * @copyright Copyright (c) 08.08.2017, werbeagentur aufwind GmbH
 * @author Andy Weichler <andy.weichler@aufwind-group.de>
 */
class Xml {

    /**
     *
     * @var array
     */
    protected static $_name_spaces;

    /**
     *
     * @param string $ns
     */
    public static function addNameSpace($ns) {
        static::getNameSpaces();
        static::$_name_spaces[] = $ns;
    }

    /**
     *
     * @return array
     */
    public static function getNameSpaces() {
        if (static::$_name_spaces === null) {
            static::$_name_spaces = static::getDefaultNameSpaces();
        }
        return static::$_name_spaces;
    }

    /**
     *
     * @param array $namespaces
     * @throws Exception
     */
    public static function setNameSpaces($namespaces) {
        if (!is_array($namespaces)) {
            throw new Exception('Es wurde kein Array übergeben.');
        }
        static::$_name_spaces = $namespaces;
    }

    /**
     *
     * @return array
     */
    public static function getDefaultNameSpaces() {
        return array(
            '',
            'image',
            'video'
        );
    }

    /**
     *
     * @return Sitemap_Xml_Sitemap
     */
    public static function createSitemap() {
        static::loadClass('Sitemap\\Xml\\Sitemap');
        $sitemap = new Sitemap_Xml_Sitemap();
        return $sitemap;
    }

    /**
     *
     * @return Sitemap_Xml_Sitemap_Index
     */
    public static function createSitemapIndex() {
        static::loadClass('Sitemap\\Xml\\Sitemapindex');
        $index = new Sitemap_Xml_Sitemap_Index();
        return $index;
    }

    public static function fromFile($file) {
        $dom_xml = simplexml_load_file($file);
        if ($dom_xml === false) {
            return false;
        }
        return static::createObject($dom_xml);
    }

    protected static function createObject(SimpleXMLElement $element, $sitemap = null, $ns = false) {
        $tag_name = $element->getName();
//		var_dump($tag_name);
        if (strlen($ns) > 0) {
            $tag_name = ucfirst($ns) . '_' . ucfirst($tag_name);
//			var_dump($tag_name);
        }
        static::loadClass(static::getClassFromTagName($tag_name));
        $class = static::getClassFromTagName($tag_name);
        if ($sitemap === null) {
            $sitemap = new $class();
        } else {
            $node = null;

            $text_node = false;
            foreach (static::getNameSpaces() AS $ns) {
                if (count($element->children($ns)) > 0) {
                    $node = new $class();
                    break;
                }
                $text_node = true;
            }
            if ($text_node) {
                $text = trim((string) $element);

                if (strlen($text) > 0) {
                    $node = new $class($text);
                } else {
                    $node = new $class();
                }
            }
            $sitemap->addChildNode($node);
            $sitemap = $node;
        }
        foreach (static::getNameSpaces() AS $ns) {
            foreach ($element->children($ns, true) as $child) {
//				var_dump($child->getName());
                static::createObject($child, $sitemap, $ns);
            }
        }
        return $sitemap;
    }

    protected static function getClassFromTagName($tag_name) {
        $class = '\Sitemap\Xml\Node';
        $arr = explode('_', $tag_name);
        foreach ($arr as $v) {
            $class .= '_' . ucfirst($v);
        }
        return $class;
    }

    protected static function getFileNameFromClass($class) {
        return str_replace('_', '/', $class) . '.php';
    }

    /**
     *
     * @param string $class
     * @return boolean
     */
    protected static function loadClass($class) {
        $file = static::getFileNameFromClass($class);
        foreach (static::getIncludePaths() AS $path) {
            $tmp = $path . DIRECTORY_SEPARATOR . $file;
            if (file_exists($tmp)) {
                require_once $tmp;
                return true;
            }
        }

        return false;
    }

    /**
     *
     * @return array
     */
    protected static function getIncludePaths() {
        return explode(PATH_SEPARATOR, get_include_path());
    }

    public static function fromJson($json_str) {
        $json_str = json_decode($json_str, true);
        if (!$json_str) {
            throw new Exception('JSON String konnte nicht decodiert werden.');
        }
        foreach ($json_str as $value) {
            if (!isset($value['type'])) {
                continue;
            }
            $tag_name = $value['type'];
            static::loadClass(static::getClassFromTagName($tag_name));
        }
    }

    /**
     *
     * @throws Exception
     */
    public static function sendHeader() {
        if (headers_sent()) {
            throw new Exception('Kann Header nicht setzten, da schon Ausgaben getätigt wurden.');
        }
        header("Content-Type:text/xml");
    }

    /**
     *
     * @param \Sitemap\Xml\Node $node
     */
    public static function output($node) {
        static::sendHeader();
        echo $node;
    }

    /**
     *
     * @param \Sitemap\Xml\Node $node
     * @param string $file Pfad + Dateiname als Zeichenkette
     * @return boolean True wenn es funktioniert hat, sonst False
     */
    public static function toFile($node, $file, $remove_if_exists = true) {
        if ($remove_if_exists) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
        if (file_put_contents($file, (string) $node) !== false) {
            return true;
        }
        return false;
    }

    public static function test($file) {
        $node = new SimpleXMLElement($file, 0, true);
//		$node->registerXPathNamespace('image:image', 'http://www.google.com/schemas/sitemap-image/1.1');
//		$node->registerXPathNamespace('video', 'http://www.google.com/schemas/sitemap-video/1.1');
//		var_dump($node->xpath('//image:*'));
        static::ch($node);
    }

    public static function ch($node) {
//		var_dump($node);
//		var_dump($node->getName());
        $node instanceof SimpleXMLElement;
//		$node->
        if ($node->getName() == 'url') {
            
        }
        foreach ($node->children('') AS $child) {
            static::ch($child);
        }
        foreach ($node->children('image', true) AS $child) {
            static::ch($child);
        }
        foreach ($node->children('video', true) AS $child) {
            static::ch($child);
        }
    }

}
