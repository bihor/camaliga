<?php
namespace Quizpalme\Camaliga\Domain\Model;

class Category extends \TYPO3\CMS\Extbase\Domain\Model\Category
{
	/**
	 * categories
	 *
	 * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Quizpalme\Camaliga\Domain\Model\Category>
	 */
	protected $categories;
	
	/**
	 * Get categories
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Quizpalme\Camaliga\Domain\Model\Category>
	 */
	public function getCategories()
	{
		return $this->categories;
	}
	
	/**
	 * Set categories
	 *
	 * @param  \TYPO3\CMS\Extbase\Persistence\ObjectStorage $categories
	 * @return void
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	}
}