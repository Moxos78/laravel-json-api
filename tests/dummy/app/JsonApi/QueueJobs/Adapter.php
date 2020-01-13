<?php
/**
 * Copyright 2020 Cloud Creativity Limited
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

namespace DummyApp\JsonApi\QueueJobs;

use CloudCreativity\LaravelJsonApi\Eloquent\AbstractAdapter;
use CloudCreativity\LaravelJsonApi\Queue\ClientJob;
use Illuminate\Support\Collection;

class Adapter extends AbstractAdapter
{

    /**
     * ClientJobAdapter constructor.
     */
    public function __construct()
    {
        parent::__construct(new ClientJob());
    }

    /**
     * @inheritDoc
     */
    protected function filter($query, Collection $filters)
    {
        // TODO: Implement filter() method.
    }

}
