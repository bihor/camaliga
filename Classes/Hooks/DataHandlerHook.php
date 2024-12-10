<?php
namespace Quizpalme\Camaliga\Hooks;
/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use Quizpalme\Camaliga\Utility\HelpersUtility;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

class DataHandlerHook {


    /**
     * Pre command map hook
     *
     * @param string|int $id (id could be string, for this reason no type hint)
     */
    public function processDatamap_preProcessFieldArray(array &$incomingFieldArray, string $table, $id, DataHandler $dataHandler): void
    {
        if ($table == 'tx_camaliga_domain_model_content') {
            $configurationUtility = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('camaliga');
            // dies hier greift bei neuen Einträgen
            if ((bool)$configurationUtility['searchCoordinatesInBE']) {
                if (isset($incomingFieldArray['city']) && $incomingFieldArray['city'] &&
                    (!isset($incomingFieldArray['latitude']) || !floatval($incomingFieldArray['latitude'])) &&
                    (!isset($incomingFieldArray['longitude']) || !floatval($incomingFieldArray['longitude']))) {
                    $coordinates = GeneralUtility::makeInstance(HelpersUtility::class)->getLatLonOfAddress($incomingFieldArray['street'], $incomingFieldArray['zip'], $incomingFieldArray['city'], $incomingFieldArray['country'], 2, '');
                    if ($coordinates['latitude'] || $coordinates['longitude']) {
                        $incomingFieldArray['latitude'] = sprintf('%01.9f', $coordinates['latitude']);
                        $incomingFieldArray['longitude'] = sprintf('%01.9f', $coordinates['longitude']);
                    }
                }
            }
        }
    }

    /**
     * Post hook
     *
     */
    public function processDatamap_postProcessFieldArray(string $status, string $table, $id, array $fieldArray, DataHandler $dataHandler): void
    {
        if ($table == 'tx_camaliga_domain_model_content' && is_numeric($id)) {
            $configurationUtility = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('camaliga');
            if ((bool)$configurationUtility['searchCoordinatesInBE']) {
                $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
                $city = '';
                $latitude = $longitude = 0;
                if ($fieldArray['street'] && $fieldArray['zip'] && $fieldArray['city']) {
                    $street = $fieldArray['street'];
                    $zip = $fieldArray['zip'];
                    $city = $fieldArray['city'];
                    $country = $fieldArray['country'];
                    $latitude = floatval($fieldArray['latitude']);
                    $longitude = floatval($fieldArray['longitude']);
                } else {
                    // in $fieldArray sind die Werte nur drin, wenn sie verändert wurden, deshalb machen wir ein select
                    // funktioniert nur, wenn Latitude und Longitude nicht eben auf 0 gesetzt wurden
                    $statement = $queryBuilder
                        ->select('street', 'city', 'zip', 'country', 'latitude', 'longitude')
                        ->from($table)
                        ->where($queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($id, \TYPO3\CMS\Core\Database\Connection::PARAM_INT)))
                        ->executeQuery();
                    while ($row = $statement->fetchAssociative()) {
                        $street = $row['street'];
                        $zip = $row['zip'];
                        $city = $row['city'];
                        $country = $row['country'];
                        $latitude = floatval($row['latitude']);
                        $longitude = floatval($row['longitude']);
                    }
                }
                if ($city && !$latitude && !$longitude) {
                    //$helpersUtility = GeneralUtility::makeInstance("Quizpalme\\Camaliga\\Utility\\HelpersUtility");
                    $coordinates = GeneralUtility::makeInstance(HelpersUtility::class)->getLatLonOfAddress($street, $zip, $city, $country, 2, '');
                    if ($coordinates['latitude'] || $coordinates['longitude']) {
                        $queryBuilder
                            ->update($table)
                            ->where($queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($id, \TYPO3\CMS\Core\Database\Connection::PARAM_INT)))
                            ->set('latitude', (float)$coordinates['latitude'])
                            ->set('longitude', (float)$coordinates['longitude'])
                            //    ->set('custom3', 'DEBUG1: ' . $ccordinates['debug'])
                            ->executeStatement();
                    }
                }
            }
        }
    }
}