<?php
namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Criteria\ConversionReportCriteria;
use CurrencyCloud\Criteria\PaymentReportCriteria;
use CurrencyCloud\Criteria\FindReportsCriteria;
use CurrencyCloud\Model\Conversion;
use CurrencyCloud\Model\Pagination;
use CurrencyCloud\Model\Report;
use CurrencyCloud\Model\Reports;
use DateTime;
use stdClass;

class ReportsEntryPoint extends AbstractEntityEntryPoint
{
    /**
     * @param ConversionReportCriteria $conversionReportCriteria
     * @param null|string $onBehalfOf
     *
     * @return Report
     */
    public function createConversionReport(ConversionReportCriteria $conversionReportCriteria, $onBehalfOf = null)
    {
        return $this->doCreate('reports/conversions/create', $conversionReportCriteria, function ($conversionReportCriteria) {
            return $this->convertConversionReportCriteriaToRequest($conversionReportCriteria);
        }, function ($response) {
            return $this->createReportFromResponse($response);
        }, $onBehalfOf);
    }

    /**
     * @param ConversionReportCriteria $conversionReportCriteria
     *
     * @return array
     */
    protected function convertConversionReportCriteriaToRequest(ConversionReportCriteria $conversionReportCriteria)
    {
        $common = [
            'on_behalf_of' => $conversionReportCriteria->getOnBehalfOf(),
            'description' => $conversionReportCriteria->getDescription(),
            'buy_currency' => $conversionReportCriteria->getBuyCurrency(),
            'sell_currency' => $conversionReportCriteria->getSellCurrency(),
            'client_buy_amount_from' => $conversionReportCriteria->getClientBuyAmountFrom(),
            'client_buy_amount_to' => $conversionReportCriteria->getClientBuyAmountTo(),
            'client_sell_amount_from' => $conversionReportCriteria->getClientSellAmountFrom(),
            'client_sell_amount_to' => $conversionReportCriteria->getClientSellAmountTo(),
            'partner_buy_amount_from' => $conversionReportCriteria->getPartnerBuyAmountFrom(),
            'partner_buy_amount_to' => $conversionReportCriteria->getPartnerBuyAmountTo(),
            'partner_sell_amount_from' => $conversionReportCriteria->getPartnerSellAmountFrom(),
            'partner_sell_amount_to' => $conversionReportCriteria->getPartnerSellAmountTo(),
            'client_status' => $conversionReportCriteria->getClientStatus(),
            'partner_status' => $conversionReportCriteria->getPartnerStatus(),
            'conversion_date_from' => $conversionReportCriteria->getConversionDateFrom(),
            'conversion_date_to' => $conversionReportCriteria->getConversionDateTo(),
            'settlement_date_from' => $conversionReportCriteria->getSettlementDateFrom(),
            'settlement_date_to' => $conversionReportCriteria->getSettlementDateTo(),
            'created_at_from' => $conversionReportCriteria->getCreatedAtFrom(),
            'created_at_to' => $conversionReportCriteria->getCreatedAtTo(),
            'updated_at_from' => $conversionReportCriteria->getUpdatedAtFrom(),
            'updated_at_to' => $conversionReportCriteria->getUpdatedAtTo(),
            'unique_request_id' => $conversionReportCriteria->getUniqueRequestId(),
            'scope' => $conversionReportCriteria->getScope()
        ];

        return $common;
    }

    /**
     * @param PaymentReportCriteria $paymentReportCriteria
     * @param null|string $onBehalfOf
     *
     * @return Report
     */
    public function createPaymentReport(PaymentReportCriteria $paymentReportCriteria, $onBehalfOf = null)
    {
        return $this->doCreate('reports/payments/create', $paymentReportCriteria, function ($paymentReportCriteria) {
            return $this->convertPaymentReportCriteriaToRequest($paymentReportCriteria);
        }, function ($response) {
            return $this->createReportFromResponse($response);
        }, $onBehalfOf);
    }

    /**
     * @param PaymentReportCriteria $paymentReportCriteria
     *
     * @return array
     */
    protected function convertPaymentReportCriteriaToRequest(PaymentReportCriteria $paymentReportCriteria)
    {
        $common = [
            'on_behalf_of' => $paymentReportCriteria->getOnBehalfOf(),
            'description' => $paymentReportCriteria->getDescription(),
            'currency' => $paymentReportCriteria->getCurrency(),
            'amount_from' => $paymentReportCriteria->getAmountFrom(),
            'amount_to' => $paymentReportCriteria->getAmountTo(),
            'status' => $paymentReportCriteria->getStatus(),
            'payment_date_from' => $paymentReportCriteria->getPaymentDateFrom(),
            'payment_date_to' => $paymentReportCriteria->getPaymentDateTo(),
            'transfered_at_from' => $paymentReportCriteria->getTransferedAtFrom(),
            'transfered_at_to' => $paymentReportCriteria->getTransferedAtTo(),
            'created_at_from' => $paymentReportCriteria->getCreatedAtFrom(),
            'created_at_to' => $paymentReportCriteria->getCreatedAtTo(),
            'updated_at_from' => $paymentReportCriteria->getUpdatedAtFrom(),
            'updated_at_to' => $paymentReportCriteria->getUpdatedAtTo(),
            'beneficiary_id' => $paymentReportCriteria->getBeneficiaryId(),
            'conversion_id' => $paymentReportCriteria->getConversionId(),
            'with_deleted' => $paymentReportCriteria->getWithDeleted(),
            'payment_group_id' => $paymentReportCriteria->getPaymentGroupId(),
            'unique_request_id' => $paymentReportCriteria->getUniqueRequestId(),
            'scope' => $paymentReportCriteria->getScope()
        ];

        return $common;
    }

    /**
     * @param FindReportsCriteria $findReportsCriteria
     * @param PAgination $pagination
     * @param null|string $onBehalfOf
     *
     * @return Reports
     */
    public function findReports(
        FindReportsCriteria $findReportsCriteria,
        Pagination $pagination,
        $onBehalfOf = null)
    {
        if (null === $findReportsCriteria) {
            $report = new FindReportsCriteria();
        }
        if (null === $pagination) {
            $pagination = new Pagination();
        }
        return $this->doFind('reports/report_requests/find', $findReportsCriteria, $pagination, function ($findReportsCriteria) {
            return $this->convertFindReportsCriteriaToRequest($findReportsCriteria);
        }, function ($response) {
            return $this->createReportFromResponse($response);
        }, function (array $entities, Pagination $pagination) {
            return new Reports($entities, $pagination);
        }, 'report_requests',$onBehalfOf);
    }

    /**
     * @param FindReportsCriteria $findReportsCriteria
     *
     * @return array
     */
    protected function convertFindReportsCriteriaToRequest(FindReportsCriteria $findReportsCriteria)
    {
        $common = [
            'short_reference' => $findReportsCriteria->getShortReference(),
            'description' => $findReportsCriteria->getDescription(),
            'account_id' => $findReportsCriteria->getAccountId(),
            'contact_id' => $findReportsCriteria->getContactId(),
            'created_at_from' => $findReportsCriteria->getCreatedAtFrom(),
            'created_at_to' => $findReportsCriteria->getCreatedAtTo(),
            'expiration_date_from' => $findReportsCriteria->getExpirationDateFrom(),
            'expiration_date_to' => $findReportsCriteria->getExpirationDateTo(),
            'status' => $findReportsCriteria->getStatus(),
            'report_type' => $findReportsCriteria->getReportType()
        ];

        return $common;
    }

    /**
     * @param string $id
     * @param null|string $onBehalfOf
     *
     * @return Report
     */
    public function retrieve($id, $onBehalfOf = null)
    {
        return $this->doRetrieve(sprintf('reports/report_requests/%s', $id),
            function ($response) {
                return $this->createReportFromResponse($response);
        }, $onBehalfOf);
    }

    /**
     * @param stdClass $response
     *
     * @return Report
     */
    protected function createReportFromResponse(stdClass $response)
    {
        $report = new Report();

        $this->setIdProperty($report, $response->id);
        $report->setShortReference($response->short_reference)
            ->setDescription($response->description)
            ->setSearchParams($response->search_params)
            ->setReportType($response->report_type)
            ->setStatus($response->status)
            ->setFailureReason($response->failure_reason)
            ->setExpirationDate($this->getDateTimeOrNullFromString($response->expiration_date))
            ->setReportUrl($response->report_url)
            ->setAccountId($response->account_id)
            ->setContactId($response->contact_id)
            ->setCreatedAt($this->getDateTimeOrNullFromString($response->created_at))
            ->setUpdatedAt($this->getDateTimeOrNullFromString($response->updated_at));

        return $report;
    }
}

