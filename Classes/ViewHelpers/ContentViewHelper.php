<?php
namespace Quizpalme\Camaliga\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

/**
 * Content-ViewHelper
 * {namespace cam=Quizpalme\Camaliga\ViewHelpers}
 * <cam:content param="nicecontent"></cam:content>
 * A ViewHelper for the camaliga-content
 *
 * @package camaliga
 */
class ContentViewHelper extends AbstractTagBasedViewHelper
{
	/**
	 * As this ViewHelper renders HTML, the output must not be escaped.
	 *
	 * @var bool
	 */
	protected $escapeOutput = false;
	
	/**
	 * contentRepository
	 *
	 * @TYPO3\CMS\Extbase\Annotation\Inject
	 * @var \Quizpalme\Camaliga\Domain\Repository\ContentRepository
	 */
	protected $contentRepository = NULL;
	
	public function initializeArguments()
	{
		parent::initializeArguments();
		//$this->registerUniversalTagAttributes();
		$this->registerArgument('param', 'string', 'Parameter of the tag');
	}
	
	/**
	 * Content-ViewHelper
	 *
	 * @return string $result
	 */
	public function render()
	{
	    if ($_GET['tx_camaliga_pi1'])
	        $camaligaArray = $_GET['tx_camaliga_pi1'];
	    else if ($_POST['tx_camaliga_pi1'])
	    	$camaligaArray = $_POST['tx_camaliga_pi1'];
	    else
	    	$camaligaArray = array();
	    $uid = intval($camaligaArray['content']);
	    //$lang = intval($_GET['L']);
        $row = [];
        if ($uid > 0) {
        	//$contentRepository = $this->objectManager->get('Quizpalme\\Camaliga\\Domain\\Repository\\ConentRepository');
            $entry = $this->contentRepository->findOneByUid2($uid);
            if ($entry && $entry->getUid()) {
            	$row['camaliga_title'] = $entry->getTitle();
                $row['camaliga_shortdesc'] = $entry->getShortdesc();
                $row['camaliga_link'] = $entry->getLink();
                $row['camaliga_image'] = $entry->getImage();
                $row['camaliga_street'] = $entry->getStreet();
                $row['camaliga_zip'] = $entry->getZip();
                $row['camaliga_city'] = $entry->getCity();
                $row['camaliga_country'] = $entry->getCountry();
                $row['camaliga_person'] = $entry->getPerson();
                $row['camaliga_phone'] = $entry->getPhone();
                $row['camaliga_mobile'] = $entry->getMobile();
                $row['camaliga_email'] = $entry->getEmail();
                $row['camaliga_latitude'] = $entry->getLatitude();
                $row['camaliga_longitude'] = $entry->getLongitude();
                $row['camaliga_custom1'] = $entry->getCustom1();
                $row['camaliga_custom2'] = $entry->getCustom2();
                $row['camaliga_custom3'] = $entry->getCustom3();
			}
		}
		return str_replace(
			array_keys($row),
			array_values($row),
			$this->arguments['param']
		);
	}
}
?>