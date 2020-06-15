<?php
namespace Quizpalme\Camaliga\Task;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class BuildSlugTask extends \TYPO3\CMS\Scheduler\Task\AbstractTask {
	
	public function execute() {
		$successfullyExecuted = TRUE;
		$uids = [];
		
		$fieldConfig = $GLOBALS['TCA']['tx_camaliga_domain_model_content']['columns']['slug']['config'];
		$slugHelper = GeneralUtility::makeInstance(\TYPO3\CMS\Core\DataHandling\SlugHelper::class, 'tx_camaliga_domain_model_content', 'slug', $fieldConfig);
		
		// Alle Camaliga-Elemente holen
		$connection = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\ConnectionPool::class)->getConnectionForTable('tx_camaliga_domain_model_content');
		$queryBuilder = $connection->createQueryBuilder();		
		$statement = $queryBuilder->select('*')->from('tx_camaliga_domain_model_content')->execute();
		while ($row = $statement->fetch()) {
			$uids[] = $row['uid'];
		}
		
		// Alle Camaliga-Elemente durchgehen
		foreach ($uids as $uid) {
			$queryBuilder = $connection->createQueryBuilder();
			$queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction::class));
			$statement = $queryBuilder->select('*')->from('tx_camaliga_domain_model_content')->where(
				$queryBuilder->expr()->eq('uid', $uid)
			)->execute();
			
			$record = $statement->fetch();
			$slug = $record['slug'];
			
			if (!$slug) {
    			$slug = $slugHelper->generate($record, $record['pid']);
    			if ($slug) {
    			    //echo "neuer Slug: $slug";
        			// Update
        			$queryBuilder = $connection->createQueryBuilder();
        			$queryBuilder->update('tx_camaliga_domain_model_content')->where(
        				$queryBuilder->expr()->eq('uid', $uid)
        			)->set('slug', $slug)->execute();
    			}
			}
		}
		return $successfullyExecuted;
	}
}