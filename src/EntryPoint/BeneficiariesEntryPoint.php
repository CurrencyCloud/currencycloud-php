<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Model\Beneficiaries;
use CurrencyCloud\Model\Beneficiary;
use CurrencyCloud\Model\Pagination;
use DateTime;
use stdClass;

class BeneficiariesEntryPoint extends AbstractEntityEntryPoint
{

    /**
     * @param Beneficiary $beneficiary
     * @param null|string $onBehalfOf
     *
     * @return Beneficiary
     */
    public function validate(Beneficiary $beneficiary, $onBehalfOf = null)
    {
        $response = $this->request(
            'POST',
            'beneficiaries/validate',
            [],
            $this->convertBeneficiaryToRequest(
                $beneficiary,
                $onBehalfOf,
                true
            )
        );
        return $this->createBeneficiaryFromResponse($response, true);
    }

    /**
     * @param Beneficiary $beneficiary
     * @param null|string $onBehalfOf
     *
     * @return Beneficiary
     */
    public function create(Beneficiary $beneficiary, $onBehalfOf = null)
    {
        $response = $this->request(
            'POST',
            'beneficiaries/create',
            [],
            $this->convertBeneficiaryToRequest(
                $beneficiary,
                $onBehalfOf
            )
        );
        $entity = $this->createBeneficiaryFromResponse($response);
        $this->entityManager->add($entity);
        return $entity;
    }

    /**
     * @param string $id
     * @param null $onBehalfOf
     *
     * @return Beneficiary
     */
    public function retrieve($id, $onBehalfOf = null)
    {
        $response = $this->request(
            'GET',
            sprintf('beneficiaries/%s', $id),
            [],
            [
                'on_behalf_of' => $onBehalfOf
            ]
        );
        $entity = $this->createBeneficiaryFromResponse($response);

        $this->entityManager->add($entity);

        return $entity;
    }

    /**
     * @param Beneficiary $beneficiary
     * @param null $onBehalfOf
     *
     * @return Beneficiary
     */
    public function update(Beneficiary $beneficiary, $onBehalfOf = null)
    {
        /* @var Beneficiary $changeSet */
        $changeSet = $this->entityManager->computeChangeSet($beneficiary);
        if (null === $changeSet) {
            return $beneficiary;
        }
        $response = $this->request(
            'POST',
            sprintf(
                'beneficiaries/%s',
                $beneficiary->getId()
            ),
            [],
            $this->convertBeneficiaryToRequest($changeSet, $onBehalfOf, false, true)
        );
        $entity = $this->createBeneficiaryFromResponse($response);

        $this->entityManager->remove($beneficiary);
        $this->entityManager->add($entity);

        return $entity;
    }

    /**
     * @param Beneficiary|null $beneficiary
     * @param Pagination|null $pagination
     * @param null $onBehalfOf
     *
     * @return Beneficiaries
     */
    public function find(Beneficiary $beneficiary = null, Pagination $pagination = null, $onBehalfOf = null)
    {
        if (null === $beneficiary) {
            $beneficiary = new Beneficiary();
        }
        if (null === $pagination) {
            $pagination = new Pagination();
        }
        $response = $this->request(
            'GET',
            'beneficiaries/find',
            $this->convertBeneficiaryToRequest(
                $beneficiary,
                $onBehalfOf,
                false,
                true
            ) + $this->convertPaginationToRequest($pagination)
        );
        $beneficiaries = [];
        foreach ($response->beneficiaries as $beneficiary) {
            $entity = $this->createBeneficiaryFromResponse($beneficiary);
            $this->entityManager->add($entity);
            $beneficiaries[] = $entity;
        }
        return new Beneficiaries($beneficiaries, $this->createPaginationFromResponse($response));
    }

    /**
     * @param Beneficiary $beneficiary
     * @param null $onBehalfOf
     *
     * @return Beneficiary
     */
    public function delete(Beneficiary $beneficiary, $onBehalfOf = null)
    {
        $response = $this->request(
            'POST',
            sprintf('beneficiaries/%s/delete', $beneficiary->getId()),
            [],
            [
                'on_behalf_of' => $onBehalfOf
            ]
        );
        $this->entityManager->remove($beneficiary);
        return $this->createBeneficiaryFromResponse($response);
    }

    /**
     * @param Beneficiary $beneficiary
     * @param string $onBehalfOf
     * @param bool $convertForValidate
     * @param bool $convertForUpdate
     *
     * @return array
     */
    protected function convertBeneficiaryToRequest(
        Beneficiary $beneficiary,
        $onBehalfOf,
        $convertForValidate = false,
        $convertForUpdate = false
    ) {
        $isDefaultBeneficiary = $beneficiary->isDefaultBeneficiary();
        $common = [
            'bank_country' => $beneficiary->getBankCountry(),
            'currency' => $beneficiary->getCurrency(),
            'beneficiary_country' => $beneficiary->getBeneficiaryCountry(),
            'account_number' => $beneficiary->getAccountNumber(),
            'routing_code_type_1' => $beneficiary->getRoutingCodeType1(),
            'routing_code_value_1' => $beneficiary->getRoutingCodeValue1(),
            'routing_code_type_2' => $beneficiary->getRoutingCodeType2(),
            'routing_code_value_2' => $beneficiary->getRoutingCodeValue2(),
            'bic_swift' => $beneficiary->getBicSwift(),
            'iban' => $beneficiary->getIban(),
            'bank_address' => $beneficiary->getBankAddress(),
            'bank_name' => $beneficiary->getBankName(),
            'default_beneficiary' => (null === $isDefaultBeneficiary) ? null :
                ($isDefaultBeneficiary ? 'true' : 'false'),
            'bank_account_type' => $beneficiary->getBankAccountType(),
            'beneficiary_entity_type' => $beneficiary->getBeneficiaryEntityType(),
            'beneficiary_company_name' => $beneficiary->getBeneficiaryCompanyName(),
            'beneficiary_first_name' => $beneficiary->getBeneficiaryFirstName(),
            'beneficiary_last_name' => $beneficiary->getBeneficiaryLastName(),
            'beneficiary_city' => $beneficiary->getBeneficiaryCity(),
            'beneficiary_postcode' => $beneficiary->getBeneficiaryPostCode(),
            'beneficiary_state_or_province' => $beneficiary->getBeneficiaryStateOrProvince(),
            'beneficiary_date_of_birth' => (null === $beneficiary->getBeneficiaryDateOfBirth()) ? null :
                $beneficiary->getBeneficiaryDateOfBirth()
                    ->format(DateTime::RFC3339),
            'beneficiary_identification_type' => $beneficiary->getBeneficiaryIdentificationType(),
            'beneficiary_identification_value' => $beneficiary->getBeneficiaryIdentificationValue(),
            'payment_types' => $beneficiary->getPaymentTypes(),
            'on_behalf_of' => $onBehalfOf
        ];

        if ($convertForValidate) {
            return $common;
        }

        $common += [
            'bank_account_holder_name' => $beneficiary->getBankAccountHolderName(),
            'name' => $beneficiary->getName(),
            'email' => $beneficiary->getEmail()
        ];

        if ($convertForUpdate) {
            return $common;
        }

        return $common + [
            'creator_contact_id' => $beneficiary->getCreatorContactId()
        ];
    }

    /**
     * @param stdClass $response
     * @param bool $fromValidate
     *
     * @return Beneficiary
     */
    private function createBeneficiaryFromResponse(stdClass $response, $fromValidate = false)
    {
        $beneficiary = new Beneficiary();

        $beneficiary->setBankCountry($response->bank_country)
            ->setCurrency($response->currency)
            ->setBeneficiaryCountry($response->beneficiary_country)
            ->setPaymentTypes($response->payment_types)
            ->setBankName($response->bank_name)
            ->setBankAddress($response->bank_address)
            ->setAccountNumber($response->account_number)
            ->setIban($response->iban)
            ->setBicSwift($response->bic_swift)
            ->setBankAccountType($response->bank_account_type)
            ->setBeneficiaryAddress($response->beneficiary_address)
            ->setBeneficiaryEntityType($response->beneficiary_entity_type)
            ->setBeneficiaryCompanyName($response->beneficiary_company_name)
            ->setBeneficiaryFirstName($response->beneficiary_first_name)
            ->setBeneficiaryLastName($response->beneficiary_last_name)
            ->setBeneficiaryCity($response->beneficiary_city)
            ->setBeneficiaryPostcode($response->beneficiary_postcode)
            ->setBeneficiaryStateOrProvince($response->beneficiary_state_or_province)
            ->setBeneficiaryDateOfBirth(
                (null !== $response->beneficiary_date_of_birth) ? new DateTime($response->beneficiary_date_of_birth) :
                    null
            )
            ->setBeneficiaryIdentificationType($response->beneficiary_identification_type)
            ->setBeneficiaryIdentificationValue($response->beneficiary_identification_value)
            ->setRoutingCodeType1($response->routing_code_type_1)
            ->setRoutingCodeValue1($response->routing_code_value_1)
            ->setRoutingCodeType2($response->routing_code_type_2)
            ->setRoutingCodeValue2($response->routing_code_value_2);

        if (!$fromValidate) {
            $beneficiary->setName($response->name)
                ->setCreatorContactId($response->creator_contact_id)
                ->setEmail($response->email)
                ->setIsDefaultBeneficiary('true' === $response->default_beneficiary)
                ->setBankAccountHolderName($response->bank_account_holder_name)
                ->setCreatedAt(new DateTime($response->created_at))
                ->setUpdatedAt(new DateTime($response->updated_at));
            $this->setIdProperty($beneficiary, $response->id);
        }

        return $beneficiary;
    }
}
