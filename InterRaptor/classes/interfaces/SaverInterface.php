<?php
/**
 *    InterRaptor
 *    Copyright (C) 2020  Dmitry Shumilin (dr.noisier@yandex.ru)
 *
 *    This program is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */
namespace InterRaptor;

interface SaverInterface
{
    /**
     * Saver constructor.
     * 
     * @param string $path
     * @param string $filename
     * @param array $structure
     * if structure is empty, Exception will be thrown.
     */
    public function __construct(string $path, string $filename, array $structure);

    /**
     * Saves the data.
     * 
     * @param Limiter $limiter
     * @param array $data
     * @return bool|int
     */
    public function save(Limiter $limiter, array $data);

}
