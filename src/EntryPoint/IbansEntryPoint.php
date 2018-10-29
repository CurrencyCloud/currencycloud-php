<?php
namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Criteria\FindIbansCriteria;
use CurrencyCloud\Model\Iban;
use CurrencyCloud\Model\Ibans;
use CurrencyCloud\Model\Pagination;
use DateTime;

class IbansEntryPoint extends AbstractEntityEntryPoint {

    /**
     * @param FindIbansCriteria $findIbansCriteria
     * @param Pagination $pagination
     * @return Ibans
     */
    public function find(FindIbansCriteria $findIbansCriteria, Pagination $pagination){
        if (null === $findIbansCriteria) {
            $findIbansCriteria = new FindIbansCriteria();
        }
        if (null === $pagination) {
            $pagination = new Pagination();
        }
        return $this->doFind('ibans/find', $findIbansCriteria, $pagination,
            function ($findIbansCriteria){
                return $this->convertIbansCriteriaToRequest($findIbansCriteria);
            },
            function ($response){
                return $this->convertResponseToIban($response);
            },
            function (array $entities, Pagination $pagination) {
                return new Ibans($entities, $pagination);
            },
            'ibans');
    }

    /**
     * @param FindIbansCriteria $findIbansCriteria
     * @return array
     */
    protected function convertIbansCriteriaToRequest(FindIbansCriteria $findIbansCriteria){
        $common = [
            'scope' => $findIbansCriteria->getScope(),
            'currency' => $findIbansCriteria->getCurrency(),
            'account_id' => $findIbansCriteria->getAccountId()
        ];

        return $common;
    }

    protected function convertResponseToIban($response) {
        $iban = new Iban();

        $this->setIdProperty($iban, $response->id, 'id');
        $iban->setAccountId($response->account_id);
        $iban->setIbanCode($response->iban_code);
        $iban->setCurrency($response->currency);
        $iban->setAccountHolderName($response->account_holder_name);
        $iban->setBankInstitutionName($response->bank_institution_name);
        $iban->setBankInstitutionAddress($response->bank_institution_address);
        $iban->setBankInstitutionCountry($response->bank_institution_country);
        $iban->setBicSwift($response->bic_swift);
        $iban->setCreatedAt($response->created_at);
        $iban->setUpdatedAt($response->updated_at);

        return $iban;
    }
}