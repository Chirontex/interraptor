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

interface LimiterInterface
{
    /**
     * Limiter constructor.
     * 
     * @param int $time_limit
     * If empty, the value will get from ini_get('max_execution_time').
     * If it also empty, the Exception will be thrown.
     * 
     * @param int $time_lag
     * If smaller than 0 or bigger than ini_get('max_execution_time') value,
     * the Exception will be thrown.
     */
    public function __construct(int $time_limit = 0, int $time_lag = 1);

}
