<?php

namespace Sitemap\Xml;

/**
 * 
 * @version	1.0
 * @copyright Copyright (c) 09.08.2017, werbeagentur aufwind GmbH
 * @author Andy Weichler <andy.weichler@aufwind-group.de>
 */
abstract class Node {

    /**
     *
     * @var array
     */
    protected $_namespaces;

    /**
     *
     * @var array<\Sitemap\Xml\Node>
     */
    protected $_child_nodes;

    /**
     *
     * @var string
     */
    protected $_value;

    /**
     *
     * @var \Sitemap\Xml\Node
     */
    protected $_parent;

    /**
     * return string
     */
    public static function getTagName() {
        throw new Exception('Die Funktion ' . __METHOD__ . ' in der Klasse ' . get_called_class() . ' sollte überschrieben werden.');
    }

    /**
     * 
     * @return array
     */
    public static function getAllowedTags() {
        return array();
    }

    public static function getUniqueTags() {
        return array();
    }

    public static function getNameSpace() {
        return null;
    }

    public static function getNameSpaceUrl() {
        return null;
    }

    /**
     * 
     * @param \Sitemap\Xml\Node|string $loc
     */
    public function __construct($value = null) {
        if ($value instanceof \Sitemap\Xml\Node) {
            $this->addChildNode($value);
        } elseif (is_string($value)) {
            $this->setValue($value);
        }
    }

    /**
     * 
     * @return \Sitemap\Xml\Node|null
     */
    public function getParent() {
        return $this->_parent;
    }

    /**
     * 
     * @param \Sitemap\Xml\Node $parent
     * @return \Sitemap\Xml\Node
     */
    public function setParent(\Sitemap\Xml\Node $parent) {
        $this->_parent = $parent;
        return $this;
    }

    /**
     * 
     * @return array
     */
    public function getNamespaces() {
        if ($this->_namespaces === null) {
            $this->_namespaces = array();
        }
        return $this->_namespaces;
    }

    /**
     * 
     * @return boolean
     */
    public function hasNamespaces() {
        return count($this->getNamespaces()) > 0;
    }

    /**
     * 
     * @param array $namespaces
     * @return \Sitemap\Xml\Node
     * @throws Exception
     */
    public function setNamespaces($namespaces) {
        if (!is_array($namespaces)) {
            throw new Exception('Fehler. Es muss ein Array mit Zeichenketten übergeben werden.');
        }
        $this->_namespaces = $namespaces;
        return $this;
    }

    /**
     * 
     * @param string $namespace
     * @return \Sitemap\Xml\Node
     */
    public function addNamespace($namespace) {
        $this->getNamespaces();
        $this->_namespaces[] = $namespace;
        return $this;
    }

    /**
     * 
     * @param string $i_sNamespace
     * @return boolean
     */
    public function hasNamespace($i_sNamespace) {
        foreach ($this->getNamespaces() AS $namespace) {
            if ($namespace == $i_sNamespace) {
                return true;
            }
        }
        return false;
    }

    /**
     * 
     * @return array<\Sitemap\Xml\Node>
     */
    public function getChildNodes() {
        if ($this->_child_nodes === null) {
            $this->_child_nodes = array();
        }
        return $this->_child_nodes;
    }

    /**
     * 
     * @param \Sitemap\Xml\Node $child_nodes
     * @throws Exception
     * @return array<\Sitemap\Xml\Node>
     */
    public function setChildNodes($child_nodes) {
        foreach ((array) $child_nodes AS $node) {
            if (!$node instanceof \Sitemap\Xml\Node) {
                throw new Exception('In dem übergebenen Array ist ein Knoten '
                . 'enhalten, welcher keine Instanz von \Sitemap\Xml\Node ist.');
            }
            $this->addChildNode($node);
        }
        return $this;
    }

    /**
     * 
     * @return boolean
     */
    public function hasChildNodes() {
        return count($this->getChildNodes()) > 0;
    }

//
//	/**
//	 * 
//	 * @param \Sitemap\Xml\Node $node
//	 * @return boolean
//	 */
//	public function hasChildNode(\Sitemap\Xml\Node $node) {
//		foreach ($this->getChildNodes() as $Child) {
//			if ($Child == $node) {
//				return true;
//			}
//		}
//		return false;
//	}
//
//	/**
//	 * 
//	 * @param \Sitemap\Xml\Node $node
//	 * @return boolean
//	 */
//	public function hasChildNodeOfClass($classname) {
//		$classname = strtolower($classname);
//		foreach ($this->getChildNodes() as $Child) {
//			if (strtolower(get_class($Child)) == $classname) {
//				return true;
//			}
//		}
//		return false;
//	}

    /**
     * 
     * @param \Sitemap\Xml\Node $node
     * @throws Exception
     * @return \Sitemap\Xml\Node
     */
    public function addChildNode(\Sitemap\Xml\Node $node) {
        if (count(static::getAllowedTags()) > 0) {
            $class = get_class($node);
            $tag_name = $class::getTagName();
            if (array_search($tag_name, static::getAllowedTags()) === false) {
                throw new Exception('Das Hinzufügen des Tags ' . $tag_name . ' zu einem Knoten vom Typ ' . static::getTagName() . ' ist nicht erlaubt.');
            }
        }
        $node->setParent($this);
        $this->getChildNodes();
        $class = get_class($node);
        $tag_name = $class::getTagName();
        $unique = array_search($tag_name, static::getUniqueTags());
        if (is_string($unique) || is_numeric($unique)) {
            $this->_child_nodes[$unique] = $node;
        } else {
            $unique_tag_count = count(static::getUniqueTags());
            $index = $unique_tag_count + 1;
            $max = $this->hasChildNodes() ? max(array_keys($this->getChildNodes())) : $index;
            if ($max > $unique_tag_count) {
                $index = $max + 1;
            }
            $this->_child_nodes[$index] = $node;
        }
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getValue() {
        return $this->_value;
    }

    /**
     * 
     * @param string $value
     * @return \Sitemap\Xml\Node
     */
    public function setValue($value) {
        $this->_value = $value;
        return $this;
    }

    public function toArray() {
        $xml = array();
        try {
            $xml[] = '<' . static::getTagName() . ($this->hasNamespaces() ? ' ' . implode("\n", $this->getNamespaces()) : '') . '>';
            if ($this->getValue()) {
                $xml[] = $this->getValue();
            }
            foreach ($this->getChildNodes() as $Node) {
                $xml[] = (string) $Node;
            }
            $xml[] = '</' . static::getTagName() . '>';
        } catch (Exception $e) {
            $xml[] = '<error>';
            $xml[] = '<class>';
            $xml[] = get_called_class();
            $xml[] = '</class>';
            $xml[] = '<message>';
            $xml[] = $e->getMessage();
            $xml[] = '</message>';
            $xml[] = '<line>';
            $xml[] = $e->getLine();
            $xml[] = '</line>';
            $xml[] = '</error>';
        }
        return $xml;
    }

    public function toXml() {
        $xml = $this->toArray();
        return trim(count($xml) > 0 ? implode("\n", $xml) : '');
    }

    public function render(&$i_rRoot = null, $i_iLevel = 0) {
        if ($i_rRoot === null) {
            $i_rRoot = $this;
        }

//        $ns = static::getNameSpace();
//        $nsUrl = static::getNameSpaceUrl();
//        $namespace = 'xmlns';
//        if (!empty($ns)) {
//            $namespace .= ':' . $ns;
//        }
//        $namespace .= '="' . $nsUrl . '"';
//        if (!empty($ns) && !empty($nsUrl)) {
//            if (!$i_rRoot->hasNamespace($namespace)) {
//                $i_rRoot->addNamespace($namespace);
//            }
//        }

        if (static::getNameSpaceUrl() !== null) {
            $namespace = 'xmlns' . (strlen(static::getNameSpace()) > 0 ? ':' .
                static::getNameSpace() : '') . '="' . static::getNameSpaceUrl() . '"';
            if (!$i_rRoot->hasNamespace($namespace)) {
                $i_rRoot->addNamespace($namespace);
            }
        }
        $xml = array();
        try {
            if ($this->getValue()) {
                $xml[] = htmlspecialchars($this->getValue(), ENT_QUOTES, 'UTF-8');
            }
            foreach ($this->getChildNodes() as $Node) {
                $xml[] = (string) $Node->render($i_rRoot, $i_iLevel + 1);
            }
            $tag_name = (static::getNameSpace() ? static::getNameSpace() . ':' : '') . static::getTagName();
            $open_tag = '<' . $tag_name . ($this->hasNamespaces() ? ' ' . implode("\n", $this->getNamespaces()) : '') . '>';
            $close_tag = '</' . $tag_name . '>';
            array_unshift($xml, $open_tag);
            array_push($xml, $close_tag);
        } catch (Exception $e) {
            $xml[] = '<error>';
            $xml[] = '<class>';
            $xml[] = get_called_class();
            $xml[] = '</class>';
            $xml[] = '<message>';
            $xml[] = $e->getMessage();
            $xml[] = '</message>';
            $xml[] = '<line>';
            $xml[] = $e->getLine();
            $xml[] = '</line>';
            $xml[] = '</error>';
        }
        return count($xml) > 0 ? implode("\n", $xml) : '';
    }

    public function __toString() {
        $dom = new DomDocument();
        $dom->loadXML($this->render());
        $dom->formatOutput = true;
        $dom->encoding = 'utf-8';
        return $dom->saveXML();
//		return $this->render();
    }

}
