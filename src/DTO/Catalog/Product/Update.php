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
 * @copyright 2019 Shopgate Inc
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */

namespace Shopgate\ConnectSdk\DTO\Catalog\Product;

use Shopgate\ConnectSdk\DTO\Base as DTOBase;

/**
 * Default class that handles validation for product Update payloads.
 *
 * @method Update setName(Name $name)
 * @method Update setLongName(LongName $longName)
 * @method Update setCategories(CategoryMapping [] $categories)
 * @method Update setProperties(Property [] $properties)
 * @method Update setMedia(LocalizationMedia $media)
 * @method Update setOptions(Option [] $options)
 * @method Update setExtras(Extra [] $extras)
 * @method Update setCode(string $code)
 * @method Update setParentProductCode(string $parentProductCode)
 * @method Update setCatalogCode(string $catalogCode)
 * @method Update setModelType(string $modelType)
 * @method Update setIdentifiers(Identifiers $identifiers)
 * @method Update setPrice(Price $price)
 * @method Update setFulfillmentMethods(string [] $fulfillmentMethods)
 * @method Update setUnit(string $unit)
 * @method Update setIsSerialized(boolean $isSerialized)
 * @method Update setStatus(string $status)
 * @method Update setStartDate(string $startDate)
 * @method Update setEndDate(string $endDate)
 * @method Update setFirstAvailableDate(string $firstAvailableDate)
 * @method Update setEolDate(string $eolDate)
 * @method Update setIsInventoryManaged(boolean $isInventoryManaged)
 * @method Update setInventoryTreatment(string $inventoryTreatment)
 * @method Update setShippingInformation(ShippingInformation $shippingInformation)
 * @method Update setRating(number $rating)
 * @method Update setUrl(string $url)
 * @method Update setIsTaxed(boolean $isTaxed)
 * @method Update setTaxClass(string $taxClass)
 * @method Update setMinQty(number $minQty)
 * @method Update setMaxQty(number $maxQty)
 * @method Update setExternalUpdateDate(string $externalUpdateDate)
 */
class Update extends DTOBase
{
    // todo-sg: outsource to a single place for update and create
    const MODEL_TYPE_STANDARD     = 'standard';
    const MODEL_TYPE_CONFIGURABLE = 'configurable';
    const MODEL_TYPE_BUNDLE       = 'bundle';
    const MODEL_TYPE_BUNDLE_ITEM  = 'bundleItem';
    const MODEL_TYPE_VARIANT      = 'variant';
    const STATUS_ACTIVE    = 'active';
    const STATUS_INACTIVE  = 'inactive';
    const STATUS_DELETED   = 'deleted';
    const STATUS_SCHEDULED = 'scheduled';
    const INVENTORY_TREATMENT_SHOW_OUT_OF_STOCK = 'showOutOfStock';
    const INVENTORY_TREATMENT_ALLOW_BACK_ORDERS = 'allowBackOrders';
    const INVENTORY_TREATMENT_PRE_ORDER         = 'preOrder';
    const FULFILLMENT_METHOD_SIMPLE_PICKUP_IN_STORE = 'simplePickUpInStore';
    const FULFILLMENT_METHOD_DIRECT_SHIP            = 'directShip';

    /**
     * @var array
     * @codeCoverageIgnore
     */
    protected $schema = [
        'type'                 => 'object',
        'properties'           => [
            'name'                => ['type' => 'object'],
            'longName'            => ['type' => 'object'],
            'categories'          => [
                'type'  => 'array',
                'items' => [
                    'type' => 'object',
                ],
            ], // todo-sg: double check properties after we get examples
            'properties'          => [
                'type'  => 'array',
                'items' => [
                    'type' => 'object',
                ],
            ],
            'media'               => ['type' => 'object'],
            'options'             => [
                'type'  => 'array',
                'items' => [
                    'type' => 'object',
                ],
            ],
            'extras'              => [
                'type'  => 'array',
                'items' => [
                    'type' => 'object',
                ],
            ],
            'code'                => ['type' => 'string'],
            'parentProductCode'   => ['type' => 'string'],
            'catalogCode'         => ['type' => 'string'],
            'modelType'           => ['type' => 'string'],
            'identifiers'         => ['type' => 'object'],
            'price'               => ['type' => 'object'],
            'fulfillmentMethods'  => [
                'type'  => 'array',
                'items' => [
                    'type' => 'string',
                ],
            ],
            'unit'                => ['type' => 'string'],
            'isSerialized'        => ['type' => 'boolean'],
            'status'              => ['type' => 'string'],
            'startDate'           => ['type' => 'string'],
            'endDate'             => ['type' => 'string'],
            'firstAvailableDate'  => ['type' => 'string'],
            'eolDate'             => ['type' => 'string'],
            'isInventoryManaged'  => ['type' => 'boolean'],
            'inventoryTreatment'  => ['type' => 'string'],
            'shippingInformation' => ['type' => 'object'],
            'rating'              => ['type' => 'number'],
            'url'                 => ['type' => 'string'],
            'isTaxed'             => ['type' => 'boolean'],
            'taxClass'            => ['type' => 'string'],
            'minQty'              => ['type' => 'number'],
            'maxQty'              => ['type' => 'number'],
            'externalUpdateDate'  => ['type' => 'string'],
        ],
        'additionalProperties' => true,
    ];
}