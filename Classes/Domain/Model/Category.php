<?php
namespace Quizpalme\Camaliga\Domain\Model;
class Category extends \TYPO3\CMS\Extbase\Domain\Model\Category {
	/**
	 * CategoryRepository, wie hier: https://gist.github.com/iamandrewluca/7b9a7a3d5463f6f27f668eb2fcdda1ad
	 *
	 * @var \Quizpalme\Camaliga\Domain\Repository\CategoryRepository
	 * @inject
	 */
	protected $categoryRepository = null;
	
	/**
	 * categories
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Quizpalme\Camaliga\Domain\Model\Category>
	 * @lazy
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