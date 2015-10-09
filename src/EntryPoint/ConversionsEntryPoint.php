<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Criteria\FindConversionCriteria;
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
     * @param boolean $teamAgreement
     * @param null|string $onBehalfOf
     *
     * @return Conversion
     */
    public function create(
        Conversion $conversion,
        $amount,
        $reason,
        $teamAgreement,
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
                'teamAgreement' => $teamAgreement ? "true" : "false",
                'conversionDate' => (null === $conversionDate) ? null : $conversionDate->format(DateTime::ISO8601),
                'clientBuyAmount' => $conversion->getClientBuyAmount(),
                'clientSellAmount' => $conversion->getClientSellAmount(),
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
            ->setShortReference($response->creator_contact_id)
            ->setSettlementDate(new DateTime($response->creator_contact_id))
            ->setConversionDate(new DateTime($response->creator_contact_id))
            ->setStatus($response->creator_contact_id)
            ->setPartnerStatus($response->creator_contact_id)
            ->setCurrencyPair($response->creator_contact_id)
            ->setBuyCurrency($response->creator_contact_id)
            ->setSellCurrency($response->creator_contact_id)
            ->setFixedSide($response->creator_contact_id)
            ->setPartnerBuyAmount($response->creator_contact_id)
            ->setPartnerSellAmount($response->creator_contact_id)
            ->setClientBuyAmount($response->creator_contact_id)
            ->setClientSellAmount($response->creator_contact_id)
            ->setMidMarketRate($response->creator_contact_id)
            ->setCoreRate($response->creator_contact_id)
            ->setPartnerRate($response->creator_contact_id)
            ->setClientRate($response->creator_contact_id)
            ->setDepositRequired($response->creator_contact_id)
            ->setDepositAmount($response->creator_contact_id)
            ->setDepositCurrency($response->creator_contact_id)
            ->setDepositStatus($response->creator_contact_id)
            ->setDepositRequiredAt(new DateTime($response->creator_contact_id))
            ->setPaymentIds($response->creator_contact_id)
            ->setCreatedAt(new DateTime($response->creator_contact_id))
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
     * @param FindConversionCriteria|null $criteria
     * @param null $onBehalfOf
     *
     * @return Conversions
     */
    public function find(FindConversionCriteria $criteria = null, $onBehalfOf = null)
    {
        if (null === $criteria) {
            $criteria = new FindConversionCriteria();
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
     * @param FindConversionCriteria $criteria
     *
     * @return array
     */
    private function convertFindConversionCriteriaToRequest(FindConversionCriteria $criteria)
    {
        $createdAtFrom = $criteria->getCreatedAtFrom();
        $createdAtTo = $criteria->getCreatedAtTo();
        $updatedAtFrom = $criteria->getUpdatedAtFrom();
        $updatedAtTo = $criteria->getUpdatedAtTo();
        return [
            'short_reference' => $criteria->getShortReference(),
            'status' => $criteria->getStatus(),
            'partner_status' => $criteria->getParentStatus(),
            'buy_currency' => $criteria->getBuyCurrency(),
            'sell_currency' => $criteria->getSellCurrency(),
            'conversion_ids' => $criteria->getConversionIds(),
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
            'buy_amount_to' => $criteria->getSellAmountTo(),
            'sell_amount_from' => $criteria->getBuyAmountFrom(),
            'sell_amount_to' => $criteria->getSellAmountTo()
        ];
    }
}
