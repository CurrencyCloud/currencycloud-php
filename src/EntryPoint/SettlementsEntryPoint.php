<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Criteria\FindSettlementsCriteria;
use CurrencyCloud\Model\Pagination;
use CurrencyCloud\Model\Settlement;
use CurrencyCloud\Model\SettlementEntry;
use CurrencyCloud\Model\Settlements;
use DateTime;
use stdClass;

class SettlementsEntryPoint extends AbstractEntityEntryPoint
{

    /**
     * @param null|string $type
     * @param null|string $onBehalfOf
     *
     * @return Settlement
     */
    public function create($type = null, $onBehalfOf = null)
    {
        return $this->doCreate('settlements/create', $type, function ($type) {
            return ['type' => $type];
        }, function (stdClass $response) {
            return $this->createSettlementFromResponse($response);
        }, $onBehalfOf);
    }

    /**
     * @param stdClass $response
     *
     * @return Settlement
     */
    protected function createSettlementFromResponse(stdClass $response)
    {
        $entries = [];
        foreach ($response->entries as $temp) {
            $r = [];
            foreach ($temp as $currency => $entry) {
                $r[$currency] = new SettlementEntry($entry->send_amount, $entry->receive_amount);
            }
            $entries[] = $r;
        }

        $settlement = new Settlement();
        $settlement->setShortReference($response->short_reference)
            ->setStatus($response->status)
            ->setType(isset($response->type) ? $response->type : null)
            ->setConversionIds($response->conversion_ids)
            ->setEntries($entries)
            ->setCreatedAt(new DateTime($response->created_at))
            ->setUpdatedAt(new DateTime($response->updated_at))
            ->setReleasedAt($response->released_at ? new DateTime($response->released_at) : null);

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
        return $this->doRetrieve(sprintf('settlements/%s', $id), function (stdClass $response) {
            return $this->createSettlementFromResponse($response);
        }, $onBehalfOf);
    }

    /**
     * @param Settlement $settlement
     * @param null|string $onBehalfOf
     *
     * @return Settlement
     */
    public function delete(Settlement $settlement, $onBehalfOf = null)
    {
        return $this->doDelete(sprintf('settlements/%s/delete', $settlement->getId()), $settlement, function (stdClass $response) {
            return $this->createSettlementFromResponse($response);
        }, $onBehalfOf);
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
        return $this->doFind('settlements/find', $criteria, $pagination, function ($criteria, $onBehalfOf) use ($shortReference, $status) {
            return $this->convertFindSettlementsCriteriaToRequest($criteria) + [
                'short_reference' => $shortReference,
                'status' => $status,
                'on_behalf_of' => $onBehalfOf
            ];
        }, function (stdClass $response) {
            return $this->createSettlementFromResponse($response);
        }, function ($items, $pagination) {
            return new Settlements($items, $pagination);
        }, 'settlements', $onBehalfOf);
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
