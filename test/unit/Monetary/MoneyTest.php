<?php
/**
 * File of the Money test file
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * PHP version 5.3
 *
 * @category   Masthowasli
 * @package    ValueObject
 * @subpackage Test
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @copyright  2015 - Thomas Sliwa
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */

namespace Masthowasli\ValueObject\Test\Monetary;

use Masthowasli\ValueObject\Monetary\Money;
use Masthowasli\ValueObject\Monetary\Currency;
use Masthowasli\ValueObject\Monetary\Currency\Eur;
use Masthowasli\ValueObject\Number\Integer;

/**
 * Tests the Money value object
 *
 * @category   Masthowasli
 * @package    ValueObject
 * @subpackage Test
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */
class MoneyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Money
     */
    private $money;

    protected function setup()
    {
        $this->money = new Money(new Integer(500), new Eur());
    }

    public function testEqualsReturnsTrue()
    {
        $this->assertTrue($this->money->equals(new Money(new Integer(500), new Eur())));
    }

    public function testEqualsReturnsFalseForNonMoneyArgument()
    {
        $mock = $this->getMock('Masthowasli\ValueObject\Equatable');

        $this->assertFalse($this->money->equals($mock));
    }

    public function testEqualsReturnsFalseForDiffentCurrencies()
    {
        $mock = $this->getMock('Masthowasli\ValueObject\Monetary\Currency');

        $this->assertFalse($this->money->equals(new Money(new Integer(500), $mock)));
    }

    public function testEqualsReturnsFalseForDifferentvalues()
    {
        $this->assertFalse($this->money->equals(new Money(new Integer(100), new Eur())));
    }

    public function testCompareToReturnsNegativeForLargerArgumentValue()
    {
        $this->assertLessThan(0, $this->money->compareTo(new Money(new Integer(1000), new Eur())));
    }

    public function testCompareToReturnsPositiveForSmallerArgumentValue()
    {
        $this->assertGreaterThan(0, $this->money->compareTo(new Money(new Integer(100), new Eur())));
    }

    public function testCompareToReturnsZoreForEqualArgumentValue()
    {
        $this->assertEquals(0, $this->money->compareTo(new Money(new Integer(500), new Eur())));
    }

    public function testCompareToThrowsAnExceptionForNonMoneyComparableInstance()
    {
        $mock = $this->getMock('Masthowasli\ValueObject\Comparable');
        $this->setExpectedException('\InvalidArgumentException');
        $this->assertEquals(0, $this->money->compareTo($mock));
    }

    public function testAddSuccess()
    {
        $this->assertEquals(new Money(new Integer(1000), new Eur()), $this->money->add($this->money));
    }

    public function testAddThrowsAnInvalidArgumentExceptionForDifferentCurrencies()
    {
        $this->setExpectedException('\InvalidArgumentException');
        $mock = $this->getMock('Masthowasli\ValueObject\Monetary\Currency');

        $this->money->add(new Money(new Integer(500), $mock));
    }
}
