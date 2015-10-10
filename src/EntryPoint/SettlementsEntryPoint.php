<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Criteria\FindSettlementsCriteria;
use CurrencyCloud\Model\Pagination;
use CurrencyCloud\Model\Settlement;
use CurrencyCloud\Model\SettlementEntry;
use CurrencyCloud\Model\Settlements;
use DateTime;
use stdClass;

class SettlementsEntryPoint extends AbstractEntryPoint
{

    /**
     * @param null|string $type
     * @param null|string $onBehalfOf
     *
     * @return Settlement
     */
    public function create($type = null, $onBehalfOf = null)
    {
        $response = $this->request(
            'POST',
            'settlements/create',
            [],
            [
                'type' => $type,
                'on_behalf_of' => $onBehalfOf
            ]
        );

        return $this->createSettlementFromResponse($response);
    }

    /**
     * @param stdClass $response
     *
     * @return Settlement
     */
    protected function createSettlementFromResponse(stdClass $response)
    {
        $entries = [];
        foreach ($response->entries as $currency => $entry) {
            $entries[$currency] = new SettlementEntry($entry->send_amount, $entry->receive_amount);
        }

        $settlement = new Settlement();
        $settlement->setShortReference($response->short_reference)
            ->setStatus($response->status)
            ->setConversionIds($response->conversion_ids)
            ->setEntries($entries)
            ->setCreatedAt(new DateTime($response->created_at))
            ->setUpdatedAt(new DateTime($response->updated_at))
            ->setReleasedAt(new DateTime($response->released_at));

        $this->setIdProperty($settlement, $response->id);
        return $settlement;
    }

    /**
     * @param string $id
     * @param null|string $onBehalfOf
     *
     * @return Settlement
     */
    public function retrieve($id, $onBehalfOf = null)
    {
        $response = $this->request(
            'GET',
            sprintf('settlements/%s', $id),
            [],
            [
                'on_behalf_of' => $onBehalfOf
            ]
        );

        return $this->createSettlementFromResponse($response);
    }

    /**
     * @param string $id
     * @param null|string $onBehalfOf
     *
     * @return Settlement
     */
    public function delete($id, $onBehalfOf = null)
    {
        $response = $this->request(
            'POST',
            sprintf('settlements/%s/delete', $id),
            [
                'on_behalf_of' => $onBehalfOf
            ]
        );

        return $this->createSettlementFromResponse($response);
    }

    /**
     * @param string $settlementId
     * @param string $conversionId
     * @param null $onBehalfOf
     *
     * @return Settlement
     */
    public function addConversion($settlementId, $conversionId, $onBehalfOf = null)
    {
        $response = $this->request(
            'POST',
            sprintf('settlements/%s/add_conversion', $settlementId),
            [],
            [
                'conversion_id' => $conversionId,
                'on_behalf_of' => $onBehalfOf
            ]
        );

        return $this->createSettlementFromResponse($response);
    }

    /**
     * @param string $settlementId
     * @param string $conversionId
     * @param null $onBehalfOf
     *
     * @return Settlement
     */
    public function removeConversion($settlementId, $conversionId, $onBehalfOf = null)
    {
        $response = $this->request(
            'POST',
            sprintf('settlements/%s/remove_conversion', $settlementId),
            [],
            [
                'conversion_id' => $conversionId,
                'on_behalf_of' => $onBehalfOf
            ]
        );

        return $this->createSettlementFromResponse($response);
    }

    /**
     * @param string $id
     * @param null $onBehalfOf
     *
     * @return Settlement
     */
    public function release($id, $onBehalfOf = null)
    {
        $response = $this->request(
            'POST',
            sprintf('settlements/%s/release', $id),
            [],
            [
                'on_behalf_of' => $onBehalfOf
            ]
        );

        return $this->createSettlementFromResponse($response);
    }

    /**
     * @param string $id
     * @param null $onBehalfOf
     *
     * @return Settlement
     */
    public function unRelease($id, $onBehalfOf = null)
    {
        $response = $this->request(
            'POST',
            sprintf('settlements/%s/unrelease', $id),
            [],
            [
                'on_behalf_of' => $onBehalfOf
            ]
        );

        return $this->createSettlementFromResponse($response);
    }

    /**
     * @param null|string $shortReference
     * @param null|string $status
     * @param FindSettlementsCriteria|null $criteria
     * @param Pagination|null $pagination
     * @param null $onBehalfOf
     *
     * @return Settlements
     */
    public function find(
        $shortReference = null,
        $status = null,
        FindSettlementsCriteria $criteria = null,
        Pagination $pagination = null,
        $onBehalfOf = null
    ) {

        if (null === $criteria) {
            $criteria = new FindSettlementsCriteria();
        }
        if (null === $pagination) {
            $pagination = new Pagination();
        }
        $response = $this->request(
            'GET',
            'settlements/find',
            $this->convertPaginationToRequest($pagination)
            + $this->convertFindSettlementsCriteriaToRequest($criteria)
            + [
                'on_behalf_of' => $onBehalfOf,
                'short_reference' => $shortReference,
                'status' => $status
            ]
        );
        $settlements = [];
        foreach ($response->settlements as $data) {
            $settlements[] = $this->createSettlementFromResponse($data);
        }
        return new Settlements($settlements, $this->createPaginationFromResponse($response));
    }

    /**
     * @param FindSettlementsCriteria $criteria
     *
     * @return array
     */
    private function convertFindSettlementsCriteriaToRequest(FindSettlementsCriteria $criteria)
    {
        $createdAtFrom = $criteria->getCreatedAtFrom();
        $createdAtTo = $criteria->getCreatedAtTo();
        $updatedAtFrom = $criteria->getUpdatedAtFrom();
        $updatedAtTo = $criteria->getUpdatedAtTo();
        $releasedAtFrom = $criteria->getReleasedAtFrom();
        $releasedAtTo = $criteria->getReleasedAtTo();
        return [
            'created_at_from' => (null === $createdAtFrom) ? null : $createdAtFrom->format(DateTime::ISO8601),
            'created_at_to' => (null === $createdAtTo) ? null : $createdAtTo->format(DateTime::ISO8601),
            'updated_at_from' => (null === $updatedAtFrom) ? null : $updatedAtFrom->format(DateTime::ISO8601),
            'updated_at_to' => (null === $updatedAtTo) ? null : $updatedAtTo->format(DateTime::ISO8601),
            'released_at_from' => (null === $releasedAtFrom) ? null : $releasedAtFrom->format(DateTime::ISO8601),
            'released_at_to' => (null === $releasedAtTo) ? null : $releasedAtTo->format(DateTime::ISO8601)
        ];
    }
}
