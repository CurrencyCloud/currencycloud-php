<?php

namespace CurrencyCloud;

use CurrencyCloud\EntryPoint\AccountsEntryPoint;
use CurrencyCloud\EntryPoint\AuthenticateEntryPoint;
use CurrencyCloud\EntryPoint\BalancesEntryPoint;
use CurrencyCloud\EntryPoint\BeneficiariesEntryPoint;
use CurrencyCloud\EntryPoint\ContactsEntryPoint;
use CurrencyCloud\EntryPoint\ConversionsEntryPoint;
use CurrencyCloud\EntryPoint\IbansEntryPoint;
use CurrencyCloud\EntryPoint\PayersEntryPoint;
use CurrencyCloud\EntryPoint\PaymentsEntryPoint;
use CurrencyCloud\EntryPoint\RatesEntryPoint;
use CurrencyCloud\EntryPoint\ReferenceEntryPoint;
use CurrencyCloud\EntryPoint\ReportsEntryPoint;
use CurrencyCloud\EntryPoint\SettlementsEntryPoint;
use CurrencyCloud\EntryPoint\TransactionsEntryPoint;
use CurrencyCloud\EntryPoint\TransfersEntryPoint;
use CurrencyCloud\EventDispatcher\Event\BeforeClientRequestEvent;
use CurrencyCloud\EventDispatcher\Event\ClientHttpErrorEvent;
use CurrencyCloud\EventDispatcher\Listener\BeforeClientRequestListener;
use CurrencyCloud\EventDispatcher\Listener\ClientHttpErrorListener;
use CurrencyCloud\EventDispatcher\Listener\SessionTimeoutListener;
use CurrencyCloud\Model\Transfer;
use CurrencyCloud\EntryPoint\VansEntryPoint;
use GuzzleHttp\Handler\CurlFactory;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use InvalidArgumentException;
use LogicException;
use Symfony\Component\EventDispatcher\EventDispatcher;

class CurrencyCloud
{

    /**
     * @var ReferenceEntryPoint
     */
    private $referenceEntryPoint;
    /**
     * @var Session
     */
    private $session;
    /**
     * @var AuthenticateEntryPoint
     */
    private $authenticateEntryPoint;
    /**
     * @var AccountsEntryPoint
     */
    private $accountsEntryPoint;
    /**
     * @var BalancesEntryPoint
     */
    private $balancesEntryPoint;
    /**
     * @var BeneficiariesEntryPoint
     */
    private $beneficiariesEntryPoint;
    /**
     * @var TransactionsEntryPoint
     */
    private $transactionsEntryPoint;
    /**
     * @var RatesEntryPoint
     */
    private $ratesEntryPoint;
    /**
     * @var PayersEntryPoint
     */
    private $payersEntryPoint;
    /**
     * @var IbansEntryPoint
     */
    private $ibansEntryPoint;
    /**
     * @var ConversionsEntryPoint
     */
    private $conversionsEntryPoint;
    /**
     * @var ContactsEntryPoint
     */
    private $contactsEntryPoint;
    /**
     * @var PaymentsEntryPoint
     */
    private $paymentsEntryPoint;
    /**
     * @var ReportsEntryPoint
     */
    private $reportsEntryPoint;
    /**
     * @var SettlementsEntryPoint
     */
    private $settlementsEntryPoint;
    /**
     * @var TransfersEntryPoint
     */
    private $transfersEntryPoint;
    /**
     * @var VansEntryPoint
     */
    private $vansEntryPoint;

    public static $SDK_VERSION = "1.5.2";

    /**
     * @param Session $session
     * @param AuthenticateEntryPoint $authenticateEntryPoint
     * @param AccountsEntryPoint $accountsEntryPoint
     * @param BalancesEntryPoint $balancesEntryPoint
     * @param BeneficiariesEntryPoint $beneficiariesEntryPoint
     * @param ContactsEntryPoint $contactsEntryPoint
     * @param ConversionsEntryPoint $conversionsEntryPoint
     * @param PayersEntryPoint $payersEntryPoint
     * @param IbansEntryPoint $ibansEntryPoint
     * @param PaymentsEntryPoint $paymentsEntryPoint
     * @param ReferenceEntryPoint $referenceEntryPoint
     * @param ReportsEntryPoint $reportsEntryPoint
     * @param RatesEntryPoint $ratesEntryPoint
     * @param SettlementsEntryPoint $settlementsEntryPoint
     * @param TransactionsEntryPoint $transactionsEntryPoint
     * @param TransfersEntryPoint $transfersEntryPoint
     * @param VansEntryPoint $vanEntryPoint
     */
    public function __construct(
        Session $session,
        AuthenticateEntryPoint $authenticateEntryPoint,
        AccountsEntryPoint $accountsEntryPoint,
        BalancesEntryPoint $balancesEntryPoint,
        BeneficiariesEntryPoint $beneficiariesEntryPoint,
        ContactsEntryPoint $contactsEntryPoint,
        ConversionsEntryPoint $conversionsEntryPoint,
        PayersEntryPoint $payersEntryPoint,
        IbansEntryPoint $ibansEntryPoint,
        PaymentsEntryPoint $paymentsEntryPoint,
        ReferenceEntryPoint $referenceEntryPoint,
        ReportsEntryPoint $reportsEntryPoint,
        RatesEntryPoint $ratesEntryPoint,
        SettlementsEntryPoint $settlementsEntryPoint,
        TransactionsEntryPoint $transactionsEntryPoint,
        TransfersEntryPoint $transfersEntryPoint,
        VansEntryPoint $vanEntryPoint
    ) {
        $this->referenceEntryPoint = $referenceEntryPoint;
        $this->session = $session;
        $this->authenticateEntryPoint = $authenticateEntryPoint;
        $this->accountsEntryPoint = $accountsEntryPoint;
        $this->balancesEntryPoint = $balancesEntryPoint;
        $this->beneficiariesEntryPoint = $beneficiariesEntryPoint;
        $this->transactionsEntryPoint = $transactionsEntryPoint;
        $this->ratesEntryPoint = $ratesEntryPoint;
        $this->payersEntryPoint = $payersEntryPoint;
        $this->ibansEntryPoint = $ibansEntryPoint;
        $this->conversionsEntryPoint = $conversionsEntryPoint;
        $this->contactsEntryPoint = $contactsEntryPoint;
        $this->paymentsEntryPoint = $paymentsEntryPoint;
        $this->reportsEntryPoint = $reportsEntryPoint;
        $this->settlementsEntryPoint = $settlementsEntryPoint;
        $this->transfersEntryPoint = $transfersEntryPoint;
        $this->vansEntryPoint = $vanEntryPoint;
    }

    /**
     * @param Session $session
     * @param Client|null $client
     *
     * @return CurrencyCloud
     */
    public static function createDefault(Session $session, Client $client = null)
    {
        if (null === $client) {
            $eventDispatcher = new EventDispatcher();

            $client = new Client($session, new \GuzzleHttp\Client([
                'sync' => true,
                'handler' => HandlerStack::create(new CurlHandler([
                    'handle_factory' => new CurlFactory(0)
                ]))
            ]), $eventDispatcher);

            $authenticateEntryPoint = new AuthenticateEntryPoint($session, $client);

            $eventDispatcher->addListener(ClientHttpErrorEvent::NAME, [
                    new ClientHttpErrorListener(), 'onClientHttpErrorEvent'
            ], -255);
            $eventDispatcher->addListener(ClientHttpErrorEvent::NAME, [
                new SessionTimeoutListener($client, $authenticateEntryPoint), 'onClientHttpErrorEvent'
            ], -254);
            $eventDispatcher->addListener(BeforeClientRequestEvent::NAME, [
                    new BeforeClientRequestListener($session, $authenticateEntryPoint), 'onBeforeClientRequestEvent'
            ], -255);
        } else {
            $authenticateEntryPoint = new AuthenticateEntryPoint($session, $client);
        }
        $entityManager = new SimpleEntityManager();
        return new CurrencyCloud(
            $session,
            $authenticateEntryPoint,
            new AccountsEntryPoint($entityManager, $client),
            new BalancesEntryPoint($client),
            new BeneficiariesEntryPoint($entityManager, $client),
            new ContactsEntryPoint($entityManager, $client),
            new ConversionsEntryPoint($client),
            new PayersEntryPoint($client),
            new IbansEntryPoint($entityManager, $client),
            new PaymentsEntryPoint($entityManager, $client),
            new ReferenceEntryPoint($client),
            new ReportsEntryPoint($entityManager, $client),
            new RatesEntryPoint($client),
            new SettlementsEntryPoint($entityManager, $client),
            new TransactionsEntryPoint($client),
            new TransfersEntryPoint($entityManager, $client),
            new VansEntryPoint($entityManager, $client)
        );
    }

    /**
     * @return AuthenticateEntryPoint
     */
    public function authenticate()
    {
        return $this->authenticateEntryPoint;
    }

    /**
     * @return AccountsEntryPoint
     */
    public function accounts()
    {
        return $this->accountsEntryPoint;
    }

    /**
     * @return BalancesEntryPoint
     */
    public function balances()
    {
        return $this->balancesEntryPoint;
    }

    /**
     * @return BeneficiariesEntryPoint
     */
    public function beneficiaries()
    {
        return $this->beneficiariesEntryPoint;
    }

    /**
     * @return ContactsEntryPoint
     */
    public function contacts()
    {
        return $this->contactsEntryPoint;
    }

    /**
     * @return ConversionsEntryPoint
     */
    public function conversions()
    {
        return $this->conversionsEntryPoint;
    }

    /**
     * @return PayersEntryPoint
     */
    public function payers()
    {
        return $this->payersEntryPoint;
    }

    /**
     * @return IbansEntryPoint
     */
    public function ibans()
    {
        return $this->ibansEntryPoint;
    }

    /**
     * @return PaymentsEntryPoint
     */
    public function payments()
    {
        return $this->paymentsEntryPoint;
    }

    /**
     * @return ReferenceEntryPoint
     */
    public function reference()
    {
        return $this->referenceEntryPoint;
    }

    /**
     * @return ReportsEntryPoint
     */
    public function reports()
    {
        return $this->reportsEntryPoint;
    }

    /**
     * @return RatesEntryPoint
     */
    public function rates()
    {
        return $this->ratesEntryPoint;
    }

    /**
     * @return SettlementsEntryPoint
     */
    public function settlements()
    {
        return $this->settlementsEntryPoint;
    }

    /**
     * @return TransactionsEntryPoint
     */
    public function transactions()
    {
        return $this->transactionsEntryPoint;
    }

    /**
     * @return TransfersEntryPoint
     */
    public function transfers()
    {
        return $this->transfersEntryPoint;
    }

    /**
     * @return VansEntryPoint
     */
    public function vans()
    {
        return $this->vansEntryPoint;
    }

    /**
     * @param $contactId
     * @param callable $callable
     *
     * @throws InvalidArgumentException When contact ID is not UUID
     * @throws LogicException If already in on-behalf-of call
     */
    public function onBehalfOf($contactId, callable $callable)
    {
        $this->session->setOnBehalfOf($contactId);

        try {
            call_user_func($callable, $this);
        } finally {
            $this->session->clearOnBehalfOf();
        }
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        return $this->session;
    }
}
