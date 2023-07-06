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
class Content extends \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject
{
    /**
     * @var \DateTime
     */
    protected $tstamp = null;
    
    /**
     * @var \DateTime
     */
    protected $crdate = null;
    
    /**
     * Sorting
     *
     * @var integer
     */
    protected $sorting = 0;
    
	/**
	 * Title
	 * 
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
	 * Slug
	 *
	 * @var string
	 */
	protected $slug;
	
	/**
	 * Image 1
	 *
	 * @Extbase\ORM\Cascade("remove")
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $falimage = null;

	/**
	 * Image 2
	 *
	 * @Extbase\ORM\Cascade("remove")
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $falimage2 = null;

	/**
	 * Image 3
	 *
	 * @Extbase\ORM\Cascade("remove")
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $falimage3 = null;

	/**
	 * Image 4
	 * 
	 * @Extbase\ORM\Cascade("remove")
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $falimage4 = null;

	/**
	 * Image 5
	 *
	 * @Extbase\ORM\Cascade("remove")
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
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
	protected $latitude = 0.0;

	/**
	 * Longitude
	 *
	 * @var float
	 */
	protected $longitude = 0.0;

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
	 * @Extbase\ORM\Lazy
	 * @var \Quizpalme\Camaliga\Domain\Model\Content
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
		$this->categories = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
	 * Returns the creation date
	 *
	 * @return \DateTime $crdate
	 */
	public function getCrdate()
	{
	    return $this->crdate;
	}
	
	/**
	 * Returns the last modified date
	 *
	 * @return \DateTime $tstamp
	 */
	public function getTstamp()
	{
	    return $this->tstamp;
	}
	
	/**
	 * Returns the sorting
	 *
	 * @return int $sorting
	 */
	public function getSorting()
	{
	    return $this->sorting;
	}
	
	/**
	 * Sets the sorting
	 *
	 * @param string $sorting
	 * @return void
	 */
	public function setSorting($sorting) {
	    $this->sorting = $sorting;
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
		$tmp = str_replace(array("'"), "\'", $this->shortdesc);
		return str_replace(array("\r\n", "\r", "\n"), "<br />", $tmp);
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
		$tmp = str_replace(array("'"), "\'", $this->longdesc);
		return str_replace(array("\r\n", "\r", "\n"), "<br />", $tmp);
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
		$contentRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Quizpalme\\Camaliga\\Domain\\Repository\\ContentRepository');
		$output = '';
		$linkArray = explode('?', $this->link);
		if ($linkArray[0] == 't3://file') {
			$linkArray2 = explode('=', $linkArray[1]);
			$output = $contentRepository->getFileLink(intval($linkArray2[1]));	// content element uid
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
	 * Returns the slug
	 *
	 * @return string $slug
	 */
	public function getSlug() {
		return $this->slug;
	}
	
	/**
	 * Sets the slug
	 *
	 * @param string $slug
	 * @return void
	 */
	public function setSlug($slug) {
		$this->slug = $slug;
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
	public function setFalimage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $falimage)
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
	public function setFalimage3(\TYPO3\CMS\Extbase\Domain\Model\FileReference $falimage3)
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
		$tmp = str_replace(array("'"), "\'", $this->street);
		return str_replace(array("\r\n", "\r", "\n"), "<br />", $tmp);
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
		$configurationManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface');
		$settings = $configurationManager->getConfiguration(
			\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT
		);
		$categorySettings = $settings['plugin.']['tx_camaliga.']['settings.']['category.'];
		if ($categorySettings['storagePids']) {
			if ($categorySettings['storagePids'] == -1) {
				$catStoragePids = [];
			} else {
				$catStoragePids = explode(',', $categorySettings['storagePids']);
			}
		} else {
			$contentRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Quizpalme\\Camaliga\\Domain\\Repository\\ContentRepository');
			$catStoragePids = $contentRepository->getStoragePids();
		}
		$categoryRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Quizpalme\\Camaliga\\Domain\\Repository\\CategoryRepository');
		$all_cats = $categoryRepository->getAllCats($categorySettings['sortBy'], $categorySettings['orderBy'], $catStoragePids);
		$used_cats = [];
		foreach ($this->getCategories() as $category) {
			$cat_uid = $category->getUid();
			$parent = $category->getParent();
			$used_cats[$cat_uid] = $cat_uid;
			if ($parent) {
				$cat_uid = $parent->getUid();
				$used_cats[$cat_uid] = $cat_uid;
			}
		}
		return $categoryRepository->getCategoriesAndParents($all_cats, $used_cats);
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
		$extended = [];
		$extendedFields = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class)->get('camaliga', 'extendedFields');
		if ($extendedFields) {
			$orig_uid = intval($this->getUid());	// ist immer die original uid (nicht vom übersetzten Element!)
			$fieldsArray = explode(' ', trim($extendedFields));
			//$search = implode(',', $fieldsArray);
			if (!empty($fieldsArray)) {
				foreach ($fieldsArray as $field) {
					$queryBuilder = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\ConnectionPool::class)->getQueryBuilderForTable('tx_camaliga_domain_model_content');
					$statement = $queryBuilder
					->select($field)
					->from('tx_camaliga_domain_model_content')
					->where(
						$queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($orig_uid, \PDO::PARAM_INT))
					)
					->setMaxResults(1)
					->executeQuery();
					while ($row = $statement->fetchAssociative()) {
						$extended[$field] = $row[$field];
					}
				}
			}
		}
		return $extended;
	}
	
	/**
	 * Repairs a not correct set FAL-reference
	 *
	 * @param integer $uid UID
	 */
	public function repairFALreference($uid) {
		$queryBuilder = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\ConnectionPool::class)->getQueryBuilderForTable('sys_file_reference');
		$queryBuilder
			->update('sys_file_reference')
			->where(
				$queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($uid, \PDO::PARAM_INT))
			)
			->set('tablenames', 'tx_camaliga_domain_model_content')
			->set('sorting_foreign', 1)
			->set('table_local', 'sys_file')
			->executeStatement();
	}
}