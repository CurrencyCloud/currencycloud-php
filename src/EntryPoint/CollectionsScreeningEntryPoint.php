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
     * @param $authToken
     * @param $accepted
     * @param $reason
     * @return ScreeningResponse
     */
    public function canCompleteScreening($transactionId,
                                         $authToken,
                                         $accepted,
                                         $reason): ScreeningResponse
    {

        $payload = [
            'accepted' => $accepted,
            'reason' => $reason
        ];

        // PUT request to complete screening transaction
        $response = $this->request(
            'PUT',
            sprintf('collections_screening/%s/complete', $transactionId),
            [],
            $payload,
            [
                'headers' => [
                    'X-Auth-Token' => $authToken,
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ]
            ],
            true
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
            $response->transactionId,
            $response->accountId,
            $response->houseAccountId,
            $result
        );
    }
}
