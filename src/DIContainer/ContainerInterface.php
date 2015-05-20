<?php
namespace MinusFour\DIContainer;

interface DIContainer {

	public function registerInjector(InjectorInterface $i);

	public function resolve($class);
}
?>
