<?php
namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Criteria\FindTransferCriteria;
use CurrencyCloud\Model\Pagination;
use CurrencyCloud\Model\Transfer;
use CurrencyCloud\Model\Transfers;
use DateTime;
use stdClass;

class TransfersEntryPoint extends AbstractEntityEntryPoint {

    /**
     * @param string $id
     * @param string|null $onBehalfOf
     * @return Transfer
     */
    public function retrieve($id, $onBehalfOf = null){
        return $this->doRetrieve(
            sprintf('transfers/%s', $id),
            function (stdClass $response) {
                return $this->createTransferFromResponse($response);
            },
            $onBehalfOf);
    }

    /**
     * @param stdClass $response
     * @return Transfer
     */
    protected function createTransferFromResponse($response){
        return new Transfer(
            $response->id,
            $response->short_reference,
            $response->source_account_id,
            $response->destination_account_id,
            $response->currency,
            $response->amount,
            $response->status,
            $response->reason,
            !empty($response->created_at) ? new DateTime($response->created_at) : null,
            !empty($response->updated_at) ? new DateTime($response->updated_at) : null,
            !empty($response->completed_at) ? new DateTime($response->completed_at) : null,
            $response->creator_account_id,
            $response->creator_contact_id
        );
    }

    /**
     * @param FindTransferCriteria $findTransferCriteria
     * @param Pagination $pagination
     * @return Transfers
     */
    public function find($findTransferCriteria, $pagination, $onBehalfOf = null){
        return $this->doFind(
            'transfers/find',
            $findTransferCriteria,
            $pagination,
            function () use ($findTransferCriteria, $pagination, $onBehalfOf){
                return $this->convertFindCriteriaToRequest(
                    $findTransferCriteria) +
                    $this->convertPaginationToRequest($pagination) +
                    [ 'on_behalf_of' => $onBehalfOf ];
            },
            function ($response){
                return $this->createTransferFromResponse($response);
            },
            function ($entities, $pagination){
                return new Transfers($entities, $pagination);
            },
            'transfers',
            $onBehalfOf
        );
    }

    /**
     * @param FindTransferCriteria $criteria
     * @return array
     */
    protected function convertFindCriteriaToRequest($criteria){
        return [
            "short_reference" => $criteria->getShortReference(),
            "source_account_id" => $criteria->getSourceAccountId(),
            "destination_account_id" => $criteria->getDestinationAccountId(),
            "status" => $criteria->getStatus(),
            "currency" => $criteria->getCurrency(),
            "amount_from" => $criteria->getAmountFrom(),
            "amount_to" => $criteria->getAmountTo(),
            "created_at_from" => $criteria->getCreatedAtFrom(),
            "created_at_to" => $criteria->getCreatedAtTo(),
            "updated_at_from" => $criteria->getUpdatedAtFrom(),
            "updated_at_to" => $criteria->getUpdatedAtTo(),
            "completed_at_from" => $criteria->getCompletedAtFrom(),
            "completed_at_to" => $criteria->getCompletedAtFrom(),
            "creator_account_id" => $criteria->getCreatorAccountId(),
            "creator_contact_id" => $criteria->getCreatorContactId()
        ];
    }

    /**
     * @param stdClass $response
     * @return Transfer
     */
    public function convertTransferFromResponse($response){
        return new  Transfer(
            $response->id,
            $response->short_reference,
            $response->source_account_id,
            $response->destination_account_id,
            $response->currency,
            $response->amount,
            $response->status,
            $response->reason,
            $response->created_at,
            $response->updated_at,
            $response->completed_at,
            $response->creator_account_id,
            $response->creator_contact_id
        );
    }
}