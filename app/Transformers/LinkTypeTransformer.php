<?php
/**
 * LinkTypeTransformer.php
 * Copyright (c) 2018 thegrumpydictator@gmail.com
 *
 * This file is part of Firefly III.
 *
 * Firefly III is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Firefly III is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Firefly III. If not, see <http://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

namespace FireflyIII\Transformers;


use FireflyIII\Models\LinkType;
use Log;

/**
 *
 * Class LinkTypeTransformer
 */
class LinkTypeTransformer extends AbstractTransformer
{
    /**
     * CurrencyTransformer constructor.
     *
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        if ('testing' === config('app.env')) {
            Log::warning(sprintf('%s should not be instantiated in the TEST environment!', get_class($this)));
        }
    }

    /**
     * Transform the currency.
     *
     * @param LinkType $linkType
     *
     * @return array
     */
    public function transform(LinkType $linkType): array
    {
        $data = [
            'id'         => (int)$linkType->id,
            'created_at' => $linkType->created_at->toAtomString(),
            'updated_at' => $linkType->updated_at->toAtomString(),
            'name'       => $linkType->name,
            'inward'     => $linkType->inward,
            'outward'    => $linkType->outward,
            'editable'   => $linkType->editable,
            'links'      => [
                [
                    'rel' => 'self',
                    'uri' => '/link_types/' . $linkType->id,
                ],
            ],
        ];

        return $data;
    }
}
