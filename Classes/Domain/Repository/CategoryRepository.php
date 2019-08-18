<?php
namespace Quizpalme\Camaliga\Domain\Repository;
class CategoryRepository extends \TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository {
	
	/**
	 * findAll ersetzen, wegen Sortierung und PIDs
	 * @param	string	$sortBy		Sort by
	 * @param	string	$sortOrder	Sort order
	 * @param	array	$pids		Storage PIDs
	 */
	public function findAll($sortBy = 'sorting', $sortOrder = 'asc', $pids = []) {
		$order = ($sortOrder == 'desc') ? \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING :
		\TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING;
		if (!($sortBy=='sorting' || $sortBy=='tstamp' || $sortBy=='crdate' || $sortBy=='title' || $sortBy=='uid')) {
			$sortBy = 'sorting';
		}
		$constraints = [];
		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		if (count($pids)>0) {
			$constraints[] = $query->in('pid', $pids);
		}
		if (count($constraints) > 0)
			$query->matching($query->logicalAnd($constraints));
			$result = $query
				->setOrderings(	array($sortBy => $order) )
				->execute();
			return $result;
	}
}