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

class Container {
	private $injectorList;

	public function __construct(){
		$this->injectorList = array();
	}

	public function registerInjector(InjectorInterface $i){
		$this->injectorList[$i->getClassName()] = $i;
	}

	public function resolve($class){
		if(isset($this->injectorList[$class])){
			$injector = $this->injectorList[$class];
		} else {
			throw new InjectorNotFoundException($class);
		}
		$deps = $injector->getDeps();
		$objs = [];
		if(!empty($deps)){
			foreach($deps as $dep){
				try {
					$objs[$dep] = $this->resolve($dep);
				} catch(InjectorNotFoundException $infe){
					throw new DependencyUnmetException($class, $dep);
				}
			}
		}
		return $injector->create($objs);
	}
}
?>
