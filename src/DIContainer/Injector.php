<?php
/*****************************************************************************/
/* Copyright (C) 2015 Alejandro Quiroga

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*******************************************************************************/
namespace MinusFour\DIContainer;

class Injector implements InjectorInterface{
	private $anonFn;
	private $deps;
	private $className;

	public function __construct($className, $anonFn, $deps = array()){
		$this->className = $className;
		$this->anonFn = $anonFn;
		$this->deps = $deps;
	}

	public function getClassName(){
		return $this->className;
	}

	public function getDeps(){
		return $this->deps;
	}

	public function create(array $deps){
		$cb = $this->anonFn;
		return $cb($deps);
	}
}
?>
