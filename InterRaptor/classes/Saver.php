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

use Exception;

final class Saver implements SaverInterface
{

    private $pathfile;
    private $structure;

    public function __construct(string $path, string $filename, array $structure)
    {

        if ((substr($path, -1) !== '/') && (substr($path, -1) !== '\\')) $path .= '/';

        $pathfile = $path.$filename.'.json';
        
        if (SaversRegistry::saverSet($pathfile)) $this->pathfile = $pathfile;
        else throw new Exception(__CLASS__.': pathfile already exists.', -15);

        if (empty($structure)) throw new Exception(__CLASS__.': structure cannot be empty.', -16);
        else $this->structure = $structure;

    }

    public function save(Limiter $limiter, array $data)
    {

        if ($limiter->interruption()) {

            $result_data = [];

            foreach ($data as $key => $value) {
                
                if (array_search($key, $this->structure) !== false) $result_data[$key] = $value;

            }

            $result = file_put_contents($this->pathfile, json_encode($result_data));

        } else $result = false;

        return $result;

    }

}
