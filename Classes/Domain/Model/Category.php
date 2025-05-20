<?php
namespace Quizpalme\Camaliga\Domain\Model;

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
class Category extends \TYPO3\CMS\Extbase\Domain\Model\Category
{
	/**
  * categories
  *
  * @var ObjectStorage<\Quizpalme\Camaliga\Domain\Model\Category>
  */
 #[Lazy]
 protected $categories;
	
	/**
  * Get categories
  *
  * @return ObjectStorage<\Quizpalme\Camaliga\Domain\Model\Category>
  */
 public function getCategories()
	{
		return $this->categories;
	}
	
	/**
  * Set categories
  *
  * @param ObjectStorage $categories
  * @return void
  */
 public function setCategories($categories): void
	{
		$this->categories = $categories;
	}
}