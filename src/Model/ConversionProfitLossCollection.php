<?php
namespace CurrencyCloud\Model;

class ConversionProfitLossCollection extends PaginatedData {

    /**
     * @var ConversionProfitLoss[]
     */
    private $conversionsProfitLoss;

    /**
     * @param ConversionProfitLoss[] $conversionsProfitLoss
     * @param Pagination $pagination
     */
    public function __construct(array $conversionsProfitLoss, Pagination $pagination)
    {
        parent::__construct($pagination);
        $this->conversionsProfitLoss = $conversionsProfitLoss;
    }

    /**
     * @return ConversionProfitLoss[]
     */
    public function getConversionsProfitLoss()
    {
        return $this->conversionsProfitLoss;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->conversionsProfitLoss);
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->conversionsProfitLoss);
    }
}