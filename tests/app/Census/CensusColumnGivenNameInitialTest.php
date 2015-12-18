<?php

/**
 * webtrees: online genealogy
 * Copyright (C) 2015 webtrees development team
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */
namespace Fisharebest\Webtrees\Census;

use Fisharebest\Webtrees\Individual;
use Mockery;

/**
 * Test harness for the class CensusColumnGivenNameInitial
 */
class CensusColumnGivenNameInitialTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Delete mock objects
	 */
	public function tearDown() {
		Mockery::close();
	}

	/**
	 * @covers Fisharebest\Webtrees\Census\CensusColumnGivenNameInitial
	 * @covers Fisharebest\Webtrees\Census\AbstractCensusColumn
	 */
	public function testOneGivenName() {
		$individual = Mockery::mock(Individual::class);
		$individual->shouldReceive('getAllNames')->andReturn(array(array('givn' => 'Joe')));

		$census = Mockery::mock(CensusInterface::class);

		$column = new CensusColumnGivenNameInitial($census, '', '');

		$this->assertSame('Joe', $column->generate($individual));
	}

	/**
	 * @covers Fisharebest\Webtrees\Census\CensusColumnGivenNameInitial
	 * @covers Fisharebest\Webtrees\Census\AbstractCensusColumn
	 */
	public function testMultipleGivenNames() {
		$individual = Mockery::mock(Individual::class);
		$individual->shouldReceive('getAllNames')->andReturn(array(array('givn' => 'Joe Fred')));

		$census = Mockery::mock(CensusInterface::class);

		$column = new CensusColumnGivenNameInitial($census, '', '');

		$this->assertSame('Joe F', $column->generate($individual));
	}

	/**
	 * @covers Fisharebest\Webtrees\Census\CensusColumnGivenNameInitial
	 * @covers Fisharebest\Webtrees\Census\AbstractCensusColumn
	 */
	public function testNoName() {
		$individual = Mockery::mock(Individual::class);
		$individual->shouldReceive('getAllNames')->andReturn(array());

		$census = Mockery::mock(CensusInterface::class);

		$column = new CensusColumnGivenNameInitial($census, '', '');

		$this->assertSame('', $column->generate($individual));
	}
}
