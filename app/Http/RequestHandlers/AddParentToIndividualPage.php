<?php

/**
 * webtrees: online genealogy
 * Copyright (C) 2021 webtrees development team
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

namespace Fisharebest\Webtrees\Http\RequestHandlers;

use Fisharebest\Webtrees\Auth;
use Fisharebest\Webtrees\Fact;
use Fisharebest\Webtrees\Http\ViewResponseTrait;
use Fisharebest\Webtrees\I18N;
use Fisharebest\Webtrees\Registry;
use Fisharebest\Webtrees\SurnameTradition;
use Fisharebest\Webtrees\Tree;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function array_map;
use function assert;
use function is_string;
use function route;

/**
 * Add a new parent to an individual, creating a one-parent family.
 */
class AddParentToIndividualPage implements RequestHandlerInterface
{
    use ViewResponseTrait;

    /**
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $tree = $request->getAttribute('tree');
        assert($tree instanceof Tree);

        $xref = $request->getAttribute('xref');
        assert(is_string($xref));

        $sex = $request->getAttribute('sex');
        assert(is_string($xref));

        $individual = Registry::individualFactory()->make($xref, $tree);
        $individual = Auth::checkIndividualAccess($individual, true);

        // Create a dummy individual, so that we can create new/empty facts.
        $dummy   = Registry::individualFactory()->new('', '0 @@ INDI', null, $tree);

        // Default names facts.
        $surname_tradition = SurnameTradition::create($tree->getPreference('SURNAME_TRADITION'));
        $names             = $surname_tradition->newParentNames($individual, $sex);
        $name_facts        = array_map(fn (string $gedcom): Fact => new Fact($gedcom, $dummy, ''), $names);

        $facts   = [
            'i' => [
                new Fact('1 SEX ' . $sex, $dummy, ''),
                ...$name_facts,
                new Fact('1 BIRT', $dummy, ''),
                new Fact('1 DEAT', $dummy, ''),
            ],
        ];

        if ($sex === 'F') {
            $title = I18N::translate('Add a mother');
        } else {
            $title = I18N::translate('Add a father');
        }

        return $this->viewResponse('edit/new-individual', [
            'cancel_url' => $individual->url(),
            'facts'      => $facts,
            'post_url'   => route(AddParentToIndividualAction::class, ['tree' => $tree->name(), 'xref' => $xref]),
            'title'      => $individual->fullName() . ' - ' . $title,
            'tree'       => $tree,
            'url'        => $request->getQueryParams()['url'] ?? $individual->url(),
        ]);
    }
}
