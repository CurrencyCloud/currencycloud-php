<?php

namespace CurrencyCloud\Tests\EntryPoint;

use CurrencyCloud\EntryPoint\ContactsEntryPoint;
use CurrencyCloud\Model\Contact;
use CurrencyCloud\SimpleEntityManager;
use CurrencyCloud\Tests\BaseCurrencyCloudTestCase;
use DateTime;

class ContactsEntryPointTest extends BaseCurrencyCloudTestCase
{

    /**
     * @test
     */
    public function canResetTokenWithoutLoginId()
    {
        $entryPoint = new ContactsEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
            null,
            'POST',
            'contacts/reset_token/create',
            [],
            [
                'login_id' => null
            ]
        ));

        $entryPoint->createResetToken();
    }

    /**
     * @test
     */
    public function canResetTokenWithLoginId()
    {
        $entryPoint = new ContactsEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
            null,
            'POST',
            'contacts/reset_token/create',
            [],
            [
                'login_id' => 'hi-dude'
            ]
        ));

        $entryPoint->createResetToken('hi-dude');
    }

    /**
     * @test
     */
    public function canCreateWithRequiredValues()
    {
        $data = '{"login_id":"john.smith","id":"543477161-91de-012f-e284-1e0030c7f352","your_reference":"ACME12345","first_name":"John","last_name":"Smith","account_id":"87077161-91de-012f-e284-1e0030c7f352","account_name":"Company PLC","status":"enabled","phone_number":"06554 87845","mobile_phone_number":"07564 534 54","locale":"en-US","timezone":"Europe/London","email_address":"john.smith@company.com","date_of_birth":"1980-01-22","created_at":"2014-01-12T00:00:00+00:00","updated_at":"2014-01-12T00:00:00+00:00"}';

        $entryPoint = new ContactsEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'POST',
            'contacts/create',
            [],
            [
                'account_id' => 'A',
                'first_name' => 'B',
                'last_name' => 'C',
                'email_address' => 'D',
                'phone_number' => 'E',
                'account_name' => null,
                'your_reference' => null,
                'login_id' => null,
                'status' => null,
                'timezone' => null,
                'locale' => null,
                'date_of_birth' => null,
                'mobile_phone_number' => null,
                'on_behalf_of' => null
            ]
        ));

        $contact = Contact::create('A', 'B', 'C', 'D', 'E');

        $contact = $entryPoint->create($contact);

        $this->validateObjectStrictName($contact, json_decode($data, true));
    }

    /**
     * @test
     */
    public function canCreateWithAllValues()
    {
        $data = '{"login_id":"john.smith","id":"543477161-91de-012f-e284-1e0030c7f352","your_reference":"ACME12345","first_name":"John","last_name":"Smith","account_id":"87077161-91de-012f-e284-1e0030c7f352","account_name":"Company PLC","status":"enabled","phone_number":"06554 87845","mobile_phone_number":"07564 534 54","locale":"en-US","timezone":"Europe/London","email_address":"john.smith@company.com","date_of_birth":"1980-01-22","created_at":"2014-01-12T00:00:00+00:00","updated_at":"2014-01-12T00:00:00+00:00"}';

        $date = new DateTime();

        $entryPoint = new ContactsEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'POST',
            'contacts/create',
            [],
            [
                'account_id' => 'A',
                'first_name' => 'B',
                'last_name' => 'C',
                'email_address' => 'D',
                'phone_number' => 'E',
                'account_name' => 'F',
                'your_reference' => 'G',
                'mobile_phone_number' => 'H',
                'login_id' => 'I',
                'status' => 'J',
                'timezone' => 'K',
                'locale' => 'L',
                'date_of_birth' => $date->format('Y-m-d'),
                'on_behalf_of' => null
            ]
        ));

        $contact = Contact::create('A', 'B', 'C', 'D', 'E')
            ->setAccountName('F')
            ->setYourReference('G')
            ->setMobilePhoneNumber('H')
            ->setLoginId('I')
            ->setStatus('J')
            ->setTimezone('K')
            ->setLocale('L')
            ->setDateOfBirth($date);

        $contact = $entryPoint->create($contact);

        $this->validateObjectStrictName($contact, json_decode($data, true));
    }

    /**
     * @test
     */
    public function canFindWhenAllParamsAreNull()
    {
        $data = '{"contacts":[{"login_id":"john.smith","id":"543477161-91de-012f-e284-1e0030c7f352","your_reference":"ACME12345","first_name":"John","last_name":"Smith","account_id":"87077161-91de-012f-e284-1e0030c7f352","account_name":"Company PLC","status":"enabled","phone_number":"06554 87845","mobile_phone_number":"07564 534 54","locale":"en-US","timezone":"Europe/London","email_address":"john.smith@company.com","date_of_birth":"1980-01-22","created_at":"2014-01-12T00:00:00+00:00","updated_at":"2014-01-12T00:00:00+00:00"}],"pagination":{"total_entries":1,"total_pages":1,"current_page":1,"per_page":25,"previous_page":-1,"next_page":2,"order":"created_at","order_asc_desc":"asc"}}';


        $entryPoint = new ContactsEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'POST',
            'contacts/find',
            [],
            [
                'account_id' => null,
                'first_name' => null,
                'last_name' => null,
                'email_address' => null,
                'phone_number' => null,
                'account_name' => null,
                'your_reference' => null,
                'login_id' => null,
                'status' => null,
                'timezone' => null,
                'locale' => null
            ] + $this->getDummyPaginationRequest()
        ));

        $items = $entryPoint->find();

        $this->assertArrayHasKey(0, $items->getContacts());
        $this->validateObjectStrictName($items->getContacts()[0], json_decode($data, true)['contacts'][0]);
    }

    /**
     * @test
     */
    public function canFindWhenAllParamsAreSet()
    {
        $data = '{"contacts":[{"login_id":"john.smith","id":"543477161-91de-012f-e284-1e0030c7f352","your_reference":"ACME12345","first_name":"John","last_name":"Smith","account_id":"87077161-91de-012f-e284-1e0030c7f352","account_name":"Company PLC","status":"enabled","phone_number":"06554 87845","mobile_phone_number":"07564 534 54","locale":"en-US","timezone":"Europe/London","email_address":"john.smith@company.com","date_of_birth":"1980-01-22","created_at":"2014-01-12T00:00:00+00:00","updated_at":"2014-01-12T00:00:00+00:00"}],"pagination":{"total_entries":1,"total_pages":1,"current_page":1,"per_page":25,"previous_page":-1,"next_page":2,"order":"created_at","order_asc_desc":"asc"}}';


        $entryPoint = new ContactsEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'POST',
            'contacts/find',
            [],
            [
                'account_id' => 'A',
                'first_name' => 'B',
                'last_name' => 'C',
                'email_address' => 'D',
                'phone_number' => 'E',
                'account_name' => 'F',
                'your_reference' => 'G',
                'login_id' => 'I',
                'status' => 'J',
                'timezone' => 'K',
                'locale' => 'L',
            ] + $this->getDummyPaginationRequest()
        ));

        $contact = Contact::create('A', 'B', 'C', 'D', 'E')
            ->setAccountName('F')
            ->setYourReference('G')
            ->setLoginId('I')
            ->setStatus('J')
            ->setTimezone('K')
            ->setLocale('L');

        $entryPoint->find($contact);

    }

    /**
     * @test
     */
    public function canRetrieve()
    {
        $data = '{"login_id":"john.smith","id":"543477161-91de-012f-e284-1e0030c7f352","your_reference":"ACME12345","first_name":"John","last_name":"Smith","account_id":"87077161-91de-012f-e284-1e0030c7f352","account_name":"Company PLC","status":"enabled","phone_number":"06554 87845","mobile_phone_number":"07564 534 54","locale":"en-US","timezone":"Europe/London","email_address":"john.smith@company.com","date_of_birth":"1980-01-22","created_at":"2014-01-12T00:00:00+00:00","updated_at":"2014-01-12T00:00:00+00:00"}';


        $entryPoint = new ContactsEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'GET',
            'contacts/hi',
            [
                'on_behalf_of' => null
            ]
        ));

        $item = $entryPoint->retrieve('hi');

        $this->validateObjectStrictName($item, json_decode($data, true));
    }

    /**
     * @test
     */
    public function canCurrent()
    {
        $data = '{"login_id":"john.smith","id":"543477161-91de-012f-e284-1e0030c7f352","your_reference":"ACME12345","first_name":"John","last_name":"Smith","account_id":"87077161-91de-012f-e284-1e0030c7f352","account_name":"Company PLC","status":"enabled","phone_number":"06554 87845","mobile_phone_number":"07564 534 54","locale":"en-US","timezone":"Europe/London","email_address":"john.smith@company.com","date_of_birth":"1980-01-22","created_at":"2014-01-12T00:00:00+00:00","updated_at":"2014-01-12T00:00:00+00:00"}';


        $entryPoint = new ContactsEntryPoint(new SimpleEntityManager(), $this->getMockedClient(
            json_decode($data),
            'GET',
            'contacts/current',
            [
                'on_behalf_of' => null
            ]
        ));

        $item = $entryPoint->current();

        $this->validateObjectStrictName($item, json_decode($data, true));
    }

    /**
     * @test
     */
    public function canUpdateWhenEverythingIsSet()
    {
        $data = '{"login_id":"john.smith","id":"543477161-91de-012f-e284-1e0030c7f352","your_reference":"ACME12345","first_name":"John","last_name":"Smith","account_id":"87077161-91de-012f-e284-1e0030c7f352","account_name":"Company PLC","status":"enabled","phone_number":"06554 87845","mobile_phone_number":"07564 534 54","locale":"en-US","timezone":"Europe/London","email_address":"john.smith@company.com","date_of_birth":"1980-01-22","created_at":"2014-01-12T00:00:00+00:00","updated_at":"2014-01-12T00:00:00+00:00"}';


        $date = new DateTime();

        $contact = Contact::create('A', 'B', 'C', 'D', 'E')
            ->setAccountName('F')
            ->setYourReference('G')
            ->setMobilePhoneNumber('H')
            ->setLoginId('I')
            ->setStatus('J')
            ->setTimezone('K')
            ->setLocale('L')
            ->setMobilePhoneNumber('H')
            ->setDateOfBirth($date);

        $this->setIdProperty($contact, 'hi');

        $manager = $this->getMockedEntityManager($contact, clone $contact);

        $entryPoint = new ContactsEntryPoint($manager, $this->getMockedClient(
            json_decode($data),
            'POST',
            'contacts/hi',
            [],
            [
                'account_id' => 'A',
                'first_name' => 'B',
                'last_name' => 'C',
                'email_address' => 'D',
                'phone_number' => 'E',
                'account_name' => 'F',
                'your_reference' => 'G',
                'mobile_phone_number' => 'H',
                'login_id' => 'I',
                'status' => 'J',
                'timezone' => 'K',
                'locale' => 'L',
                'date_of_birth' => $date->format('Y-m-d')
            ]
        ));

        $item = $entryPoint->update($contact);

        $this->validateObjectStrictName($item, json_decode($data, true));
    }
}
