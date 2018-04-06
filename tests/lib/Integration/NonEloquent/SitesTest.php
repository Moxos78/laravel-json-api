<?php
/**
 * Copyright 2018 Cloud Creativity Limited
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
 */

namespace CloudCreativity\LaravelJsonApi\Tests\Integration\NonEloquent;

use CloudCreativity\LaravelJsonApi\Tests\Integration\TestCase;
use DummyApp\Entities\Site;
use DummyApp\Entities\SiteRepository;

class SitesTest extends TestCase
{

    /**
     * @var string
     */
    protected $resourceType = 'sites';

    public function testSearchAll()
    {
        $this->createSite(); // ensure there is at least one site.
        $this->doSearch()->assertSearchResponse();
    }

    public function testCreate()
    {
        $data = [
            'type' => 'sites',
            'id' => 'my-site',
            'attributes' => [
                'name' => 'My Blog',
                'domain' => 'http://blog.example.com',
            ],
        ];

        $id = $this->doCreate($data)->assertCreateResponse($data);
        $this->assertEquals('my-site', $id);

        return $data;
    }

    public function testRead()
    {
        $this->createSite();

        $expected = [
            'type' => 'sites',
            'id' => 'my-site',
            'attributes' => [
                'name' => 'My Blog',
                'domain' => 'http://blog.example.com',
            ],
        ];

        $this->doRead('my-site')->assertReadResponse($expected);
    }

    public function testUpdate()
    {
        $site = $this->createSite();

        $data = [
            'type' => 'sites',
            'id' => 'my-site',
            'attributes' => [
                'name' => 'My New Blog',
            ],
        ];

        $expected = $data;
        $expected['domain'] = $site->getDomain();

        $this->doUpdate($data)->assertUpdateResponse($expected);
    }

    public function testDelete()
    {
        $this->createSite();
        $this->doDelete('my-site')->assertDeleteResponse();
        $this->assertNull(app(SiteRepository::class)->find('my-site'));
    }

    /**
     * @return Site
     */
    private function createSite()
    {
        $site = Site::create('my-site', [
            'name' => 'My Blog',
            'domain' => 'http://blog.example.com',
        ]);

        app(SiteRepository::class)->store($site);

        return $site;
    }

}
