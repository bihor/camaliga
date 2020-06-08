<?php
namespace Quizpalme\Camaliga\Utility;

# Seitentitel setzen???
class PageTitle {
	public function getTitleTag($content, $conf) {
		$id = 0;
		//$trim = $GLOBALS['TSFE']->tmpl->setup['config.']['titleTagFunction.']['noTrimWrap'];
		$params = $_POST['tx_camaliga_pi1'];
		if (count($params) == 0) {
			$params = $_GET['tx_camaliga_pi1'];
		}
		if (count($params) > 0) {
			$id = intval($params['content']);
		}
		if ($id > 0) {
            $queryBuilder = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\ConnectionPool::class)->getQueryBuilderForTable('tx_camaliga_domain_model_content');
            $statement = $queryBuilder
                ->select('title')
                ->from('tx_camaliga_domain_model_content')
                ->where(
                    $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($id, \PDO::PARAM_INT))
                )
                ->setMaxResults(1)
                ->execute();
            while ($row = $statement->fetch()) {
                $pageTitle = $row['title'];
            }
		}
		return trim($pageTitle);
	}
}
