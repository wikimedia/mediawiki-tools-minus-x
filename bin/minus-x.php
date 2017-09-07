#!/usr/bin/php
<?php
/**
 * MinusX - checks files that shouldn't have an executable bit
 * Copyright (C) 2017 Kunal Mehta <legoktm@member.fsf.org>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @file
 */

require_once __DIR__ . '/../vendor/autoload.php';

use MediaWiki\MinusX\CheckCommand;
use MediaWiki\MinusX\FixCommand;
use Symfony\Component\Console\Application;

$app = new Application();
$app->add( new CheckCommand() );
$app->add( new FixCommand() );
$app->run();
