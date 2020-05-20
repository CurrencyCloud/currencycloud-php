<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Criteria\ConversionProfitLossCriteria;
use CurrencyCloud\Criteria\FindConversionsCriteria;
use CurrencyCloud\Model\Conversion;
use CurrencyCloud\Model\ConversionCancellationQuote;
use CurrencyCloud\Model\ConversionDateChanged;
use CurrencyCloud\Model\CancelledConversion;
use CurrencyCloud\Model\ConversionDateChangeQuote;
use CurrencyCloud\Model\ConversionPreview;
use CurrencyCloud\Model\ConversionProfitLoss;
use CurrencyCloud\Model\ConversionSplit;
use CurrencyCloud\Model\Conversions;
use CurrencyCloud\Model\ConversionProfitLossCollection;
use CurrencyCloud\Model\ConversionSplitHistory;
use CurrencyCloud\Model\ConversionSplitPreview;
use CurrencyCloud\Model\Pagination;
use DateTime;
use stdClass;

class ConversionsEntryPoint extends AbstractEntryPoint
{

    /**
     * @param Conversion $conversion
     * @param string $amount
     * @param string $reason
     * @param boolean $termAgreement
     * @param null|string $onBehalfOf
     *
     * @return Conversion
     */
    public function create(
        Conversion $conversion,
        $amount,
        $reason,
        $termAgreement,
        $onBehalfOf = null
    )
    {
        $conversionDate = $conversion->getConversionDate();
        $response = $this->request(
            'POST',
            'conversions/create',
            [],
            [
                'buy_currency' => $conversion->getBuyCurrency(),
                'sell_currency' => $conversion->getSellCurrency(),
                'fixed_side' => $conversion->getFixedSide(),
                'amount' => $amount,
                'reason' => $reason,
                'term_agreement' => $termAgreement ? "true" : "false",
                'conversion_date' => (null === $conversionDate) ? null : $conversionDate->format(DateTime::RFC3339),
                'client_buy_amount' => $conversion->getClientBuyAmount(),
                'client_sell_amount' => $conversion->getClientSellAmount(),
                'unique_request_id' => $conversion->getUniqueRequestId(),
                'on_behalf_of' => $onBehalfOf,
                'conversion_date_preference' => $conversion->getConversionDatePreference()
            ]
        );

        return $this->createConversionFromResponse($response);
    }

    /**
     * @param stdClass $response
     *
     * @return Conversion
     */
    private function createConversionFromResponse(stdClass $response)
    {
        $conversion = new Conversion();
        $conversion->setAccountId($response->account_id)
            ->setCreatorContactId($response->creator_contact_id)
            ->setShortReference($response->short_reference)
            ->setSettlementDate(new DateTime($response->settlement_date))
            ->setConversionDate(new DateTime($response->conversion_date))
            ->setStatus($response->status)
            ->setPartnerStatus($response->partner_status)
            ->setCurrencyPair($response->currency_pair)
            ->setBuyCurrency($response->buy_currency)
            ->setSellCurrency($response->sell_currency)
            ->setFixedSide($response->fixed_side)
            ->setPartnerBuyAmount($response->partner_buy_amount)
            ->setPartnerSellAmount($response->partner_sell_amount)
            ->setClientBuyAmount($response->client_buy_amount)
            ->setClientSellAmount($response->client_sell_amount)
            ->setMidMarketRate($response->mid_market_rate)
            ->setCoreRate($response->core_rate)
            ->setPartnerRate($response->partner_rate)
            ->setClientRate($response->client_rate)
            ->setDepositRequired($response->deposit_required)
            ->setDepositAmount($response->deposit_amount)
            ->setDepositCurrency($response->deposit_currency)
            ->setDepositStatus($response->deposit_status)
            ->setDepositRequiredAt(new DateTime($response->deposit_required_at))
            ->setPaymentIds($response->payment_ids)
            ->setCreatedAt(new DateTime($response->created_at))
            ->setUpdatedAt(new DateTime($response->updated_at))
            ->setUniqueRequestId($response->unique_request_id);

        $this->setIdProperty($conversion, $response->id);

        return $conversion;
    }

    /**
     * @param stdClass $response
     *
     * @return CancelledConversion
     */
    private function createConversionCancellationFromResponse(stdClass $response)
    {
        $conversionCancellation = new CancelledConversion();
        $conversionCancellation->setAccountId($response->account_id)
            ->setContactId($response->contact_id)
            ->setEventAccountId($response->event_account_id)
            ->setEventContactId($response->event_contact_id)
            ->setConversionId($response->conversion_id)
            ->setEventType($response->event_type)
            ->setAmount($response->amount)
            ->setCurrency($response->currency)
            ->setNotes($response->notes)
            ->setEventDateTime(new DateTime($response->event_date_time));

        return $conversionCancellation;
    }

    /**
     * @param stdClass $response
     *
     * @return ConversionDateChanged
     */
    private function createConversionDateChangeFromResponse(stdClass $response)
    {

        $conversionDateChanged = new ConversionDateChanged();
        $conversionDateChanged->setConversionId($response->conversion_id)
            ->setAmount($response->amount)
            ->setCurrency($response->currency)
            ->setNewConversionDate($response->new_conversion_date)
            ->setNewSettlementDate($response->new_settlement_date)
            ->setOldConversionDate($response->old_conversion_date)
            ->setOldSettlementDate($response->old_conversion_date)
            ->setEventDateTime(new DateTime($response->event_date_time));

        return $conversionDateChanged;
    }

    /**
     * @param stdClass $response
     *
     * @return ConversionSplit
     */
    private function createConversionSplitFromResponse(stdClass $response)
    {
        $conversionSplit = new ConversionSplit();

        $parent_conversion = new Conversion();
        $parent_conversion->setId($response->parent_conversion->id)
            ->setShortReference($response->parent_conversion->short_reference)
            ->setClientSellAmount($response->parent_conversion->sell_amount)
            ->setSellCurrency($response->parent_conversion->sell_currency)
            ->setClientBuyAmount($response->parent_conversion->buy_amount)
            ->setBuyCurrency($response->parent_conversion->buy_currency)
            ->setSettlementDate($response->parent_conversion->settlement_date)
            ->setConversionDate($response->parent_conversion->conversion_date)
            ->setStatus($response->parent_conversion->status);

        $child_conversion = new Conversion();
        $child_conversion->setId($response->child_conversion->id)
            ->setShortReference($response->child_conversion->short_reference)
            ->setClientSellAmount($response->child_conversion->sell_amount)
            ->setSellCurrency($response->child_conversion->sell_currency)
            ->setClientBuyAmount($response->child_conversion->buy_amount)
            ->setBuyCurrency($response->child_conversion->buy_currency)
            ->setSettlementDate($response->child_conversion->settlement_date)
            ->setConversionDate($response->child_conversion->conversion_date)
            ->setStatus($response->child_conversion->status);

        $conversionSplit->setParentConversion($parent_conversion)
            ->setChildConversion($child_conversion);
        
        return $conversionSplit;
    }

    /**
     * @param string $id
     * @param string|null $onBehalfOf
     *
     * @return Conversion
     */
    public function retrieve($id, $onBehalfOf = null)
    {
        $response = $this->request(
            'GET',
            sprintf('conversions/%s', $id),
            [
                'on_behalf_of' => $onBehalfOf
            ]
        );

        return $this->createConversionFromResponse($response);
    }

    /**
     * @param FindConversionsCriteria|null $criteria
     * @param null $onBehalfOf
     *
     * @return Conversions
     */
    public function find(FindConversionsCriteria $criteria = null, $onBehalfOf = null)
    {
        if (null === $criteria) {
            $criteria = new FindConversionsCriteria();
        }

        $response = $this->request(
            'GET',
            'conversions/find',
            $this->convertFindConversionCriteriaToRequest($criteria) + [
                'on_behalf_of' => $onBehalfOf
            ]
        );


        $conversions = [];
        foreach ($response->conversions as $data) {
            $conversions[] = $this->createConversionFromResponse($data);
        }
        return new Conversions($conversions, $this->createPaginationFromResponse($response));
    }

    /**
     * @param FindConversionsCriteria $criteria
     *
     * @return array
     */
    private function convertFindConversionCriteriaToRequest(FindConversionsCriteria $criteria)
    {
        $createdAtFrom = $criteria->getCreatedAtFrom();
        $createdAtTo = $criteria->getCreatedAtTo();
        $updatedAtFrom = $criteria->getUpdatedAtFrom();
        $updatedAtTo = $criteria->getUpdatedAtTo();
        $conversionIds = $criteria->getConversionIds();
        return [
            'short_reference' => $criteria->getShortReference(),
            'status' => $criteria->getStatus(),
            'partner_status' => $criteria->getParentStatus(),
            'buy_currency' => $criteria->getBuyCurrency(),
            'sell_currency' => $criteria->getSellCurrency(),
            'conversion_ids' => (null === $conversionIds) ? null : implode(',', $conversionIds),
            'created_at_from' => (null === $createdAtFrom) ? null : $createdAtFrom->format(DateTime::ISO8601),
            'created_at_to' => (null === $createdAtTo) ? null : $createdAtTo->format(DateTime::ISO8601),
            'updated_at_from' => (null === $updatedAtFrom) ? null : $updatedAtFrom->format(DateTime::ISO8601),
            'updated_at_to' => (null === $updatedAtTo) ? null : $updatedAtTo->format(DateTime::ISO8601),
            'currency_pair' => $criteria->getCurrencyPair(),
            'partner_buy_amount_from' => $criteria->getPartnerBuyAmountFrom(),
            'partner_buy_amount_to' => $criteria->getPartnerBuyAmountTo(),
            'partner_sell_amount_from' => $criteria->getPartnerSellAmountFrom(),
            'partner_sell_amount_to' => $criteria->getPartnerSellAmountTo(),
            'buy_amount_from' => $criteria->getBuyAmountFrom(),
            'buy_amount_to' => $criteria->getBuyAmountTo(),
            'sell_amount_from' => $criteria->getSellAmountFrom(),
            'sell_amount_to' => $criteria->getSellAmountTo(),
            'unique_request_id' => $criteria->getUniqueRequestId()
        ];
    }


    /**
     * @param string $id
     * @param string|null $notes
     *
     * @return CancelledConversion
     */
    public function cancel($id, $notes = null)
    {
        $response = $this->request(
            'POST',
            sprintf('conversions/%s/cancel', $id),
            [],
            [
                'notes' => $notes
            ]
        );

        return $this->createConversionCancellationFromResponse($response);
    }


    /**
     * @param string $id
     * @param string $new_settlement_date
     * @param string|null $onBehalfOf
     *
     * @return CancelledConversion
     */
    public function date_change($id, $new_settlement_date)
    {
        $response = $this->request(
            'POST',
            sprintf('conversions/%s/date_change', $id),
            [
                'new_settlement_date' => $new_settlement_date
            ]
        );

        return $this->createConversionDateChangeFromResponse($response);
    }

    /**
     * @param string $id
     * @param string $amount
     * @param string|null $onBehalfOf
     *
     * @return ConversionSplit
     */
    public function split($id, $amount)
    {
        $response = $this->request(
            'POST',
            sprintf('conversions/%s/split', $id),
            [
                'amount' => $amount
            ]
        );

        return $this->createConversionSplitFromResponse($response);
    }

    /**
     * @param ConversionProfitLossCriteria $conversionProfitLossCriteria
     * @param Pagination $pagination
     *
     * @return ConversionProfitLossCollection
     */
    public function retrieveProfitLoss(ConversionProfitLossCriteria $conversionProfitLossCriteria, Pagination $pagination)
    {
        if(empty($conversionProfitLossCriteria)){
            $conversionProfitLossCriteria = new ConversionProfitLossCriteria();
        }
        if(empty($pagination)){
            $pagination = new Pagination();
        }

        $response = $this->request(
            'GET',
            sprintf('conversions/profit_and_loss'),
            array_merge($this->createRequestFromConversionProfitLossCriteria($conversionProfitLossCriteria), $this->convertPaginationToRequest($pagination))
        );

        return $this->createConversionsProfitLossFromResponse($response);
    }

    protected function createRequestFromConversionProfitLossCriteria(ConversionProfitLossCriteria $conversionProfitLossCriteria){
        return [
            'account_id' => $conversionProfitLossCriteria->getAccountId(),
            'contact_id' => $conversionProfitLossCriteria->getContactId(),
            'conversion_id' => $conversionProfitLossCriteria->getConversionId(),
            'event_type' => $conversionProfitLossCriteria->getEventType(),
            'event_date_time_from' => $conversionProfitLossCriteria->getEventDateTimeFrom(),
            'event_date_time_to' => $conversionProfitLossCriteria->getEventDateTimeTo(),
            'amount_from' => $conversionProfitLossCriteria->getAmountFrom(),
            'amount_to' => $conversionProfitLossCriteria->getAmountTo(),
            'currency' => $conversionProfitLossCriteria->getCurrency(),
            'scope' => $conversionProfitLossCriteria->getScope()
        ];
    }

    protected function createConversionsProfitLossFromResponse($response){
        $conversions = [];

        foreach($response->conversion_profit_and_losses as $key => $value){
            array_push($conversions, $this->createConversionProfitLossFromResponse($value));
        }

        return new ConversionProfitLossCollection($conversions, $this->createPaginationFromResponse($response));
    }

    protected function createConversionProfitLossFromResponse($object){
        return new ConversionProfitLoss(
            $object->account_id,
            $object->contact_id,
            $object->event_account_id,
            $object->event_contact_id,
            $object->conversion_id,
            $object->event_type,
            $object->amount,
            $object->currency,
            $object->notes,
            !empty($object->event_date_time) ? new DateTime($object->event_date_time) : null
        );
    }

    /**
     * @param string $id
     * @param string $newSettlementDate
     * @return ConversionDateChangeQuote
     */
    public function retrieveDateChangeQuote($id, $newSettlementDate)
    {
        $response = $this->request(
            'GET',
            sprintf('conversions/%s/date_change_quote', $id),
            [
                'new_settlement_date' => $newSettlementDate
            ]
        );

        return $this->createConversionDateChangeQuoteFromResponse($response);
    }

    /**
     * @param stdClass $response
     * @return ConversionDateChangeQuote
     */
    protected function createConversionDateChangeQuoteFromResponse($response){
        return new ConversionDateChangeQuote(
            $response->conversion_id,
            $response->amount,
            $response->currency,
            !empty($response->new_conversion_date) ? new DateTime($response->new_conversion_date) : null,
            !empty($response->new_settlement_date) ? new DateTime($response->new_settlement_date) : null,
            !empty($response->old_conversion_date) ? new DateTime($response->old_conversion_date) : null,
            !empty($response->old_settlement_date) ? new DateTime($response->old_settlement_date) : null,
            !empty($response->event_date_time) ? new DateTime($response->event_date_time) : null
        );
    }

    /**
     * @param string $id
     * @param string $amount
     * @return ConversionSplit
     */
    public function retrieveSplitPreview($id, $amount)
    {
        $response = $this->request(
            'GET',
            sprintf('conversions/%s/split_preview', $id),
            [
                'amount' => $amount
            ]
        );

        return $this->createConversionSplitFromResponse($response);
    }

    /**
     * @param string $id
     * @return ConversionSplitHistory
     */
    public function retrieveSplitHistory($id)
    {
        $response = $this->request(
            'GET',
            sprintf('conversions/%s/split_history', $id),
            []
        );

        return $this->convertConversionSplitHistoryFromResponse($response);
    }

    protected function convertConversionSplitHistoryFromResponse($response){
        return new ConversionSplitHistory(
            $this->createConversionObjectFromResponse($response->parent_conversion),
            $this->createConversionObjectFromResponse($response->origin_conversion),
            $this->convertChildConversionsFromResponseArray($response->child_conversions)
        );
    }

    /**
     * @param stdClass $dummyObject
     * @return Conversion
     */
    protected function createConversionObjectFromResponse($dummyObject){

        $conversion = new Conversion();
        if(!empty($dummyObject)) {
            $conversion->setShortReference($dummyObject->short_reference)
                ->setClientSellAmount($dummyObject->sell_amount)
                ->setSellCurrency($dummyObject->sell_currency)
                ->setClientBuyAmount($dummyObject->buy_amount)
                ->setBuyCurrency($dummyObject->buy_currency)
                ->setSettlementDate($dummyObject->settlement_date)
                ->setConversionDate($dummyObject->conversion_date)
                ->setStatus($dummyObject->status)
                ->setId($dummyObject->id);
        }

        return $conversion;
    }

    /**
     * @param $response
     * @return Conversion[]
     */
    protected function convertChildConversionsFromResponseArray($dummyArray) {
        $childConversions = [];

        foreach ($dummyArray as $key => $value){
            array_push(
                $childConversions,
                $this->createConversionObjectFromResponse($value));
        }

        return $childConversions;
    }

    /**
     * @param string $id
     * @return ConversionCancellationQuote
     */
    public function retrieveCancellationQuote($id)
    {
        $response = $this->request(
            'GET',
            sprintf('conversions/%s/cancellation_quote', $id),
            []
        );

        return $this->createCancellationQuotefromResponse($response);
    }

    /**
     * @param stdClass $response
     * @return ConversionCancellationQuote
     */
    protected function createCancellationQuotefromResponse($response){
        return new ConversionCancellationQuote(
            $response->amount,
            $response->currency,
            !empty($response->event_date_time) ? new DateTime($response->event_date_time) : null
        );
    }
}
