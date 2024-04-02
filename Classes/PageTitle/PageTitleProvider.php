<?php
namespace Quizpalme\Camaliga\PageTitle;

use TYPO3\CMS\Core\PageTitle\AbstractPageTitleProvider;

class PageTitleProvider extends AbstractPageTitleProvider
{
    public function setTitle(string $title)
    {
        $this->title = $title;
    }
}