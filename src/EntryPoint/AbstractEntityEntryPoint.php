<?php

namespace CurrencyCloud\EntryPoint;

use CurrencyCloud\Client;
use CurrencyCloud\Model\EntityInterface;
use CurrencyCloud\Model\PaginatedData;
use CurrencyCloud\Model\Pagination;
use CurrencyCloud\SimpleEntityManager;

abstract class AbstractEntityEntryPoint extends AbstractEntryPoint
{

    /**
     * @var SimpleEntityManager
     */
    protected $entityManager;

    /**
     * @param SimpleEntityManager $entityManager
     * @param Client $client
     */
    public function __construct(SimpleEntityManager $entityManager, Client $client)
    {
        parent::__construct($client);
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $entryPoint
     * @param EntityInterface $entity
     * @param callable $converterToRequest
     * @param callable $converterFromResponse
     * @param null|string $onBehalfOf
     *
     * @return EntityInterface
     */
    protected function doCreate(
        $entryPoint,
        EntityInterface $entity,
        callable $converterToRequest,
        callable $converterFromResponse,
        $onBehalfOf = null
    ) {

        $response = $this->request(
            'POST',
            $entryPoint,
            [],
            call_user_func($converterToRequest, $entity, $onBehalfOf)
        );
        $entity = call_user_func($converterFromResponse, $response);
        $this->entityManager->add($entity);
        return $entity;
    }

    /**
     * @param string $entryPoint
     * @param EntityInterface $entity
     * @param callable $converterFromResponse
     * @param null|string $onBehalfOf
     *
     * @return EntityInterface
     */
    protected function doDelete(
        $entryPoint,
        EntityInterface $entity,
        callable $converterFromResponse,
        $onBehalfOf = null
    ) {
        $response = $this->request(
            'POST',
            $entryPoint,
            [],
            [
                'on_behalf_of' => $onBehalfOf
            ]
        );
        $this->entityManager->remove($entity);
        return call_user_func($converterFromResponse, $response);
    }

    /**
     * @param string $entryPoint
     * @param callable $converterFromResponse
     * @param null|string $onBehalfOf
     *
     * @return EntityInterface
     */
    protected function doRetrieve($entryPoint, callable $converterFromResponse, $onBehalfOf = null)
    {
        $response = $this->request(
            'GET',
            $entryPoint,
            [
                'on_behalf_of' => $onBehalfOf
            ]
        );
        $entity = call_user_func($converterFromResponse, $response);

        $this->entityManager->add($entity);

        return $entity;
    }

    /**
     * @param string $entryPoint
     * @param EntityInterface $searchModel
     * @param Pagination $pagination
     * @param callable $converterToRequest
     * @param callable $converterFromResponse
     * @param callable $collectionConverter
     * @param string $property
     * @param null|string $onBehalfOf
     *
     * @return PaginatedData
     */
    protected function doFind(
        $entryPoint,
        EntityInterface $searchModel,
        Pagination $pagination,
        callable $converterToRequest,
        callable $converterFromResponse,
        callable $collectionConverter,
        $property,
        $onBehalfOf = null
    ) {

        $response = $this->request(
            'GET',
            $entryPoint,
            call_user_func($converterToRequest, $searchModel, $onBehalfOf) + $this->convertPaginationToRequest(
                $pagination
            )
        );
        $beneficiaries = [];
        foreach ($response->$property as $searchModel) {
            $entity = call_user_func($converterFromResponse, $searchModel);
            $this->entityManager->add($entity);
            $beneficiaries[] = $entity;
        }
        return call_user_func($collectionConverter, $beneficiaries, $this->createPaginationFromResponse($response));
    }

    /**
     * @param string $entryPoint
     * @param EntityInterface $entity
     * @param callable $converterToRequest
     * @param callable $converterFromResponse
     * @param null|string $onBehalfOf
     *
     * @return EntityInterface
     */
    protected function doUpdate(
        $entryPoint,
        EntityInterface $entity,
        callable $converterToRequest,
        callable $converterFromResponse,
        $onBehalfOf = null
    ) {
        $changeSet = $this->entityManager->computeChangeSet($entity);
        if (null === $changeSet) {
            return $entity;
        }
        $response = $this->request(
            'POST',
            $entryPoint,
            [],
            call_user_func($converterToRequest, $changeSet, $onBehalfOf)
        );
        $newEntity = call_user_func($converterFromResponse, $response);

        $this->entityManager->remove($entity);
        $this->entityManager->add($newEntity);

        return $newEntity;
    }
}
