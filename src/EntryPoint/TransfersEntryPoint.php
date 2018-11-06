<?php
namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\Transfer;
use DateTime;
use stdClass;

class TransfersEntryPoint extends AbstractEntityEntryPoint {

    /**
     * @param string $id
     * @param string|null $onBehalfOf
     * @return \CurrencyCloud\Model\EntityInterface
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
}