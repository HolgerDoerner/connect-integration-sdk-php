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

namespace Shopgate\ConnectSdk\Services\Events;

use Exception;
use Shopgate\ConnectSdk\Http;
use Shopgate\ConnectSdk\Http\ClientInterface;
use Shopgate\ConnectSdk\Services\Events\Connector\Entities\Base;
use Shopgate\ConnectSdk\Services\Events\Exceptions\ClassNoExistException;

/**
 * @property-read Connector\Entities\Catalog catalog
 */
class Client
{
    /** @var ClientInterface */
    private $client;

    /**
     * Contains entities to use, e.g. catalog, product, media, etc.
     *
     * @var array
     */
    private $entities = [];

    /**
     * This client accepts the following options:
     *  - http_client (Http\ClientInterface, default=Http\GuzzleClient) - accepts a custom HTTP client if needed
     *  - http - holder for all HTTP Client configurations
     *      - auth (array) authentication data necessary for the client to make calls
     *
     * @param array $config
     *
     * @codeCoverageIgnore
     */
    public function __construct(array $config)
    {
        $configResolver       = new Config();
        $options              = $configResolver->resolveMainOptions($config);
        $httpOptions          = $configResolver->resolveHttpOptions($options['http']);
        $httpOptions['oauth'] = $configResolver->resolveHttpOauthOptions($httpOptions['oauth']);

        $this->client = null !== $options['http_client']
            ? $options['http_client']
            : new Http\GuzzleClient($httpOptions);
    }

    /** @noinspection MagicMethodsValidityInspection */
    /**
     * For redirecting calls like $sdk->catalog->... to the right connector, e.g Connector\Entities\Catalog
     *
     * @param string $name
     *
     * @return Base
     * @throws Exception
     */
    public function __get($name)
    {
        if (isset($this->entities[$name])) {
            return $this->entities[$name];
        }

        return $this->entities[$name] = $this->instantiateClass($name);
    }

    /**
     * A factory for connector classes
     *
     * @param string $name
     *
     * @return Base
     * @throws Exception
     */
    private function instantiateClass($name)
    {
        $class = 'Shopgate\ConnectSdk\Services\Events\Connector\Entities\\' . ucfirst($name);
        if (class_exists($class)) {
            return new $class($this->client);
        }
        throw new ClassNoExistException('Connector does not exist');
    }
}
