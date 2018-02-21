<?php
namespace Quizpalme\Camaliga\ViewHelpers;
/**
 * Content-ViewHelper
 * {namespace cam=Quizpalme\Camaliga\ViewHelpers}
 * <cam:content param="nicecontent"></cam:content>
 * A ViewHelper for the camaliga-content
 *
 * @package camaliga
 */
class ContentViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
    /**
     * Content-ViewHelper
     * 
     * @param string $param
     * @return string $result
     */
	public function render($param) {
		if ($_GET['tx_camaliga_pi1'])
			$camaligaArray = $_GET['tx_camaliga_pi1'];
		else if ($_POST['tx_camaliga_pi1'])
			$camaligaArray = $_POST['tx_camaliga_pi1'];
		else
			$camaligaArray = array();
		$uid = intval($camaligaArray['content']);
		$lang = intval($_GET['L']);
		$row = array();
		if ($uid > 0) {
			$res4 = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
					'title as camaliga_title, shortdesc AS camaliga_shortdesc, link AS camaliga_link, image AS camaliga_image, 
street AS camaliga_street, zip AS camaliga_zip, city AS camaliga_city, country AS camaliga_country, person AS camaliga_person, phone AS camaliga_phone, mobile AS camaliga_mobile, email AS camaliga_email,
latitude AS camaliga_latitude, longitude AS camaliga_longitude, custom1 AS camaliga_custom1, custom2 AS camaliga_custom_2, custom3 AS camaliga_custom3',
					'tx_camaliga_domain_model_content',
					'deleted=0 AND hidden=0 AND sys_language_uid IN (-1, ' . $lang . ') AND uid=' . $uid);
			if ($GLOBALS['TYPO3_DB']->sql_num_rows($res4) > 0) {
				$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res4);
			}
			$GLOBALS['TYPO3_DB']->sql_free_result($res4);
     	}
     	$result = str_replace(
     			array_keys($row),
     			array_values($row),
     			$param
     	);
		return $result;
		//return $this->renderChildren();
	}
}
?>