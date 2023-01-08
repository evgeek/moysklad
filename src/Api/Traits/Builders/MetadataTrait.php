<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Traits\Builders;

use Evgeek\Moysklad\Api\Builders\Methods\Nested\Metadata;

trait MetadataTrait
{
    /**
     * Entity metadata
     * <code>
     * $product = $ms->entity()
     *      ->product()
     *      ->metadata()
     *      ->get();
     * </code>
     */
    public function metadata(): Metadata
    {
        $this->addPayloadToList();

        return new Metadata($this->api, $this->payloadList);
    }
}
