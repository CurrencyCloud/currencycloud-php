<?php
namespace CurrencyCloud\Model;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

class Authorisations implements IteratorAggregate, Countable {

    /**
     * @var Authorisation[]
     */
    private $authorisations;

    /**
     * Authorisations constructor.
     * @param Authorisation[] $authorisations
     */
    public function __construct(array $authorisations)
    {
        $this->authorisations = $authorisations;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->authorisations);
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->authorisations);
    }
}