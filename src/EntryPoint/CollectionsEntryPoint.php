<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\CollectionsScreeningResponse;
use CurrencyCloud\Model\CollectionsScreeningResult;
use stdClass;

class CollectionsEntryPoint extends AbstractEntryPoint
{

    /**
     * @param string $transactionId
     * @param bool $accepted
     * @param string $reason
     *
     * @return CollectionsScreeningResponse
     */
    public function completeScreening($transactionId, $accepted, $reason)
    {
        $response = $this->request(
            'PUT',
            sprintf('collections_screening/%s/complete', $transactionId),
            [],
            [
                'accepted' => $accepted,
                'reason' => $reason
            ]
        );

        return $this->createCollectionsScreeningResponseFromResponse($response);
    }

    /**
     * @param stdClass $response
     *
     * @return CollectionsScreeningResponse
     */
    protected function createCollectionsScreeningResponseFromResponse(stdClass $response)
    {
        $result = new CollectionsScreeningResult(
            $response->result->reason,
            $response->result->accepted
        );

        return new CollectionsScreeningResponse(
            $response->transaction_id,
            $response->account_id,
            $response->house_account_id,
            $result
        );
    }
}
