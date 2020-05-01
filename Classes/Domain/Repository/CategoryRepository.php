<?php
namespace Quizpalme\Camaliga\Domain\Repository;
class CategoryRepository extends \TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository {
	
	/**
	 * findAll ersetzen, wegen Sortierung und PIDs
	 * 
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
		if (count($constraints) > 0) {
			$query->matching($query->logicalAnd($constraints));
		}
		$result = $query
			->setOrderings(	array($sortBy => $order) )
			->execute();
		return $result;
	}
	
	/**
	 * getAllCats: all categories in one simple array
	 *
	 * @param	string	$sortBy		Sort by
	 * @param	string	$sortOrder	Sort order
	 * @param	array	$pids		Storage PIDs
	 * @return	array	categories
	 */
	public function getAllCats($sortBy = 'sorting', $sortOrder = 'asc', $pids = []) {
		// Step 0: init
		$all_cats = [];
		// Step 1: get all categories
		$catRows = $this->findAll($sortBy, $sortOrder, $pids);		
		// Step 2: select categories, used by this extension AND used by this storagePids: needed for the category-restriction at the bottom
		if ($catRows) {
			$parentUids = [];
			foreach ($catRows as $row) {
				// Die Parents sind für die Options sehr wichtig
				$parent = $row->getParent();
				if (!$parent) continue;
				$parentUids[$parent->getUid()] = 1;
			}
			for ($i=1; $i<=2; $i++) {
				foreach ($catRows as $row) {
					$uid = $row->getUid();
					if (($i==1 && $parentUids[$uid]==1) || ($i==2 && !$parentUids[$uid])) {
						// In Durchgang 1 die Parents aufnehmen und in Durchgang 2 die Childs
						$parent = $row->getParent();
						if (!$parent) continue;		// wer keinen Parent hat, interessiert uns nicht
						$all_cats[$uid] = [];
						$all_cats[$uid]['uid'] = $uid;
						$all_cats[$uid]['parent'] = $parent->getUid();
						$all_cats[$uid]['title']  = $row->getTitle();
						$all_cats[$uid]['description'] = $row->getDescription();
					}
				}
			}
		}
		return $all_cats;
	}
	
	
	/**
	 * getCategoriesAndParents: all categories in a 2D array with parents and childs
	 *
	 * @param	array	$all_cats	All categories
	 * @param	array	$used_cats	Categories of a camaliga entry
	 * @return	array	categories
	 */
	public function getCategoriesAndParents($all_cats = [], $used_cats = []) {
		$cats = [];
		if (count($all_cats) > 0) {
			$parentUids = [];
			foreach ($all_cats as $row) {
				// Die Parents sind für die Options sehr wichtig
				$parent = $row['parent'];
				if (!$parent) continue;
				$parentUids[$parent] = 1;
			}
			for ($i=1; $i<=2; $i++) {
				foreach ($all_cats as $row) {
					$uid = $row['uid'];
					$parent = $row['parent'];
					if ((count($used_cats)==0) || ($used_cats[$uid])) {
						if (($i==1 && $parentUids[$uid]==1) || ($i==2)) { // && !$parentUids[$uid])) {
							// In Durchgang 1 die Parents aufnehmen und in Durchgang 2 die Childs
							if ($i==1) {
								// nur parents sind dran
								$cats[$uid] = [];
								$cats[$uid]['childs'] = [];
								$cats[$uid]['uid'] = $uid;
								$cats[$uid]['title'] = $row['title'];
								$cats[$uid]['description'] = $row['description'];
								#echo " # parent ".$row['title'];
							} elseif (($i==2) && is_array($cats[$parent]) && $cats[$parent]['title']) {
								// nur childs und tiefer gelegene parents sind dran
								$cats[$parent]['childs'][$uid] = [];
								$cats[$parent]['childs'][$uid]['uid'] = $uid;
								$cats[$parent]['childs'][$uid]['title'] = $row['title'];
								$cats[$parent]['childs'][$uid]['description'] = $row['description'];
								//echo " # child/deeper parent: ".$row['title'].'='.$parentUids[$uid].'/'.$cats[$parent]['title'];
							} elseif ($i==2) {
								//echo " # no child: ".$row['title'];
							}
						}
					}
				}
			}
		}
		return $cats;
	}
}