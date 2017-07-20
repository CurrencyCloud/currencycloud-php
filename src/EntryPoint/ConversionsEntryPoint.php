<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Criteria\FindConversionsCriteria;
use CurrencyCloud\Model\Conversion;
use CurrencyCloud\Model\Conversions;
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
    ) {
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
                'unique_request_id' => empty($conversion->getUniqueRequestId()) ? null : $conversion->getUniqueRequestId(),
                'on_behalf_of' => $onBehalfOf
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
            ->setUpdatedAt(new DateTime($response->updated_at));

        $this->setIdProperty($conversion, $response->id);

        return $conversion;
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
            'sell_amount_to' => $criteria->getSellAmountTo()
        ];
    }
}
