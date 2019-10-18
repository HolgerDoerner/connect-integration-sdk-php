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

namespace Shopgate\ConnectSdk\Dto\Catalog\Inventory;

use Shopgate\ConnectSdk\Dto\Catalog\Inventory;

/**
 * @method Update setProductCode(string $productCode)
 * @method Update setLocationCode(string $locationCode)
 * @method Update setBin(string $bin)
 * @method Update setBinLocation(string $binLocation)
 * @method Update setSku(string $sku)
 * @method Update setOperationType(string $operationType)
 * @method Update setOnHand(integer $onHand)
 */
class Update extends Inventory
{
    /**
     * @var array
     * @codeCoverageIgnore
     */
    protected $schema = [
        'type'                 => 'object',
        'properties' => [
            'productCode'   => ['type' => 'string'],
            'locationCode'  => ['type' => 'string'],
            'sku'           => ['type' => 'string'],
            'operationType' => ['type' => 'string'],
            'bin'           => ['type' => 'string'],
            'binLocation'   => ['type' => 'string'],
            'onHand'        => ['type' => 'integer'],
        ],
        'additionalProperties' => true,
    ];
}