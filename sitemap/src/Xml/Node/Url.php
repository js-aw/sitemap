<?php

namespace Sitemap\Xml\Node;

/**
 * Beinhaltet alle Informationen über eine bestimmte URL.
 *
 * @required Erforderlich
 * @author Andy Weichler <andy.weichler@googlemail.com>
 */
class Url extends \Sitemap\Xml\Node {

	/**
	 *
	 * @var \Sitemap\Xml\Node\Loc
	 */
	protected $_loc;

	/**
	 *
	 * @var \Sitemap\Xml\Node\Changefreq
	 */
	protected $_changefreq;

	/**
	 *
	 * @var \Sitemap\Xml\Node\Lastmod
	 */
	protected $_lastmod;

	/**
	 *
	 * @var \Sitemap\Xml\Node\Priority
	 */
	protected $_priority;

	public function __construct($value = null) {
		if (is_string($value)) {
			$value = new \Sitemap\Xml\Node\Loc($value);
			$this->setLoc($value);
		}
		parent::__construct($value);
	}

	public static function getAllowedTags() {
		return array(
			\Sitemap\Xml\Node\Loc::getTagName(),
			\Sitemap\Xml\Node\Lastmod::getTagName(),
			\Sitemap\Xml\Node\Priority::getTagName(),
			\Sitemap\Xml\Node\Changefreq::getTagName(),
			\Sitemap\Xml\Node\Image_Image::getTagName(),
			\Sitemap\Xml\Node\Video_Video::getTagName(),
		);
	}

	public static function getUniqueTags() {
		return array(
			\Sitemap\Xml\Node\Loc::getTagName(),
			\Sitemap\Xml\Node\Lastmod::getTagName(),
			\Sitemap\Xml\Node\Priority::getTagName(),
			\Sitemap\Xml\Node\Changefreq::getTagName(),
		);
	}

	public static function getTagName() {
		return 'url';
	}

//
//	/**
//	 * 
//	 * @return \Sitemap\Xml\Node\Loc
//	 */
//	public function getLoc() {
//		return $this->_loc;
//	}
//
//	/**
//	 * 
//	 * @return \Sitemap\Xml\Node\Changefreq
//	 */
//	public function getChangefreq() {
//		return $this->_changefreq;
//	}
//
//	/**
//	 * 
//	 * @return \Sitemap\Xml\Node\Lastmod
//	 */
//	public function getLastmod() {
//		return $this->_lastmod;
//	}
//
//	/**
//	 * 
//	 * @return \Sitemap\Xml\Node\Priority
//	 */
//	public function getPriority() {
//		return $this->_priority;
//	}

	/**
	 * 
	 * @param \Sitemap\Xml\Node\Loc|string $loc
	 * @return \Sitemap\Xml\Node\Url
	 */
	public function setLoc($loc) {
		if ($loc instanceof \Sitemap\Xml\Node\Loc) {
			
		} elseif (is_string($loc)) {
			$loc = new \Sitemap\Xml\Node\Loc($loc);
		} else {
			throw new Exception('Fehler. Falscher Typ übergeben.');
		}
		$this->_loc = $loc;
		$this->addChildNode($loc);
		return $this;
	}

	/**
	 * 
	 * @param \Sitemap\Xml\Node\Changefreq|string $changefreq
	 * @return \Sitemap\Xml\Node\Url
	 */
	public function setChangefreq($changefreq) {
		if ($changefreq instanceof \Sitemap\Xml\Node\Changefreq) {
			
		} elseif (is_string($changefreq)) {
			$changefreq = new \Sitemap\Xml\Node\Changefreq($changefreq);
		} else {
			throw new Exception('Fehler. Falscher Typ übergeben.');
		}
		$this->_changefreq = $changefreq;
		$this->addChildNode($changefreq);
		return $this;
	}

	/**
	 * 
	 * @param \Sitemap\Xml\Node\Lastmod|string $lastmod
	 * @return \Sitemap\Xml\Node\Url
	 */
	public function setLastmod($lastmod) {
		if ($lastmod instanceof \Sitemap\Xml\Node\Lastmod) {
			
		} elseif (is_string($lastmod)) {
			$lastmod = new \Sitemap\Xml\Node\Lastmod($lastmod);
		} else {
			throw new Exception('Fehler. Falscher Typ übergeben.');
		}
		$this->_lastmod = $lastmod;
		$this->addChildNode($lastmod);
		return $this;
	}

	/**
	 * 
	 * @param \Sitemap\Xml\Node\Priority|string $priority
	 * @return \Sitemap\Xml\Node\Url
	 */
	public function setPriority($priority) {
		if ($priority instanceof \Sitemap\Xml\Node\Priority) {
			
		} elseif (is_string($priority)) {
			$priority = new \Sitemap\Xml\Node\Priority($priority);
		} else {
			throw new Exception('Fehler. Falscher Typ übergeben.');
		}
		$this->_priority = $priority;
		$this->addChildNode($priority);
		return $this;
	}

	/**
	 * 
	 * @param \Sitemap\Xml\Node\Image_Image|string $image
	 * @return \Sitemap\Xml\Node\Image_Image
	 */
	public function addImage($image, $title = false) {
		if ($image instanceof \Sitemap\Xml\Node\Image_Image) {
			
		} elseif (is_string($image) && strlen($image) > 0) {
			$image = new \Sitemap\Xml\Node\Image_Image($image);
		}
		if (is_string($title) && strlen($title) > 0) {
			$image->addChildNode(new \Sitemap\Xml\Node\Image_Title($title));
		}
		$this->addChildNode($image);
		return $image;
	}

	/**
	 * 
	 * @param \Sitemap\Xml\Node\Video_Video|string $video
	 * @param string $title
	 * @param string $decription
	 * @param string $thumbnail_url
	 * @return \Sitemap\Xml\Node\Video_Video
	 */
	public function addVideo($video, $title, $decription, $thumbnail_url) {
		if ($video instanceof \Sitemap\Xml\Node\Video_Video) {
			
		} elseif (is_string($video) && strlen($video) > 0) {
			$video = new \Sitemap\Xml\Node\Video_Video($video);
		}
		if (is_string($title) && strlen($title) > 0) {
			$video->addChildNode(new \Sitemap\Xml\Node\Video_Title($title));
		}
		if (is_string($decription) && strlen($decription) > 0) {
			$video->addChildNode(new \Sitemap\Xml\Node\Video_Description($decription));
		}
		if (is_string($thumbnail_url) && strlen($thumbnail_url) > 0) {
			$video->addChildNode(new \Sitemap\Xml\Node\Video_Thumbnail_Loc($thumbnail_url));
		}
		$this->addChildNode($video);
		return $video;
	}

}

?>
