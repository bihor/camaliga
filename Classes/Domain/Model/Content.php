<?php
namespace Quizpalme\Camaliga\Domain\Model;

use TYPO3\CMS\Extbase\Annotation as Extbase;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Kurt Gusbeth <info@Quizpalme.de>
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Content Model: die Schublade der Extension
 *
 * @package camaliga
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Content extends \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject {
	
	/**
	 * Title
	 * @Extbase\Validate("NotEmpty")
	 * @var string
	 */
	protected $title;

	/**
	 * Short description
	 *
	 * @var string
	 */
	protected $shortdesc;

	/**
	 * Long description
	 *
	 * @var string
	 */
	protected $longdesc;

	/**
	 * Link to a page
	 *
	 * @var string
	 */
	protected $link;

	/**
	 * Image
	 *
	 * @var string
	 */
	protected $image;

	/**
	 * Image 2
	 *
	 * @var string
	 */
	protected $image2;

	/**
	 * Caption 2
	 *
	 * @var string
	 */
	protected $caption2;
	
	/**
	 * Image 3
	 *
	 * @var string
	 */
	protected $image3;

	/**
	 * Caption 3
	 *
	 * @var string
	 */
	protected $caption3;

	/**
	 * Image 4
	 *
	 * @var string
	 */
	protected $image4;

	/**
	 * Caption 4
	 *
	 * @var string
	 */
	protected $caption4;

	/**
	 * Image 5
	 *
	 * @var string
	 */
	protected $image5;

	/**
	 * Caption 5
	 *
	 * @var string
	 */
	protected $caption5;

	/**
	 * Image
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 * @cascade remove
	 */
	protected $falimage = null;

	/**
	 * Image
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 * @cascade remove
	 */
	protected $falimage2 = null;

	/**
	 * Image
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 * @cascade remove
	 */
	protected $falimage3 = null;

	/**
	 * Image
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 * @cascade remove
	 */
	protected $falimage4 = null;

	/**
	 * Image
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 * @cascade remove
	 */
	protected $falimage5 = null;
	
	/**
	 * Street
	 *
	 * @var string
	 */
	protected $street;
	
	/**
	 * Zip code
	 *
	 * @var string
	 */
	protected $zip;
	
	/**
	 * City
	 *
	 * @var string
	 */
	protected $city;
	
	/**
	 * Country
	 *
	 * @var string
	 */
	protected $country;

	/**
	 * Person number
	 *
	 * @var string
	 */
	protected $person;
	
	/**
	 * Phone number
	 *
	 * @var string
	 */
	protected $phone;
	
	/**
	 * Mobile number
	 *
	 * @var string
	 */
	protected $mobile;
	
	/**
	 * E-Mail
	 *
	 * @var string
	 */
	protected $email;
	
	/**
	 * Latitude
	 *
	 * @var float
	 */
	protected $latitude;

	/**
	 * Longitude
	 *
	 * @var float
	 */
	protected $longitude;

	/**
	 * Distance bei Umkreissuche
	 *
	 * @var float
	 */
	protected $distance = 0.0;
	
	/**
	 * Custom variable 1
	 *
	 * @var string
	 */
	protected $custom1;

	/**
	 * Custom variable 2
	 *
	 * @var string
	 */
	protected $custom2;

	/**
	 * Custom variable 3
	 *
	 * @var string
	 */
	protected $custom3;

	/**
	 * Mutter-Element: Quizpalme\Camaliga\Domain\Model\Content. Früher integer
	 *
	 * @var \Quizpalme\Camaliga\Domain\Model\Content
     * @lazy
	 */
	protected $mother;
	
	/**
	 * Categories. Früher: integer
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category>
	 */
	protected $categories;

	/**
	 * Modulo begin
	 *
	 * @var integer
	 */
	protected $moduloBegin = 0;

	/**
	 * Modulo end
	 *
	 * @var integer
	 */
	protected $moduloEnd = 0;
	

	/**
	 * __construct
	 */
	public function __construct()
	{
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}
	
	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects()
	{
	
	}

	/**
	 * Gets the title nl2br
	 *
	 * @return string $title
	 */
	public function getTitleNl2br() {
		$title = str_replace(array("'"), "\'", $this->title);
		return str_replace(array("\r\n", "\r", "\n"), "<br />", $title);
	}
	
	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}
	
	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Gets the shortdesc nl2br
	 *
	 * @return string $shortdesc
	 */
	public function getShortdescNl2br() {
		$shortdesc = str_replace(array("'"), "\'", $this->shortdesc);
		return str_replace(array("\r\n", "\r", "\n"), "<br />", $shortdesc);
	}

	/**
	 * Returns the shortdesc
	 *
	 * @return string $shortdesc
	 */
	public function getShortdesc() {
		return $this->shortdesc;
	}

	/**
	 * Sets the shortdesc
	 *
	 * @param string $shortdesc
	 * @return void
	 */
	public function setShortdesc($shortdesc) {
		$this->shortdesc = $shortdesc;
	}

	/**
	 * Gets the longdesc nl2br
	 *
	 * @return string $longdesc
	 */
	public function getLongdescNl2br() {
		$longdesc = str_replace(array("'"), "\'", $this->longdesc);
		return str_replace(array("\r\n", "\r", "\n"), "<br />", $longdesc);
	}

	/**
	 * Returns the longdesc
	 *
	 * @return string $longdesc
	 */
	public function getLongdesc() {
		return $this->longdesc;
	}

	/**
	 * Sets the longdesc
	 *
	 * @param string $longdesc
	 * @return void
	 */
	public function setLongdesc($longdesc) {
		$this->longdesc = $longdesc;
	}

	/**
	 * Returns the resolved link
	 *
	 * @return string $link
	 */
	public function getLinkResolved() {
		$output = '';
		$link = $this->link;
		$linkArray = explode(':', $link);
		if ($linkArray[0] == 'file') {
			$uid = intval($linkArray[1]); // content element uid
			$res4 = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
					'identifier, storage',
					'sys_file',
					'uid=' . $uid);
			if ($GLOBALS['TYPO3_DB']->sql_num_rows($res4) > 0) {
				while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res4))
					$output = ($row['storage'] == 1) ? '/fileadmin' . $row['identifier'] : $row['identifier'];
			}
			$GLOBALS['TYPO3_DB']->sql_free_result($res4);
		}
		return $output;
	}

	/**
	 * Returns all link
	 *
	 * @return array $links
	 */
	public function getLinks() {
		$links_tmp = explode(' ', $this->link);
		$links = array();
		$i = 0;
		foreach ($links_tmp as $link) {
			$links[$i] = array();
			$links[$i]['link'] = $link;
			if ((substr(trim($link), 0, 3) == 'www') || (substr(trim($link), 0, 4) == 'http')) {
				$links[$i]['type'] = 2;
			} elseif (substr(trim($link), 0, 5) == 'file:') {
				$links[$i]['type'] = 3;
			} elseif (substr(trim($link), 0, 7) == 'mailto:') {
				$links[$i]['type'] = 4;
			} else if (is_numeric(trim($link))) {
				$links[$i]['type'] = 1;
			} else {
				$links[$i]['type'] = 0;
			}
			$i++;
		}
		return $links;
	}
	
	/**
	 * Returns the link
	 *
	 * @return string $link
	 */
	public function getLink() {
		// TODO: Link anders speichern!
		return $this->link;
	}

	/**
	 * Sets the link
	 *
	 * @param string $link
	 * @return void
	 */
	public function setLink($link) {
		$this->link = $link;
	}

	/**
	 * Returns the image
	 *
	 * @return string $image
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * Sets the image
	 *
	 * @param string $image
	 * @return void
	 */
	public function setImage($image) {
		$this->image = $image;
	}

	/**
	 * Returns the image2
	 *
	 * @return string $image2
	 */
	public function getImage2() {
		return $this->image2;
	}

	/**
	 * Sets the image2
	 *
	 * @param string $image2
	 * @return void
	 */
	public function setImage2($image2) {
		$this->image2 = $image2;
	}

	/**
	 * Returns the caption 2
	 *
	 * @return string $caption2
	 */
	public function getCaption2() {
		return $this->caption2;
	}

	/**
	 * Sets the caption 2
	 *
	 * @param string $caption2
	 * @return void
	 */
	public function setCaption2($caption2) {
		$this->caption2 = $caption2;
	}

	/**
	 * Returns the image3
	 *
	 * @return string $image3
	 */
	public function getImage3() {
		return $this->image3;
	}

	/**
	 * Sets the image 3
	 *
	 * @param string $image3
	 * @return void
	 */
	public function setImage3($image3) {
		$this->image3 = $image3;
	}
	
	/**
	 * Returns the caption 3
	 *
	 * @return string $caption3
	 */
	public function getCaption3() {
		return $this->caption3;
	}

	/**
	 * Sets the caption 3
	 *
	 * @param string $caption3
	 * @return void
	 */
	public function setCaption3($caption3) {
		$this->caption3 = $caption3;
	}

	/**
	 * Returns the image4
	 *
	 * @return string $image4
	 */
	public function getImage4() {
		return $this->image4;
	}

	/**
	 * Sets the image 4
	 *
	 * @param string $image4
	 * @return void
	 */
	public function setImage4($image4) {
		$this->image4 = $image4;
	}

	/**
	 * Returns the caption 4
	 *
	 * @return string $caption4
	 */
	public function getCaption4() {
		return $this->caption4;
	}

	/**
	 * Returns the image5
	 *
	 * @return string $image5
	 */
	public function getImage5() {
		return $this->image5;
	}

	/**
	 * Sets the caption 4
	 *
	 * @param string $caption4
	 * @return void
	 */
	public function setCaption4($caption4) {
		$this->caption4 = $caption4;
	}

	/**
	 * Sets the image 5
	 *
	 * @param string $image5
	 * @return void
	 */
	public function setImage5($image5) {
		$this->image5 = $image5;
	}
	
	/**
	 * Returns the caption 5
	 *
	 * @return string $caption5
	 */
	public function getCaption5() {
		return $this->caption5;
	}

	/**
	 * Sets the caption 5
	 *
	 * @param string $caption5
	 * @return void
	 */
	public function setCaption5($caption5) {
		$this->caption5 = $caption5;
	}

	/**
	 * Returns the image
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $falimage
	 */
	public function getFalimage()
	{
		return $this->falimage;
	}
	
	/**
	 * Sets the falimage
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $falimage
	 * @return void
	 */
	public function setFalmage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $falimage)
	{
		$this->falimage = $falimage;
	}

	/**
	 * Returns the image
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $falimage2
	 */
	public function getFalimage2()
	{
		return $this->falimage2;
	}
	
	/**
	 * Sets the falimage2
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $falimage2
	 * @return void
	 */
	public function setFalimage2(\TYPO3\CMS\Extbase\Domain\Model\FileReference $falimage2)
	{
		$this->falimage2 = $falimage2;
	}

	/**
	 * Returns the image
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $falimage3
	 */
	public function getFalimage3()
	{
		return $this->falimage3;
	}
	
	/**
	 * Sets the falimage3
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $falimage3
	 * @return void
	 */
	public function setFalimage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $falimage3)
	{
		$this->falimage3 = $falimage3;
	}

	/**
	 * Returns the image
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $falimage4
	 */
	public function getFalimage4()
	{
		return $this->falimage4;
	}
	
	/**
	 * Sets the falimage4
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $falimage4
	 * @return void
	 */
	public function setFalimage4(\TYPO3\CMS\Extbase\Domain\Model\FileReference $falimage4)
	{
		$this->falimage4 = $falimage4;
	}

	/**
	 * Returns the image
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $falimag5
	 */
	public function getFalimage5()
	{
		return $this->falimage5;
	}
	
	/**
	 * Sets the falimage5
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $falimage5
	 * @return void
	 */
	public function setFalimage5(\TYPO3\CMS\Extbase\Domain\Model\FileReference $falimage5)
	{
		$this->falimage5 = $falimage5;
	}
	
	/**
	 * Returns the street
	 *
	 * @return string $street
	 */
	public function getStreet() {
		return $this->street;
	}

	/**
	 * Gets the street nl2br
	 *
	 * @return string $street
	 */
	public function getStreetNl2br() {
		$street = str_replace(array("'"), "\'", $this->street);
		return str_replace(array("\r\n", "\r", "\n"), "<br />", $street);
	}
	
	/**
	 * Sets the street
	 *
	 * @param string $street
	 * @return void
	 */
	public function setStreet($street) {
		$this->street = $street;
	}
	
	/**
	 * Returns the zip
	 *
	 * @return string $zip
	 */
	public function getZip() {
		return $this->zip;
	}

	/**
	 * Sets the zip
	 *
	 * @param string $zip
	 * @return void
	 */
	public function setZip($zip) {
		$this->zip = $zip;
	}
	
	/**
	 * Returns the city
	 *
	 * @return string $city
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Sets the city
	 *
	 * @param string $city
	 * @return void
	 */
	public function setCity($city) {
		$this->city = $city;
	}
	
	/**
	 * Returns the country
	 *
	 * @return string $country
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * Sets the country
	 *
	 * @param string $country
	 * @return void
	 */
	public function setCountry($country) {
		$this->country = $country;
	}

	/**
	 * Returns the person
	 *
	 * @return string $person
	 */
	public function getPerson() {
		return $this->person;
	}
	
	/**
	 * Sets the person
	 *
	 * @param string $person
	 * @return void
	 */
	public function setPerson($person) {
		$this->person = $person;
	}
	
	/**
	 * Returns the phone
	 *
	 * @return string $phone
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * Sets the phone
	 *
	 * @param string $phone
	 * @return void
	 */
	public function setPhone($phone) {
		$this->phone = $phone;
	}
	
	/**
	 * Returns the mobile
	 *
	 * @return string $mobile
	 */
	public function getMobile() {
		return $this->mobile;
	}

	/**
	 * Sets the mobile
	 *
	 * @param string $mobile
	 * @return void
	 */
	public function setMobile($mobile) {
		$this->mobile = $mobile;
	}
	
	/**
	 * Returns the email
	 *
	 * @return string $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the email
	 *
	 * @param string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}
	
	/**
	 * Returns the latitude
	 *
	 * @return \float $latitude
	 */
	public function getLatitude() {
		return $this->latitude;
	}

	/**
	 * Sets the latitude
	 *
	 * @param \float $latitude
	 * @return void
	 */
	public function setLatitude($latitude) {
		$this->latitude = $latitude;
	}

	/**
	 * Returns the longitude
	 *
	 * @return \float $longitude
	 */
	public function getLongitude() {
		return $this->longitude;
	}

	/**
	 * Sets the longitude
	 *
	 * @param \float $longitude
	 * @return void
	 */
	public function setLongitude($longitude) {
		$this->longitude = $longitude;
	}

	/**
	 * Returns the distance
	 *
	 * @return \float $distance
	 */
	public function getDistance() {
		return $this->distance;
	}

	/**
	 * Sets the distance
	 *
	 * @param \float $distance
	 * @return void
	 */
	public function setDistance($distance) {
		$this->distance = $distance;
	}

	/**
	 * Returns the custom1
	 *
	 * @return string $custom1
	 */
	public function getCustom1() {
		return $this->custom1;
	}

	/**
	 * Sets the custom1
	 *
	 * @param string $custom1
	 * @return void
	 */
	public function setCustom1($custom1) {
		$this->custom1 = $custom1;
	}

	/**
	 * Returns the custom2
	 *
	 * @return string $custom2
	 */
	public function getCustom2() {
		return $this->custom2;
	}

	/**
	 * Sets the custom2
	 *
	 * @param string $custom2
	 * @return void
	 */
	public function setCustom2($custom2) {
		$this->custom2 = $custom2;
	}

	/**
	 * Returns the custom3
	 *
	 * @return string $custom3
	 */
	public function getCustom3() {
		return $this->custom3;
	}

	/**
	 * Sets the custom3
	 *
	 * @param string $custom3
	 * @return void
	 */
	public function setCustom3($custom3) {
		$this->custom3 = $custom3;
	}

	/**
	 * Returns the mother
	 *
	 * @return \Quizpalme\Camaliga\Domain\Model\Content $mother
	 */
	public function getMother() {
		return $this->mother;
	}

	/**
	 * Sets the mother
	 *
	 * @param \Quizpalme\Camaliga\Domain\Model\Content $mother
	 * @return void
	 */
	public function setMother(\Quizpalme\Camaliga\Domain\Model\Content $mother) {
		$this->mother = $mother;
	}

	/**
	 * Adds a Category
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\Category $category
	 * @return void
	 */
	public function addCategory(\TYPO3\CMS\Extbase\Domain\Model\Category $category) {
		$this->categories->attach($category);
	}
	
	/**
	 * Removes a Category
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\Category $categoryToRemove The Category to be removed
	 * @return void
	 */
	public function removeCategory(\TYPO3\CMS\Extbase\Domain\Model\Category $categoryToRemove) {
		$this->categories->detach($categoryToRemove);
	}
	
	/**
	 * Sets the categories
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category> $categories
	 * @return void
	 */
	public function setCategories(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $categories) {
		$this->categories = $categories;
	}
	
	/**
	 * Returns the categories
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category> $categories
	 */
	public function getCategories() {
		return $this->categories;
	}
	
	/**
	 * Returns the categories: Kategorien und dessen Vater eines Elements
	 *
	 * @return array categories
	 */
	public function getCategoriesAndParents() {
		$cats = array();
		if ($this->categories) {
			$configuration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['camaliga']);
			$catMode = intval($configuration["categoryMode"]);
			$lang = intval($GLOBALS['TSFE']->config['config']['sys_language_uid']);
			// Step 1: select all categories of the current language
			$categoriesUtility = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Quizpalme\\Camaliga\\Utility\\AllCategories');
			$all_cats = $categoriesUtility->getCategoriesarrayComplete();
			// Step 2: aktuelle orig_uid herausfinden
			$orig_uid = intval($this->getUid());	// ist immer die original uid (nicht vom übersetzten Element!)
			if ($lang > 0 && $catMode == 0) {
				$res4 = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
						'uid',
						'tx_camaliga_domain_model_content',
						'deleted=0 AND hidden=0 AND sys_language_uid=' . $lang . ' AND t3_origuid=' . $orig_uid);
				if ($GLOBALS['TYPO3_DB']->sql_num_rows($res4) > 0) {
					while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res4))
						if ($row['uid']) {
							$orig_uid = intval($row['uid']);	// uid of the translated element
						}
				}
				$GLOBALS['TYPO3_DB']->sql_free_result($res4);
			}
			// Step 3: get the mm-categories of the current element (from the original or translated element)
			$res4 = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
				'uid_local',
				'sys_category_record_mm',
				"tablenames='tx_camaliga_domain_model_content' AND uid_foreign=" . $orig_uid);
			if ($GLOBALS['TYPO3_DB']->sql_num_rows($res4) > 0) {
				while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res4)){
					$uid = $row['uid_local'];
					if (!isset($all_cats[$uid]['parent'])) continue;
					$parent = (int) $all_cats[$uid]['parent'];
					//if (!$all_cats[$parent]['title'])	continue;
					if (!isset($cats[$parent])) {
						$cats[$parent] = array();
						$cats[$parent]['childs'] = array();
						$cats[$parent]['title'] = $all_cats[$parent]['title'];
					}
					if ($all_cats[$uid]['title'])
						$cats[$parent]['childs'][$uid] = $all_cats[$uid]['title'];
				}
			}
			$GLOBALS['TYPO3_DB']->sql_free_result($res4);
		}
		return $cats;
	}

	/**
	 * Returns the modulo begin
	 *
	 * @return integer $moduloBegin
	 */
	public function getModuloBegin() {
		return $this->moduloBegin;
	}
	
	/**
	 * Sets the modulo begin
	 *
	 * @param integer $moduloBegin
	 * @return void
	 */
	public function setModuloBegin($moduloBegin) {
		$this->moduloBegin = $moduloBegin;
	}

	/**
	 * Returns the modulo end
	 *
	 * @return integer $moduloEnd
	 */
	public function getModuloEnd() {
		return $this->moduloEnd;
	}
	
	/**
	 * Sets the modulo end
	 *
	 * @param integer $moduloEnd
	 * @return void
	 */
	public function setModuloEnd($moduloEnd) {
		$this->moduloEnd = $moduloEnd;
	}
	

	/**
	 * Returns the extended fields: custom extended fields
	 *
	 * @return array fields
	 */
	public function getExtended() {
		$extended = array();
		$configuration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['camaliga']);
		$extendedFields = $configuration["extendedFields"];
		if ($extendedFields) {
			$orig_uid = intval($this->getUid());	// ist immer die original uid (nicht vom übersetzten Element!)
			$fieldsArray = explode(' ', trim($extendedFields));
			$search = implode(',', $fieldsArray);
			if ($search) {
				$res4 = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
							$search,
							'tx_camaliga_domain_model_content',
							'uid=' . $orig_uid);
				if ($GLOBALS['TYPO3_DB']->sql_num_rows($res4) > 0) {
					$extended = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res4);
				}
				$GLOBALS['TYPO3_DB']->sql_free_result($res4);
			}
		}
		return $extended;
	}
}
?>