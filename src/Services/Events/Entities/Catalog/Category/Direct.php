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

namespace Shopgate\ConnectSdk\Services\Events\Entities\Catalog\Category;

use Dto\Exceptions\InvalidDataTypeException;
use Shopgate\ConnectSdk\Services\Events\DTO\Base as Payload;
use Shopgate\ConnectSdk\Services\Events\DTO\V1\Direct\Catalog\Categories;
use Shopgate\ConnectSdk\Services\Events\Entities;

class Direct implements Entities\DirectEntityInterface
{
    use Entities\EntityTrait;

    /**
     * @inheritDoc
     * @used-by \Shopgate\ConnectSdk\Services\Events\Connector\Entities\Catalog::__call()
     */
    public function update($entityId, Payload $payload, $meta = [])
    {
        $meta = array_merge(['service' => 'catalog'], $meta);

        return $this->client->request(
            'post',
            'categories/' . $entityId,
            ['json' => $payload->toJson(), 'query' => $meta]
        );
    }

    /**
     * @inheritDoc
     * @codeCoverageIgnore
     * @throws InvalidDataTypeException
     */
    public function create(Payload $payload, $meta = [])
    {
        $meta    = array_merge(['service' => 'catalog'], $meta);
        $request = new Categories();
        $request->set('categories', [$payload]);

        return $this->client->request(
            'post',
            'categories',
            ['json' => $request->toJson(), 'query' => $meta]
        );
    }

    /**
     * @inheritDoc
     * @codeCoverageIgnore
     */
    public function delete($entityId, $meta = [])
    {
        $meta = array_merge(['service' => 'catalog'], $meta);

        return $this->client->request(
            'delete',
            'categories/' . $entityId,
            ['json' => '{}', 'query' => $meta]
        );
    }

    /**
     * @inheritDoc
     * @codeCoverageIgnore
     */
    public function get(array $meta)
    {
        // todo-sg: Implement get() method.
    }
}
