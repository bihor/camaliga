<?php
// set you own vendor name adjust the extension name part of the namespace to your extension key
namespace Quizpalme\Camaliga\Hooks;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;

// set you own class name
class KeSearchIndexer
{
    // Set a key for your indexer configuration.
    // Add this in Configuration/TCA/Overrides/tx_kesearch_indexerconfig.php, too!
    protected $indexerConfigurationKey = 'camaliga';

    /**
     * Adds the custom indexer to the TCA of indexer configurations, so that
     * it's selectable in the backend as an indexer type when you create a
     * new indexer configuration.
     *
     * @param array $params
     * @param type $pObj
     */
    public function registerIndexerConfiguration(&$params, $pObj)
    {
        // Set a name and an icon for your indexer.
        $customIndexer = array(
            'Camaliga elements (ext:camaliga)',
            $this->indexerConfigurationKey,
        	'EXT:camaliga/ext_icon.gif'
        );
        $params['items'][] = $customIndexer;
    }


    /**
     * Custom indexer for ke_search
     *
     * @param   array $indexerConfig Configuration from TYPO3 Backend
     * @param   array $indexerObject Reference to indexer class.
     * @return  string Message containing indexed elements
     * @author  Christian Buelter <christian.buelter@pluswerk.ag>
     */
    public function customIndexer(&$indexerConfig, &$indexerObject)
    {
        if ($indexerConfig['type'] == $this->indexerConfigurationKey) {
            $content = '';
            $counter = 0;
            $dontSwitchContAct = (bool)GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('camaliga', 'dontSwitchContAct');
            $actionForLinks = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('camaliga', 'actionForLinks');
            if (!$actionForLinks) {
            	$actionForLinks = 'show';
            }

            // get all the entries to index
            // don't index hidden or deleted elements, but
            // get the elements with frontend user group access restrictions
            // or time (start / stop) restrictions, in order to copy those restrictions to the index.
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_camaliga_domain_model_content');
            $queryBuilder->getRestrictions()->removeAll();
            $statement = $queryBuilder
            	->select('*')
            	->from('tx_camaliga_domain_model_content')
            	->where(
            		$queryBuilder->expr()->in('pid', explode(',', $indexerConfig['sysfolder']))
            	)
            	->andWhere(
            		$queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
            	)
            	->andWhere(
            		$queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
            	)
            	->execute();

            // Loop through the records and write them to the index.
            while ($record = $statement->fetch()) {
                    // compile the information which should go into the index
                    // the field names depend on the table you want to index!
                    $title = strip_tags($record['title']);
					$abstract = strip_tags($record['shortdesc']);
					$content = strip_tags($record['longdesc']);
					$place = strip_tags($record['city']);
					$place .= ($record['city'] && $record['country']) ? ', ' . strip_tags($record['country'])
																	  : ' ' . strip_tags($record['country']);
					$fullContent = $title . "\n" . $abstract . "\n" . $content . "\n" .$place;
					$tags = ''; // oder '#camaliga#';
					$params = '&tx_camaliga_pi1[content]=' . $record['uid'];
					if ($dontSwitchContAct) {
						$params = '&tx_camaliga_pi1[action]=' . $actionForLinks . '&tx_camaliga_pi1[controller]=Content' . $params;
					}

                    // Additional information
                    $additionalFields = array(
                        'sortdate' => $record['crdate'],
                        'orig_uid' => $record['uid'],
                        'orig_pid' => $record['pid'],
                    );

                    // add something to the title, just to identify the entries
                    // in the frontend
                    $title = $indexerConfig['title'] . ': ' . $title;

                    // ... and store the information in the index
                    $indexerObject->storeInIndex(
                        $indexerConfig['storagepid'],   // storage PID
                        $title,                         // record title
                        $this->indexerConfigurationKey, // content type
                        $indexerConfig['targetpid'],    // target PID: where is the single view?
                        $fullContent,                   // indexed content, includes the title (linebreak after title)
                        $tags,                          // tags for faceted search
                        $params,                        // typolink params for singleview
                        $abstract,                      // abstract; shown in result list if not empty
                        $record['sys_language_uid'],    // language uid
                        $record['starttime'],           // starttime
                        $record['endtime'],             // endtime
                        $record['fe_group'],            // fe_group
                        false,                          // debug only?
                        $additionalFields               // additionalFields
                    );
                    $counter++;
            }

            $content =
                    '<p><b>Custom Indexer "'
                    . $indexerConfig['title'] . '":</b><br> ' . $counter
                    . ' camaliga-elements have been indexed.</p>';

            return $content;
        }
    }
}