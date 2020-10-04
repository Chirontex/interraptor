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

final class Limiter implements LimiterInterface
{

    private $time_start;
    private $time_limit;
    private $time_lag;
    private $interrupt;

    public function __construct(int $time_limit = 0, int $time_lag = 1)
    {
        
        $this->time_start = time();

        if ($time_lag < 0) throw new Exception(__CLASS__.': Time lag cannot be negative.', -10);

        $ini = (int)ini_get('max_execution_time');

        if (!empty($ini)) {

            if (empty($time_limit)) $time_limit = $ini;

            if ($time_limit > $ini) throw new Exception(__CLASS__.': Time limit cannot be bigger than "max_execution_time" value.', -11);

            if ($time_lag > $ini) throw new Exception(__CLASS__.': Time lag cannot be bigger than "max_execution_time" value.', -12);

        }

        if ($time_limit < $time_lag) throw new Exception(__CLASS__.': Time lag cannot be bigger than time limit.', -13);

        $this->time_limit = $time_limit;
        $this->time_lag = $time_lag;
        $this->interrupt = false;

    }

    public function interruption()
    {

        return $this->interrupt;

    }

    public function toInterrupt()
    {

        if ((time() - $this->time_start) >= ($this->time_limit - $this->time_lag)) $result = true;
        else $result = false;

        $this->interrupt = $result;

        return $result;

    }

}
