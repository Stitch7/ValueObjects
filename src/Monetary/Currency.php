<?php
/**
 * File of the abstract Currency class
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * PHP version 5.3.3
 *
 * @category   Masthowasli
 * @package    ValueObjects
 * @subpackage Monetary
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @copyright  2015 - Thomas Sliwa
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */

namespace Masthowasli\ValueObject\Monetary;

use Masthowasli\ValueObject\Equatable;

/**
 * Class to define an abstract currency value
 *
 * @category   Masthowasli
 * @package    ValueObjects
 * @subpackage Monetary
 * @author     Thomas Sliwa <ts@unfinished.dyndns.org>
 * @license    http://opensource.org/licenses/MIT MIT
 * @link       https://github.com/masthowasli/ValueObjects
 */
abstract class Currency implements Equatable
{
    /**
     * @var string The ISO 4217 code
     */
    protected $iso4217;
    /**
     * @var string The currency symbol
     */
    protected $symbol;

    /**
     * Instance of a new Currency is created
     *
     * The implementing class is responsible to set the properties
     */
    public function __construct()
    {
    }

    /**
     * Whether the instance equals the given instance
     *
     * A type check must be performed in an implementing class
     *
     * @param Equatable $valueObject The instance to check against
     *
     * @return boolean Whether the two instances are equal
     */
    public function equals(Equatable $valueObject)
    {
        return $valueObject instanceof static;
    }

    public function __toString()
    {
        return $this->symbol;
    }
}
