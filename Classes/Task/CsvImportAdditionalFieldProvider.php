<?php
namespace Quizpalme\Camaliga\Task;

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\BackendWorkspaceRestriction;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Scheduler\AbstractAdditionalFieldProvider;
use TYPO3\CMS\Scheduler\Controller\SchedulerModuleController;
use TYPO3\CMS\Scheduler\Task\AbstractTask;
use TYPO3\CMS\Scheduler\Task\Enumeration\Action;
use TYPO3\CMS\Core\Messaging\FlashMessage;

class CsvImportAdditionalFieldProvider extends AbstractAdditionalFieldProvider
{
	/**
	 * Render additional information fields within the scheduler backend.
	 *
	 * @param array $taskInfo Array information of task to return
	 * @param ValidatorTask|null $task The task object being edited. Null when adding a task!
	 * @param SchedulerModuleController $schedulerModule Reference to the BE module of the Scheduler
	 * @return array Additional fields
	 * @see AdditionalFieldProviderInterface->getAdditionalFields($taskInfo, $task, $schedulerModule)
	 */
	public function getAdditionalFields(array &$taskInfo, $task, SchedulerModuleController $schedulerModule)
	{
		$additionalFields = array();
		$currentSchedulerModuleAction = $schedulerModule->getCurrentAction();
		
		if (empty($taskInfo['page'])) {
			if ($currentSchedulerModuleAction->equals(Action::ADD)) {
				$taskInfo['page'] = '';
			} else {
				$taskInfo['page'] = $task->getPage();
			}
		}
		if (empty($taskInfo['catpage'])) {
			if ($currentSchedulerModuleAction->equals(Action::ADD)) {
				$taskInfo['catpage'] = 0;
			} else {
				$taskInfo['catpage'] = $task->getCatPage();
			}
		}
		if (empty($taskInfo['language'])) {
			if ($currentSchedulerModuleAction->equals(Action::ADD)) {
				$taskInfo['language'] = '0';
			} else {
				$taskInfo['language'] = $task->getLanguage();
			}
		}
		if (empty($taskInfo['csvfile'])) {
			if ($currentSchedulerModuleAction->equals(Action::ADD)) {
				$taskInfo['csvfile'] = 'fileadmin/';
			} else {
				$taskInfo['csvfile'] = $task->getCsvfile();
			}
		}
		if (empty($taskInfo['fields'])) {
			if ($currentSchedulerModuleAction->equals(Action::ADD)) {
				$taskInfo['fields'] = '';
			} else {
				$taskInfo['fields'] = $task->getFields();
			}
		}
		if (empty($taskInfo['separator'])) {
			if ($currentSchedulerModuleAction->equals(Action::ADD)) {
				$taskInfo['separator'] = '"';
			} else {
				$taskInfo['separator'] = $task->getSeparator();
			}
		}
		if (empty($taskInfo['delimiter'])) {
			if ($currentSchedulerModuleAction->equals(Action::ADD)) {
				$taskInfo['delimiter'] = ';';
			} else {
				$taskInfo['delimiter'] = $task->getDelimiter();
			}
		}
		if (empty($taskInfo['catdelimiter'])) {
			if ($currentSchedulerModuleAction->equals(Action::ADD)) {
				$taskInfo['catdelimiter'] = ',';
			} else {
				$taskInfo['catdelimiter'] = $task->getCatdelimiter();
			}
		}
		if (empty($taskInfo['convert'])) {
			if ($currentSchedulerModuleAction->equals(Action::ADD)) {
				$taskInfo['convert'] = 0;
			} else {
				$taskInfo['convert'] = $task->getConvert();
			}
		}
		if (empty($taskInfo['delete'])) {
			if ($currentSchedulerModuleAction->equals(Action::ADD)) {
				$taskInfo['delete'] = 0;
			} else {
				$taskInfo['delete'] = $task->getDelete();
			}
		}
		if (empty($taskInfo['simulate'])) {
			if ($currentSchedulerModuleAction->equals(Action::ADD)) {
				$taskInfo['simulate'] = 0;
			} else {
				$taskInfo['simulate'] = $task->getSimulate();
			}
		}
		
		// Ordner
		$fieldId = 'task_page';
		$fieldCode = '<input type="text" name="tx_scheduler[camaliga][page]" id="' . $fieldId . '" value="' . htmlspecialchars($taskInfo['page']) . '"/>';
		$label = $GLOBALS['LANG']->sL('LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:tasks.validate.page');
		$label = BackendUtility::wrapInHelp('camaliga', $fieldId, $label);
		$additionalFields[$fieldId] = array(
				'code' => $fieldCode,
				'label' => $label
		);
		// cat-folder
		$fieldId = 'task_catpage';
		$checked = ($taskInfo['catpage']) ? ' checked="checked"' : '';
		$fieldCode = '<input type="checkbox" name="tx_scheduler[camaliga][catpage]" id="' . $fieldId . '" value="1"' . $checked . ' />';
		$label = $GLOBALS['LANG']->sL('LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:itasks.validate.catpage');
		$label = BackendUtility::wrapInHelp('camaliga', $fieldId, $label);
		$additionalFields[$fieldId] = array(
				'code' => $fieldCode,
				'label' => $label
		);
		// Sprache
		$fieldId = 'task_language';
		$fieldCode = '<input type="text" name="tx_scheduler[camaliga][language]" id="' . $fieldId . '" value="' . htmlspecialchars($taskInfo['language']) . '"/>';
		$label = $GLOBALS['LANG']->sL('LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:tasks.validate.language');
		$label = BackendUtility::wrapInHelp('camaliga', $fieldId, $label);
		$additionalFields[$fieldId] = array(
				'code' => $fieldCode,
				'label' => $label
		);
		// path to csv file
		$fieldId = 'task_csvfile';
		$fieldCode = '<input type="text" name="tx_scheduler[camaliga][csvfile]" id="' . $fieldId . '" value="' . htmlspecialchars($taskInfo['csvfile']) . '" size="50" />';
		$label = $GLOBALS['LANG']->sL('LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:itasks.validate.csvfile');
		$label = BackendUtility::wrapInHelp('camaliga', $fieldId, $label);
		$additionalFields[$fieldId] = array(
				'code' => $fieldCode,
				'label' => $label
		);
		// fields in the DB
		$fieldId = 'task_fields';
		$fieldCode = '<input type="text" name="tx_scheduler[camaliga][fields]" id="' . $fieldId . '" value="' . htmlspecialchars($taskInfo['fields']) . '" size="50" />';
		$label = $GLOBALS['LANG']->sL('LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:itasks.validate.fields');
		$label = BackendUtility::wrapInHelp('camaliga', $fieldId, $label);
		$additionalFields[$fieldId] = array(
				'code' => $fieldCode,
				'label' => $label
		);
		// separator
		$fieldId = 'task_separator';
		$fieldCode = '<input type="text" name="tx_scheduler[camaliga][separator]" id="' . $fieldId . '" value="' . htmlspecialchars($taskInfo['separator']) . '" size="5" />';
		$label = $GLOBALS['LANG']->sL('LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:tasks.validate.separator');
		$label = BackendUtility::wrapInHelp('camaliga', $fieldId, $label);
		$additionalFields[$fieldId] = array(
				'code' => $fieldCode,
				'label' => $label
		);
		// delimiter
		$fieldId = 'task_delimiter';
		$fieldCode = '<input type="text" name="tx_scheduler[camaliga][delimiter]" id="' . $fieldId . '" value="' . htmlspecialchars($taskInfo['delimiter']) . '" size="5" />';
		$label = $GLOBALS['LANG']->sL('LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:tasks.validate.delimiter');
		$label = BackendUtility::wrapInHelp('camaliga', $fieldId, $label);
		$additionalFields[$fieldId] = array(
				'code' => $fieldCode,
				'label' => $label
		);
		// catdelimiter
		$fieldId = 'task_catdelimiter';
		$fieldCode = '<input type="text" name="tx_scheduler[camaliga][catdelimiter]" id="' . $fieldId . '" value="' . htmlspecialchars($taskInfo['catdelimiter']) . '" size="5" />';
		$label = $GLOBALS['LANG']->sL('LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:tasks.validate.catdelimiter');
		$label = BackendUtility::wrapInHelp('camaliga', $fieldId, $label);
		$additionalFields[$fieldId] = array(
				'code' => $fieldCode,
				'label' => $label
		);
		// convert
		$fieldId = 'task_convert';
		$checked = ($taskInfo['convert']) ? ' checked="checked"' : '';
		$fieldCode = '<input type="checkbox" name="tx_scheduler[camaliga][convert]" id="' . $fieldId . '" value="1"' . $checked . ' />';
		$label = $GLOBALS['LANG']->sL('LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:itasks.validate.convert');
		$label = BackendUtility::wrapInHelp('camaliga', $fieldId, $label);
		$additionalFields[$fieldId] = array(
				'code' => $fieldCode,
				'label' => $label
		);
		// delete
		$fieldId = 'task_delete';
		$checked = ($taskInfo['delete']) ? ' checked="checked"' : '';
		$fieldCode = '<input type="checkbox" name="tx_scheduler[camaliga][delete]" id="' . $fieldId . '" value="1"' . $checked . ' />';
		$label = $GLOBALS['LANG']->sL('LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:itasks.validate.delete');
		$label = BackendUtility::wrapInHelp('camaliga', $fieldId, $label);
		$additionalFields[$fieldId] = array(
				'code' => $fieldCode,
				'label' => $label
		);
		// simulate
		$fieldId = 'task_simulate';
		$checked = ($taskInfo['simulate']) ? ' checked="checked"' : '';
		$fieldCode = '<input type="checkbox" name="tx_scheduler[camaliga][simulate]" id="' . $fieldId . '" value="1"' . $checked . ' />';
		$label = $GLOBALS['LANG']->sL('LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:itasks.validate.simulate');
		$label = BackendUtility::wrapInHelp('camaliga', $fieldId, $label);
		$additionalFields[$fieldId] = array(
				'code' => $fieldCode,
				'label' => $label
		);
		return $additionalFields;
	}
	
	/**
	 * This method checks any additional data that is relevant to the specific task.
	 * If the task class is not relevant, the method is expected to return TRUE.
	 *
	 * @param array $submittedData Reference to the array containing the data submitted by the user
	 * @param SchedulerModuleController $schedulerModule Reference to the BE module of the Scheduler
	 * @return bool TRUE if validation was ok (or selected class is not relevant), FALSE otherwise
	 */
	public function validateAdditionalFields(array &$submittedData, SchedulerModuleController $schedulerModule)
	{
		$isValid = TRUE;
		if ($submittedData['camaliga']['page'] > 0) {
			$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('pages');
			$count = $queryBuilder
			->count('uid')
			->from('pages')
			->where(
				$queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter((int)$submittedData['camaliga']['page'], \PDO::PARAM_INT))
			)
			->execute()
			->fetchColumn(0);
			if ($count == 0) {
				$isValid = FALSE;
				$this->addMessage(
					$GLOBALS['LANG']->sL('LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:tasks.validate.invalidPage'),
					FlashMessage::ERROR
				);
			}
		} else {
			$isValid = FALSE;
			$this->addMessage(
				$GLOBALS['LANG']->sL('LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:tasks.validate.invalidPage'),
				FlashMessage::ERROR
			);
		}
		$lang = (int)$submittedData['camaliga']['language'];
		if ($lang > 0) {
			$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_language');
			$count = $queryBuilder
			->count('uid')
			->from('sys_language')
			->where(
				$queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($lang, \PDO::PARAM_INT))
			)
			->execute()
			->fetchColumn(0);
			if ($count == 0) {
				$isValid = FALSE;
				$this->addMessage(
					$GLOBALS['LANG']->sL('LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:tasks.validate.invalidLanguage'),
					FlashMessage::ERROR
				);
			}
		}
		if (substr($submittedData['camaliga']['csvfile'],0,10) != 'fileadmin/') {
			$isValid = FALSE;
			$this->addMessage(
				$GLOBALS['LANG']->sL('LLL:EXT:camaliga/Resources/Private/Language/locallang_be.xlf:tasks.validate.invalidCsvfile'),
				FlashMessage::ERROR
			);
		}
		return $isValid;
	}
	
	/**
	 * This method is used to save any additional input into the current task object
	 * if the task class matches.
	 *
	 * @param array $submittedData Array containing the data submitted by the user
	 * @param AbstractTask $task Reference to the current task object
	 */
	public function saveAdditionalFields(array $submittedData, AbstractTask $task)
	{
		/** @var $task ValidatorTask */
		$task->setCsvfile($submittedData['camaliga']['csvfile']);
		//$task->setHeader($submittedData['camaliga']['header']);
		$task->setFields($submittedData['camaliga']['fields']);
		$task->setPage($submittedData['camaliga']['page']);
		$task->setCatPage($submittedData['camaliga']['catpage']);
		$task->setLanguage($submittedData['camaliga']['language']);
		$task->setSeparator($submittedData['camaliga']['separator']);
		$task->setDelimiter($submittedData['camaliga']['delimiter']);
		$task->setCatdelimiter($submittedData['camaliga']['catdelimiter']);
		$task->setConvert($submittedData['camaliga']['convert']);
		$task->setDelete($submittedData['camaliga']['delete']);
		$task->setSimulate($submittedData['camaliga']['simulate']);
	}
}