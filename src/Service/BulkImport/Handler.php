<?php

/**
 * Copyright Shopgate Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @author    Shopgate Inc, 804 Congress Ave, Austin, Texas 78701 <interfaces@shopgate.com>
 * @copyright Shopgate Inc
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */

namespace Shopgate\ConnectSdk\Service\BulkImport;

use Psr\Http\Message\ResponseInterface;
use Shopgate\ConnectSdk\Exception\AuthenticationInvalidException;
use Shopgate\ConnectSdk\Exception\InvalidDataTypeException;
use Shopgate\ConnectSdk\Exception\NotFoundException;
use Shopgate\ConnectSdk\Exception\RequestException;
use Shopgate\ConnectSdk\Exception\UnknownException;
use Shopgate\ConnectSdk\Http\ClientInterface;

class Handler
{
    /** Define handler type */
    const HANDLER_TYPE = '';

    /** @var  ClientInterface */
    protected $client;

    /** @var  string */
    protected $importReference;

    /**
     * @param ClientInterface $client
     * @param string          $importReference
     */
    public function __construct(ClientInterface $client, $importReference)
    {
        $this->client = $client;
        $this->importReference = $importReference;
    }

    /**
     * @param string $catalogCode
     *
     * @return Feed\Category
     *
     * @throws AuthenticationInvalidException
     * @throws NotFoundException
     * @throws RequestException
     * @throws UnknownException
     * @throws InvalidDataTypeException
     */
    public function createCategoryFeed($catalogCode)
    {
        return new Feed\Category(
            $this->client,
            $this->importReference,
            $this::HANDLER_TYPE,
            [
                'entity' => 'category',
                'catalogCode' => $catalogCode
            ]
        );
    }

    /**
     * @param string $catalogCode
     *
     * @return Feed\Product
     *
     * @throws AuthenticationInvalidException
     * @throws NotFoundException
     * @throws RequestException
     * @throws UnknownException
     * @throws InvalidDataTypeException
     */
    public function createProductFeed($catalogCode)
    {
        return new Feed\Product(
            $this->client,
            $this->importReference,
            $this::HANDLER_TYPE,
            [
                'entity' => 'product',
                'catalogCode' => $catalogCode
            ]
        );
    }

    /**
     * @param string $catalogCode
     *
     * @return Feed\Attribute
     *
     * @throws AuthenticationInvalidException
     * @throws NotFoundException
     * @throws RequestException
     * @throws UnknownException
     * @throws InvalidDataTypeException
     */
    public function createAttributeFeed($catalogCode)
    {
        return new Feed\Attribute(
            $this->client,
            $this->importReference,
            $this::HANDLER_TYPE,
            [
                'entity' => 'attribute',
                'catalogCode' => $catalogCode
            ]
        );
    }

    /**
     * @return Feed\Inventory
     *
     * @throws AuthenticationInvalidException
     * @throws NotFoundException
     * @throws RequestException
     * @throws UnknownException
     * @throws InvalidDataTypeException
     */
    public function createInventoryFeed()
    {
        return new Feed\Inventory(
            $this->client,
            $this->importReference,
            $this::HANDLER_TYPE,
            ['entity' => 'inventory']
        );
    }

    /**
     * @param string $catalogCode
     *
     * @return Feed\Customer
     *
     * @throws AuthenticationInvalidException
     * @throws NotFoundException
     * @throws RequestException
     * @throws UnknownException
     */
    public function createCustomerFeed($catalogCode)
    {
        return new Feed\Customer(
            $this->client,
            $this->importReference,
            $this::HANDLER_TYPE,
            array_merge(['entity' => 'customer'], ['catalogCode' => $catalogCode])
        );
    }

    /**
     * @return ResponseInterface
     *
     * @throws AuthenticationInvalidException
     * @throws NotFoundException
     * @throws RequestException
     * @throws UnknownException
     * @throws InvalidDataTypeException
     */
    public function trigger()
    {
        $response = $this->client->doRequest(
            [
                // general
                'method' => 'post',
                'json' => [],
                'requestType' => 'direct',
                'service' => 'import',
                'path' => 'imports/' . $this->importReference,
            ]
        );

        return $response;
    }
}
