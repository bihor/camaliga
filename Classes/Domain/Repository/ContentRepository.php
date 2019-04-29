<?php
namespace Quizpalme\Camaliga\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Kurt Gusbeth <info@quizpalme.de>
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
 * Content Repository: das Herz der Extension
 *
 * @package camaliga
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class ContentRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * Entferungsarray
	 *
	 * @var \array
	 */
	protected $distanceArray = array();
	
	// Entferungsarray zurück geben
	function getDistanceArray() {
		return $this->distanceArray;
	}
	
	// String Escape for DB
	function ms_escape_string($data) {
		if ( !isset($data) or empty($data) ) return '';
		if ( is_numeric($data) ) return $data;
	
		$non_displayables = array(
				'/%0[0-8bcef]/',            // url encoded 00-08, 11, 12, 14, 15
				'/%1[0-9a-f]/',             // url encoded 16-31
				'/[\x00-\x08]/',            // 00-08
				'/\x0b/',                   // 11
				'/\x0c/',                   // 12
				'/[\x0e-\x1f]/'             // 14-31
		);
		foreach ( $non_displayables as $regex )
			$data = preg_replace( $regex, '', $data );
		$entf = array('\\', '"', "'", '%', '´', '`');
		$data = str_replace($entf, '', $data );
		return $data;
	}
	
	/**
	 * findAll ersetzen, wegen Sortierung
	 * @param	string	$sortBy		Sort by
	 * @param	string	$sortOrder	Sort order
	 * @param	boolean	$onlyDistinct	Only distinct entries?
	 * @param	array	$pids		Storage PIDs
	 * @param	integer	$limit		Limit
	 */
	public function findAll($sortBy = 'sorting', $sortOrder = 'asc', $onlyDistinct = FALSE, $pids = array(), $limit = 0) {
		$order = ($sortOrder == 'desc') ? \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING :
										 \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING;
		if ($sortBy=='sorting' || $sortBy=='tstamp' || $sortBy=='crdate' || $sortBy=='title' || $sortBy=='zip' || $sortBy=='city'
		 || $sortBy=='country' || $sortBy=='custom1' || $sortBy=='custom2' || $sortBy=='custom3') {
		 	//OK
		} else $sortBy = 'sorting';
		
		$constraints = array();
		$query = $this->createQuery();
		if (count($pids)>0) {
			$query->getQuerySettings()->setRespectStoragePage(FALSE);
			$constraints[] = $query->in('pid', $pids);
		}
		// keine gute Idee: Mutter muss 0 sein, aber nur wenn die Mutter vorhanden ist (die könnte auch in einem anderen Ordner liegen)
		//if ($onlyDistinct)
		//	$constraints[] = $query->equals('mother', 0);
		if (count($constraints) > 0)
			$query->matching($query->logicalAnd($constraints));
		if ($limit > 0)
			$query->setLimit(intval($limit));
		//	->setOffset($page * $limit)
		$result = $query
			->setOrderings(	array($sortBy => $order) )
			->execute();
		
		if ($onlyDistinct) {
			// bessere Idee:
			$resUids = array();
			$delKeys = array();
			foreach ($result as $element) {
				$resUids[$element->getUid()] = 1;
			}
			foreach ($result as $key => $element)  {
				if (($element->getMother()) && ($resUids[$element->getMother()->getUid()] == 1)) {
					// Mutter und Kind sind vorhanden => Kind löschen
					$delKeys[] = $key;
				}
			}
			if (count($delKeys) > 0) {
				foreach ($delKeys as $key)  {
					// Mutter und Kind sind vorhanden => Kind löschen
					unset($result[$key]);
				}
			}
		}
		return $result;
	}

	/**
	 * findComplex: umfangreiche Suche
	 * @param	array	$uids		UIDs
	 * @param	string	$sword		Suchwort
	 * @param	string	$place		Ort
	 * @param	integer	$radius		Radius
	 * @param	string	$sortBy		Sort by
	 * @param	string	$sortOrder	Sort order
	 * @param	boolean	$onlyDistinct	Only distinct entries?
	 * @param	array	$pids		Storage PIDs
	 * @param	integer	$limit		Limit
	 */
	public function findComplex($uids, $sword, $place, $radius, $sortBy = 'sorting', $sortOrder = 'asc', $onlyDistinct = FALSE, $pids = array(), $limit = 0) {
		$order = ($sortOrder == 'desc') ? \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING :
										  \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING;
		if ($sortBy=='sorting' || $sortBy=='tstamp' || $sortBy=='title' || $sortBy=='zip' || $sortBy=='city'
			 || $sortBy=='country' || $sortBy=='custom1' || $sortBy=='custom2' || $sortBy=='custom3') {
			 	//OK
		} else $sortBy = 'sorting';
		if ($sword) $sword = '%' . $sword . '%';
		if (count($uids) > 0) {
			$catSearch = TRUE;
		} else {
			$catSearch = FALSE;
			$uids = array();
		}
		$noMatch = FALSE;
		$this->distanceArray = array();
		
		// Umkreissuche von hier: http://opengeodb.org/wiki/OpenGeoDB_-_Umkreissuche
		if ($place && $radius) {
			$ort = $this->ms_escape_string($place);
			$radius = intval($radius);
			
			// Position des Suchortes finden
			$where = (is_numeric($ort)) ? "zc_zip = '" . $ort . "'" : "zc_location_name LIKE '" . $ort . "%'";
			$res4 = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
					'zc_id, zc_location_name, zc_lat, zc_lon',
					'geodb_zip_coordinates',
					$where,
					'',
					'zc_location_name',
					'1');
			if ($GLOBALS['TYPO3_DB']->sql_num_rows($res4) > 0) {
				while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res4)){
					$zc_id = $row['zc_id'];
					$zc_name = $row['zc_location_name'];
					$zc_lat = $row['zc_lat'];
					$zc_lon = $row['zc_lon'];
				}
			}
			$GLOBALS['TYPO3_DB']->sql_free_result($res4);
			
			// Elemente in der Umgebung des Suchortes finden
			if ($zc_id) {
				$new_uids = array();
				$res4 = $GLOBALS['TYPO3_DB']->sql_query(
						'SELECT dest.uid, dest.zip, dest.city,
							ACOS(
						         SIN(RADIANS(src.zc_lat)) * SIN(RADIANS(dest.latitude)) 
						         + COS(RADIANS(src.zc_lat)) * COS(RADIANS(dest.latitude))
						         * COS(RADIANS(src.zc_lon) - RADIANS(dest.longitude))
						    ) * 6380 AS distance
						FROM tx_camaliga_domain_model_content dest
						CROSS JOIN geodb_zip_coordinates src
						WHERE src.zc_id = ' . $zc_id .'
						HAVING distance < ' . $radius);  // . 'ORDER BY distance');
				if ($GLOBALS['TYPO3_DB']->sql_num_rows($res4) > 0) {
					while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res4)){
						$uid = intval($row['uid']);
						//echo "\nGefunden: " . $uid . ': ' . $row['zip'] . ' ' . $row['city'];
						if ($catSearch) {
							// Gibt es auch eine Übereinstimmung bei der Kategoriensuche?
							if ($uids[$uid] > 0) {
								$new_uids[$uid] = $uid;
								$this->distanceArray[$uid] = $row['distance'];
							}
						} else {
							// Keine Kategoriensuche
							$uids[$uid] = $uid;
							$this->distanceArray[$uid] = $row['distance'];
						}
					}
				}
				$GLOBALS['TYPO3_DB']->sql_free_result($res4);
				// nur die UIDs übernehmen, wo Kategorie-Suche und PLZ/Ort-Suche das selbe gefunden hat!
				if ($catSearch)
					$uids = $new_uids;
			} else {
				// nix gefunden
				$uids = array();
			}
			if (count($uids) == 0) $noMatch = TRUE;	// keine Treffer bei der Umkreissuche!
		} else if ($place) {
			// Suche nach Ort, aber keine Umkreissuche
			$place = $place . '%';
		}
		
		if (!$noMatch) {
			$constraints = array();
			$query = $this->createQuery();
			if (count($pids)>0) {
				$query->getQuerySettings()->setRespectStoragePage(FALSE);
				$constraints[] = $query->in('pid', $pids);
			}
			if ($onlyDistinct)
				$constraints[] = $query->equals('mother', 0);
			if (count($uids) > 0)
				$constraints[] = $query->in('uid', $uids);
			if ($place && !$radius) {
				$constraints[] = $query->logicalOr(
					$query->like('city', $place),
					$query->like('zip', $place)
				);
			} elseif ($sword) {
				$constraints[] = $query->logicalOr(
					$query->logicalOr(
							$query->logicalOr(
									$query->like('title', $sword),
									$query->like('shortdesc', $sword)
							),
							$query->logicalOr(
									$query->like('person', $sword),
									$query->like('longdesc', $sword)
							)
					),
					$query->logicalOr(
							$query->logicalOr(
									$query->like('custom1', $sword),
									$query->like('custom2', $sword)
									),
							$query->logicalOr(
									$query->like('city', $sword),
									$query->like('zip', $sword)
									)
					)
				);
			}
			if (count($constraints) > 0)
				$query->matching($query->logicalAnd($constraints));
			if ($limit > 0)
				$query->setLimit(intval($limit));
			return $query
				->setOrderings(array($sortBy => $order))
				->execute();
		}
	}
	
	/**
	 * findByUids ersetzen, wegen Sortierung
	 * @param	array	$uids		UIDs
	 * @param	string	$sortBy		Sort by
	 * @param	string	$sortOrder	Sort order
	 */
	public function findByUids($uids, $sortBy = 'sorting', $sortOrder = 'asc') {
		$order = ($sortOrder == 'desc') ? \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING :
										 \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING;
		if ($sortBy=='sorting' || $sortBy=='tstamp' || $sortBy=='title' || $sortBy=='zip' || $sortBy=='city'
		 || $sortBy=='country' || $sortBy=='custom1' || $sortBy=='custom2' || $sortBy=='custom3') {
		 	//OK
		} else $sortBy = 'sorting';
		$query = $this->createQuery();
		// nicht nötig:
		// if ($onlyDistinct) $query->matching($query->logicalAnd($query->equals('mother', 0), $query->in('uid', $uids))); else 
		$query->matching($query->in('uid', $uids));
		return $query
			->setOrderings(	array($sortBy => $order) )
			->execute();
	}
	
	/**
	 * findByCategories ersetzen, wegen Sortierung
	 * @param	array	$cat_uids	UIDs von Kategorien
	 * @param	string	$sword		Suchwort
	 * @param	string	$place		Ort
	 * @param	integer	$radius		Radius
	 * @param	string	$sortBy		Sort by
	 * @param	string	$sortOrder	Sort order
	 * @param	boolean	$onlyDistinct	Only distinct entries?
	 * @param	array	$pids		Storage PIDs
	 * @param	boolean	$checkMax	true: OR/AND mode; false: only OR mode
	 * @param	integer	$limit		Limit
	 */
	public function findByCategories($cat_uids, $sword, $place, $radius, $sortBy = 'sorting', $sortOrder = 'asc', $onlyDistinct = FALSE, $pids = array(), $checkMax = TRUE, $limit = 0) {
		if (count($cat_uids) > 0) {
			$max = 0;
			$parents = array();	// Übergeordnete Elemente
			$childs = array();	// Kind-Elemente, die angezeigt werden sollen
			$twice = array();	// Kind-Elemente, die entfernt werden sollen
			$elements = array();	// Elemente, die gefunden wurden, mit Anzahl der Treffer bei der Suche zu diesem Element
			$results = array();		// Elemente, die zum Schluss übrig bleiben
			if (count($pids)>0) $where = ' AND con.pid IN (' . implode(',', $pids) . ')'; else $where = '';
			foreach ($cat_uids as $uidsChilds) {
				// Search all elements of specified category/ies
				$res4 = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
					'DISTINCT mm.uid_foreign, con.mother',
					'sys_category_record_mm AS mm, tx_camaliga_domain_model_content AS con',
					"mm.tablenames='tx_camaliga_domain_model_content' AND
					 mm.uid_foreign=con.uid AND mm.uid_local IN (" . $uidsChilds . ')' . $where);
				if ($GLOBALS['TYPO3_DB']->sql_num_rows($res4) > 0) {
					while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res4)){
						$cam_uid = $row['uid_foreign'];
						$elements[$cam_uid]++;
						$parents[$cam_uid] = $row['mother'];
						$childs[$cam_uid] = 0;
					}
				}
				$GLOBALS['TYPO3_DB']->sql_free_result($res4);
				$max++;
			}
			//var_dump($uids); echo "max: $max -- "; var_dump($elements);
			
			// take only elements where all matches were true
			foreach ($elements as $uid => $count) {
				if (($count == $max) || !$checkMax) $results[$uid] = $uid; // statt $results[] =
			}
			
			// wenn nur einmalige Elemente angezeigt werden sollen, dann weiter ausdünnen
			if ($onlyDistinct) {
				foreach ($results as $key => $uid) {
					$mother = $parents[$uid];
					if ($mother > 0) {
						// Es gibt ein Mutter-Element
						if (in_array($mother, $results)) {
							// Mutter-Element vorhanden, also dieses Kind entfernen
							$twice[$key] = $uid;
						} else {
							if ($childs[$mother]) {
								// Ähnliches Element vorhanden, also dieses Kind entfernen
								$twice[$key] = $uid;
							} else {
								// Dieses Kind statt der Mutter anzeigen
								$childs[$mother] = $uid;
							}
						}
					}
				}
				if (count($twice) > 0) {
					// Dieses nicht eindeutigen Elemente entfernen
					foreach ($twice as $key => $uid) {
						unset($results[$key]);
					}
				}
			}
			
			if (sizeof($results) > 0) {
				// search all content elements of specified uids
				if ($sword || $place)
					return $this->findComplex($results, $sword, $place, $radius, $sortBy, $sortOrder, $onlyDistinct, $pids, $limit = 0);
				else 
					return $this->findByUids($results, $sortBy, $sortOrder);
			}
		} else {
			// sollte eigentlich nie eintreten
			return $this->findAll($sortBy, $sortOrder, $onlyDistinct, $pids, $limit = 0);
		}
	}
	
	/**
     * Get a random object
     */
    public function findRandom() {
        $rows = $this->createQuery()->execute()->count();
        $row_number = mt_rand(0, max(0, ($rows - 1)));
        return $this->createQuery()->setOffset($row_number)->setLimit(1)->execute();
    }

	/**
	 * findByMother2 ersetzen, wegen Schwestern
	 * @param	integer	$mother	Mutter-UID
	 * @param	integer	$child	Aktuelle Kind-UID
	 */
	public function findByMother2($mother, $child) {
		$mother = intval($mother);
		$child = intval($child);
		$query = $this->createQuery();
		if ($child > 0) {
			$query->matching(
					$query->logicalAnd(
							$query->equals('mother', $mother),
							$query->logicalNot($query->equals('uid', $child))
					)
			);
		} else {
			$query->matching($query->equals('mother', $mother));
		}
		return $query->execute();
	}
	
	/**
	 * findOneByUid2 ohne Ordner-Berücksichtigung
	 * @param	integer	$uid	UID
	 */
	public function findOneByUid2($uid) {
	    $query = $this->createQuery();
	    $query->getQuerySettings()->setRespectStoragePage(FALSE);
	    $result = $query->matching(
	        $query->equals('uid', $uid)
	    )->execute()->getFirst();
	    return $result;
	}
	
	/**
	 * Get categories, used by camaliga AND used by storagePids
	 *
	 * @param	array	$pids	Category PIDs
	 * @return	array
	 */
	public function getRelevantCategories($pids = []) {
		if (!$pids) {
			$pids = $this->getStoragePids();
		}
		// siehe hier: https://stackoverflow.com/questions/54691047/what-will-be-the-mm-query-in-typo3-version-9
		$table = 'tx_camaliga_domain_model_content';
		$joinTable = 'sys_category_record_mm';
		$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
		$queryBuilder
			->select('categoryMM.uid_local')
			->from($table)
			->leftJoin(
				$table,
				$joinTable,
				'categoryMM',
				$queryBuilder->expr()->eq(
					'categoryMM.uid_foreign',
					$queryBuilder->quoteIdentifier('tx_camaliga_domain_model_content.uid')
				)
			)
			->where(
				$queryBuilder->expr()->eq('categoryMM.tablenames', $queryBuilder->createNamedParameter($table)),
				$queryBuilder->expr()->eq('categoryMM.fieldname', $queryBuilder->createNamedParameter('categories')),
				$queryBuilder->expr()->in('tx_camaliga_domain_model_content.pid',	$pids)
			)
			->groupBy('categoryMM.uid_local');
		//debug($queryBuilder->getSQL());
		$statement = $queryBuilder->execute();
		return $statement->fetchAll();
	}
	
	/**
	 * Get the PIDs with Titles
	 *
	 * @return array
	 */
	public function getStoragePidsData() {
		$storagePidsData_tmp = array();
		$pids = $this->getStoragePids();
		$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('pages');
		$statement = $queryBuilder
			->select('uid','title')
			->from('pages')
			->where(
				$queryBuilder->expr()->in('uid', $pids)
			)
			->execute();
		while ($row = $statement->fetch()) {
			$uid = $row['uid'];
			$storagePidsData_tmp[$uid] = [];
			$storagePidsData_tmp[$uid]['uid'] = $uid;
			$storagePidsData_tmp[$uid]['title'] = $row['title'];
			$storagePidsData_tmp[$uid]['selected'] = 0;
		}
		return $storagePidsData_tmp;
	}
	
	/**
     * Get the PIDs
     * 
	 * @return array
     */
    public function getStoragePids() {
        $query = $this->createQuery();
		return $query->getQuerySettings()->getStoragePageIds();
    }
}
?>