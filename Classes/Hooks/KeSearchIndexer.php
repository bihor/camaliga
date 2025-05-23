<?php
// set you own vendor name adjust the extension name part of the namespace to your extension key
namespace Quizpalme\Camaliga\Hooks;

use Tpwd\KeSearch\Indexer\IndexerBase;
use Tpwd\KeSearch\Indexer\IndexerRunner;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Database\Query\Restriction\HiddenRestriction;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;

// set you own class name
class KeSearchIndexer extends IndexerBase
{
    // Set a key for your indexer configuration.
    // Add this in Configuration/TCA/Overrides/tx_kesearch_indexerconfig.php, too!
    public const KEY = 'camaliga';

    /**
     * Adds the custom indexer to the TCA of indexer configurations, so that
     * it's selectable in the backend as an indexer type when you create a
     * new indexer configuration.
     *
     * @param array $params
     * @param type $pObj
     */
    public function registerIndexerConfiguration(&$params, $pObj): void
    {
        // Set a name and an icon for your indexer.
        $customIndexer = [
            'Camaliga elements (ext:camaliga)',
            KeSearchIndexer::KEY,
            'EXT:camaliga/Resources/Public/Icons/Extension.gif'
        ];
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
    public function customIndexer(array &$indexerConfig, IndexerRunner &$indexerObject): string
    {
        if ($indexerConfig['type'] == KeSearchIndexer::KEY) {
            $counter = 0;
            $table = 'tx_camaliga_domain_model_content';
            $dontSwitchContAct = (bool)GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('camaliga', 'dontSwitchContAct');
            $actionForLinks = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('camaliga', 'actionForLinks');
            if (!$actionForLinks) {
            	$actionForLinks = 'show';
            }
            $pluginForLinks = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('camaliga', 'pluginForLinks');
            if (!$pluginForLinks) {
                $pluginForLinks = 'show';
            }

            if (!isset($indexerConfig['sysfolder'])|| empty($indexerConfig['sysfolder'])) {
                throw new \Exception('No folder specified. Please set the folder which should be indexed in the indexer configuration!', 8587085735);
            }

            // Doctrine DBAL using Connection Pool.
            /** @var Connection $connection */
            $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable($table);
            $queryBuilder = $connection->createQueryBuilder();

            // Handle restrictions.
            // Don't fetch hidden or deleted elements, but the elements
            // with frontend user group access restrictions or time (start / stop)
            // restrictions in order to copy those restrictions to the index.
            $queryBuilder
                ->getRestrictions()
                ->removeAll()
                ->add(GeneralUtility::makeInstance(DeletedRestriction::class))
                ->add(GeneralUtility::makeInstance(HiddenRestriction::class));

            $folders = GeneralUtility::trimExplode(',', htmlentities((string) $indexerConfig['sysfolder']));
            $statement = $queryBuilder
                ->select('*')
                ->from($table)
                ->where($queryBuilder->expr()->in( 'pid', $folders))
                ->executeQuery();

            // Loop through the records and write them to the index.
            while ($record = $statement->fetchAssociative()) {
                    // compile the information which should go into the index
                    // the field names depend on the table you want to index!
                    $title = strip_tags((string) $record['title']);
					$abstract = strip_tags((string) $record['shortdesc']);
					$content = strip_tags((string) $record['longdesc']);
					$place = strip_tags((string) $record['city']);
					$place .= ($record['city'] && $record['country']) ? ', ' . strip_tags((string) $record['country'])
																	  : ' ' . strip_tags((string) $record['country']);
					$fullContent = $title . "\n" . $abstract . "\n" . $content . "\n" .$place;
					$tags = ''; // oder '#camaliga#';
					$params = '&tx_camaliga_' . $pluginForLinks . '[content]=' . $record['uid'];
					if ($dontSwitchContAct) {
						$params = '&tx_camaliga_' . $pluginForLinks . '[action]=' . $actionForLinks . '&tx_camaliga_' . $pluginForLinks . '[controller]=Content' . $params;
					}

                    // Additional information
                    $additionalFields = ['sortdate' => $record['crdate'], 'orig_uid' => $record['uid'], 'orig_pid' => $record['pid']];

                    // add something to the title, just to identify the entries
                    // in the frontend
                    $title = $indexerConfig['title'] . ': ' . $title;

                    // ... and store the information in the index
                    $indexerObject->storeInIndex(
                        $indexerConfig['storagepid'],   // storage PID
                        $title,                         // record title
                        KeSearchIndexer::KEY,           // content type
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
        return '';
    }
}