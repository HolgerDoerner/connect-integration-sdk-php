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

namespace Shopgate\ConnectSdk\Tests\Unit\Services\Events;

use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit\Framework\TestCase;
use Shopgate\ConnectSdk\Http\GuzzleClient;
use Shopgate\ConnectSdk\Services\Events\Client;
use Shopgate\ConnectSdk\Services\Events\Connector\Entities\Base;
use Shopgate\ConnectSdk\Services\Events\Connector\Entities\Catalog;
use Shopgate\ConnectSdk\Services\Events\DTO\V1\Payload\Catalog\Category as CategoryDto;

/**
 * @coversDefaultClass \Shopgate\ConnectSdk\Services\Events\Client
 */
class ClientTest extends TestCase
{
    /**
     * @var MockBuilder
     */
    protected $httpClient;

    /**
     * Set up needed objects
     */
    protected function setUp()
    {
        $this->httpClient = $this->getMockBuilder(GuzzleClient::class)->disableOriginalConstructor();
    }

    /**
     * Tests the magic getter for catalog
     *
     * @covers \Shopgate\ConnectSdk\Services\Events\Client
     * @covers \Shopgate\ConnectSdk\Services\Events\Connector\Entities\Base
     * @covers \Shopgate\ConnectSdk\Services\Events\Connector\Entities\Catalog
     */
    public function testGetCatalog()
    {
        $subjectUnderTest = new Client([]);
        /** @noinspection PhpParamsInspection */
        $this->assertInstanceOf(Catalog::class, $subjectUnderTest->catalog);
    }

    /**
     * Checking the basic routing, more complicated tests should be done per class
     */
    public function testGetCatalogActions()
    {
        $mock             = $this->httpClient->getMock();
        $subjectUnderTest = new Client(['http_client' => $mock]);
        /** @noinspection PhpParamsInspection */
        $mock->expects($this->exactly(6))->method('request');
        $subjectUnderTest->catalog->updateCategory(1, new CategoryDto());
        $subjectUnderTest->catalog->updateCategory(1, new CategoryDto(), [Base::KEY_TYPE => Base::SYNC]);
        $subjectUnderTest->catalog->createCategory(new CategoryDto());
        $subjectUnderTest->catalog->createCategory(new CategoryDto(), [Base::KEY_TYPE => Base::SYNC]);
        $subjectUnderTest->catalog->deleteCategory('1');
        $subjectUnderTest->catalog->deleteCategory('1', [Base::KEY_TYPE => Base::SYNC]);
    }
}
