<?php
namespace Quizpalme\Camaliga\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Quizpalme\Camaliga\Domain\Repository\ContentRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Backend\Template\ModuleTemplate;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Core\Localization\LanguageService;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2021 Kurt Gusbeth <info@quizpalme.de>
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
 *
 *
 * @package camaliga
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class BackendController extends ActionController
{

    protected int $id;

    protected ModuleTemplate $moduleTemplate;

	/**
  * contentRepository
  *
  * @var ContentRepository
  */
 protected $contentRepository;

    public function __construct(
        protected readonly ModuleTemplateFactory $moduleTemplateFactory,
    ) {
    }

    public function initializeAction(): void
    {
        $this->id = (int)($this->request->getQueryParams()['id'] ?? 0);
        $this->moduleTemplate = $this->moduleTemplateFactory->create($this->request);
    }

    /**
     * Injects the content-Repository
     */
    public function injectContentRepository(ContentRepository $contentRepository)
    {
        $this->contentRepository = $contentRepository;
    }

    /**
	 * Ordner-ID
	 *
	 * @return integer
	 */
	protected function getCurrentPageId()
	{
		$pageId = (integer) GeneralUtility::_GP('id');
		if ($pageId > 0) {
		  return $pageId;
		}
		// get a site root
		return (integer) $this->contentRepository->getSiteRoot();
	}


	/**
	 * action thumb
	 *
	 * @return ResponseInterface
	 */
	public function thumbAction(): ResponseInterface
	{
		$pid = intval($this->getCurrentPageId());
		$saved = 0;
		
		// save new order first
		if ($this->request->hasArgument('camelements')) {
			$order = $this->request->getArgument('camelements');
			if (is_array($order)) {
				foreach ($order as $key => $value) {
					if ($key > 0 && $value > 0) {
						$this->contentRepository->setNewSorting($key, $value);
						$saved = 1;
					}
				}
			}
		}
		// Elemente sortiert holen
		$contents = $this->contentRepository->findAll('sorting', 'asc', false, [$pid]);
		
		$this->view->assign('pid', $pid);
		$this->view->assign('saved', $saved);
		$this->view->assign('contents', $contents);
        $this->moduleTemplate->setContent($this->view->render());
        return $this->htmlResponse($this->moduleTemplate->renderContent());
	}
}
