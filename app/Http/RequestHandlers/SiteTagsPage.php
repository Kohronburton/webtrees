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

use Fisharebest\Webtrees\Http\ViewResponseTrait;
use Fisharebest\Webtrees\I18N;
use Fisharebest\Webtrees\Registry;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Edit the tree preferences.
 */
class SiteTagsPage implements RequestHandlerInterface
{
    use ViewResponseTrait;

    /**
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->layout = 'layouts/administration';

        $element_factory = Registry::elementFactory();

        $preferences = [
            I18N::translate('Names')            => [
                '' => [
                    'NAME:NPFX' => $element_factory->make('INDI:NAME:NPFX'),
                    'NAME:SPFX' => $element_factory->make('INDI:NAME:SPFX'),
                    'NAME:NSFX' => $element_factory->make('INDI:NAME:NSFX'),
                    'NAME:NICK' => $element_factory->make('INDI:NAME:NICK'),
                    'NAME:FONE' => $element_factory->make('INDI:NAME:FONE'),
                    'NAME:ROMN' => $element_factory->make('INDI:NAME:ROMN'),
                    'NAME:NOTE' => $element_factory->make('INDI:NAME:NOTE'),
                    'NAME:SOUR' => $element_factory->make('INDI:NAME:SOUR'),
                ],
            ],
            I18N::translate('Places')           => [
                '' => [
                    'PLAC:MAP'  => $element_factory->make('INDI:*:PLAC:MAP'),
                    'PLAC:FONE' => $element_factory->make('INDI:*:PLAC:FONE'),
                    'PLAC:ROMN' => $element_factory->make('INDI:*:PLAC:ROMN'),
                    'PLAC:NOTE' => $element_factory->make('INDI:*:PLAC:NOTE'),
                ],
            ],
            I18N::translate('Addresses')        => [
                '' => [
                    'FAX'  => $element_factory->make('INDI:*:FAX'),
                    'PHON' => $element_factory->make('INDI:*:PHON'),
                    'WWW'  => $element_factory->make('INDI:*:WWW'),
                ],
            ],
            I18N::translate('Source citations') => [
                '' => [
                    'SOUR:EVEN'      => $element_factory->make('INDI:SOUR:EVEN'),
                    'SOUR:DATA:DATE' => $element_factory->make('INDI:SOUR:DATA:DATE'),
                    'SOUR:NOTE'      => $element_factory->make('INDI:SOUR:NOTE'),
                    'SOUR:QUAY'      => $element_factory->make('INDI:SOUR:QUAY'),
                ],
            ],
            I18N::translate('Individuals')      => [
                I18N::translate('')    => [
                    'INDI:BIRT:FAMC' => $element_factory->make('INDI:BIRT:FAMC'),
                ],
                I18N::translate('Religion')    => [
                    'INDI:RELI' => $element_factory->make('INDI:RELI'),
                    'INDI:BAPM' => $element_factory->make('INDI:BAPM'),
                    'INDI:CHR'  => $element_factory->make('INDI:CHR'),
                    'INDI:CHRA' => $element_factory->make('INDI:CHRA'),
                    'INDI:FCOM' => $element_factory->make('INDI:FCOM'),
                    'INDI:CONF' => $element_factory->make('INDI:CONF'),
                    'INDI:ORDN' => $element_factory->make('INDI:ORDN'),
                    'INDI:BARM' => $element_factory->make('INDI:BARM'),
                    'INDI:BASM' => $element_factory->make('INDI:BASM'),
                ],
                I18N::translate('Identifiers') => [
                    'INDI:AFN'  => $element_factory->make('INDI:AFN'),
                    'INDI:IDNO' => $element_factory->make('INDI:IDNO'),
                    'INDI:SSN'  => $element_factory->make('INDI:SSN'),
                ],
                I18N::translate('Submitters')  => [
                    'FAM:SUBM'  => $element_factory->make('FAM:SUBM'),
                    'INDI:SUBM' => $element_factory->make('INDI:SUBM'),
                    'INDI:ANCI' => $element_factory->make('INDI:ANCI'),
                    'INDI:DESI' => $element_factory->make('INDI:DESI'),
                ],
                I18N::translate('Links')       => [
                    'INDI:ALIA' => $element_factory->make('INDI:ALIA'),
                    'INDI:ASSO' => $element_factory->make('INDI:ASSO'),
                ],
            ],
            I18N::translate('Families')         => [
                I18N::translate('Marriage')  => [
                    'FAM:ENGA' => $element_factory->make('FAM:ENGA'),
                    'FAM:MARB' => $element_factory->make('FAM:MARB'),
                    'FAM:MARC' => $element_factory->make('FAM:MARC'),
                    'FAM:MARL' => $element_factory->make('FAM:MARL'),
                    'FAM:MARS' => $element_factory->make('FAM:MARS'),
                    'FAM:ANUL' => $element_factory->make('FAM:ANUL'),
                    'FAM:DIVF' => $element_factory->make('FAM:DIVF'),
                ],
                I18N::translate('Residence') => [
                    'FAM:RESI' => $element_factory->make('FAM:RESI'),
                    'FAM:CENS' => $element_factory->make('FAM:CENS'),
                ],
            ],
            I18N::translate('LDS church')       => [
                '' => [
                    'INDI:BAPL' => $element_factory->make('INDI:BAPL'),
                    'INDI:CONL' => $element_factory->make('INDI:CONL'),
                    'INDI:ENDL' => $element_factory->make('INDI:ENDL'),
                    'INDI:SLGC' => $element_factory->make('INDI:SLGC'),
                    'FAM:SLGS'  => $element_factory->make('FAM:SLGS'),
                    'HEAD:SUBN' => $element_factory->make('HEAD:SUBN'),
                ],
            ],
        ];

        $title = I18N::translate('GEDCOM tags');

        return $this->viewResponse('admin/tags', [
            'element_factory' => Registry::elementFactory(),
            'preferences'     => $preferences,
            'title'           => $title,
        ]);
    }
}
