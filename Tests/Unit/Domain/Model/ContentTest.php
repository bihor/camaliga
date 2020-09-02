<?php

namespace Quizpalme\Camaliga\Tests;

use Quizpalme\Camaliga\Domain\Model\Content;
use PHPUnit\Framework\TestCase;

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
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \quizpalme\Camaliga\Domain\Model\Content.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Camaliga
 *
 * @author Kurt Gusbeth <info@quizpalme.de>
 */
class ContentTest extends TestCase
{
	/**
	 * @var Content
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Content();
		
		static::assertInstanceOf(Content::class, $this->fixture);
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() { 
		$this->fixture->setTitle('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getTitle()
		);
	}
	
	/**
	 * @test
	 */
	public function setTitleForStringSetsTitleWithNl() {
		$this->fixture->setTitle("Conceived at\nT3CON10");
		
		$this->assertSame(
			'Conceived at<br />T3CON10',
			$this->fixture->getTitleNl2br()
		);
	}
	
	/**
	 * @test
	 */
	public function getShortdescReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setShortdescForStringSetsShortdesc() { 
		$this->fixture->setShortdesc('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getShortdesc()
		);
	}
	
	/**
	 * @test
	 */
	public function setShortdescForStringSetsShortdescWithNl() {
		$this->fixture->setShortdesc("Conceived at\r\nT3CON10");
		
		$this->assertSame(
			'Conceived at<br />T3CON10',
			$this->fixture->getShortdescNl2br()
		);
	}
	
	/**
	 * @test
	 */
	public function getLongdescReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setLongdescForStringSetsLongdesc() { 
		$this->fixture->setLongdesc('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getLongdesc()
		);
	}
	
	/**
	 * @test
	 */
	public function setLongdescForStringSetsLongdescWithNl() {
		$this->fixture->setLongdesc("Conceived at\rT3CON10");
		
		$this->assertSame(
			'Conceived at<br />T3CON10',
			$this->fixture->getLongdescNl2br()
		);
	}
	
	/**
	 * @test
	 */
	public function getLinkReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setLinkForStringSetsLink() { 
		$this->fixture->setLink('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getLink()
		);
	}
	
	/**
	 * test schlägt fehl, da kein default-value vorhanden ist?
	 */
	public function getLatitudeReturnsInitialValueForFloat() { 
		$this->assertSame(
			0.0,
			$this->fixture->getLatitude()
		);
	}

	/**
	 * @test
	 */
	public function setLatitudeForFloatSetsLatitude() { 
		$this->fixture->setLatitude(3.14159265);

		$this->assertSame(
			3.14159265,
			$this->fixture->getLatitude()
		);
	}
	
	/**
	 * test schlägt fehl, da kein default-value vorhanden ist?
	 */
	public function getLongitudeReturnsInitialValueForFloat() { 
		$this->assertSame(
			0.0,
			$this->fixture->getLongitude()
		);
	}

	/**
	 * @test
	 */
	public function setLongitudeForFloatSetsLongitude() { 
		$this->fixture->setLongitude(3.14159265);

		$this->assertSame(
			3.14159265,
			$this->fixture->getLongitude()
		);
	}
	
	/**
	 * @test
	 */
	public function getCustom1ReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setCustom1ForStringSetsCustom1() { 
		$this->fixture->setCustom1('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getCustom1()
		);
	}
	
	/**
	 * @test
	 */
	public function getCustom2ReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setCustom2ForStringSetsCustom2() { 
		$this->fixture->setCustom2('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getCustom2()
		);
	}
	
	/**
	 * @test
	 */
	public function getCustom3ReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setCustom3ForStringSetsCustom3() { 
		$this->fixture->setCustom3('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getCustom3()
		);
	}
	
}
?>