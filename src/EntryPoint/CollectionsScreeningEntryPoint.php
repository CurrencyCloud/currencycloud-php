<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\ScreeningResponse;
use CurrencyCloud\Model\Result;

/**
 *
 * Handles the completion of screening transactions via PUT request
 */
class CollectionsScreeningEntryPoint extends AbstractEntryPoint
{

    /**
     * @param $transactionId
     * @param $accepted
     * @param $reason
     * @return ScreeningResponse
     */
    public function canCompleteScreening($transactionId,
                                         $accepted,
                                         $reason): ScreeningResponse
    {
        // PUT request to complete screening transaction
        $response = $this->request(
            'PUT',
            sprintf('collections_screening/%s/complete', $transactionId),
            [],
            [
                'accepted' => $accepted,
                'reason' => $reason
            ]
        );

        //Generate ScreeningResponse object from the response
        return $this->createScreeningResponseFromResponse($response);
    }

    /**
     * @param $response
     * @return ScreeningResponse
     */
    protected function createScreeningResponseFromResponse($response): ScreeningResponse
    {
        $result = new Result($response->result->accepted, $response->result->reason);
        return new ScreeningResponse(
            $response->transaction_id,
            $response->account_id,
            $response->house_account_id,
            $result
        );
    }
}
