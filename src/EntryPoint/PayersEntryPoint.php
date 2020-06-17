<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\Payer;
use DateTime;

class PayersEntryPoint extends AbstractEntryPoint
{

    /**
     * @param string $id
     * @param null|string $onBehalfOf
     *
     * @return Payer
     */
    public function retrieve($id, $onBehalfOf = null)
    {
        $response = $this->request(
            'GET',
            sprintf('payers/%s', $id),
            [
                'on_behalf_of' => $onBehalfOf
            ]
        );

        return $this->createPayerFromResponse($response);
    }

    protected function createPayerFromResponse($response)
    {
        $payer = new Payer(
            $response->legal_entity_type,
            $response->company_name,
            $response->first_name,
            $response->last_name,
            $response->address,
            $response->city,
            $response->state_or_province,
            $response->country,
            $response->identification_type,
            $response->identification_value,
            $response->postcode,
            new DateTime($response->date_of_birth),
            new DateTime($response->created_at),
            new DateTime($response->updated_at)
        );

        $this->setIdProperty($payer, $response->id);
        return $payer;
    }

}
