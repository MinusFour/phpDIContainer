# phpDIContainer
Very simple Dependency Injector Container.

# Installing
You can install it through composer. Through the CLI:
```
composer require minusfour/phpdicontainer
```

Don't forget to add the autoloader to your bootstrap file:

```php
require 'vendor/autoload.php';
```

# How to use

Start by specifying the class namespace:
```php
use MinusFour\DIContainer\Container;
use MinusFour\DIContainer\Injector;
```
Instantiate the container.
```php
$container = new Container();
```

Register an injector. Assuming class A depends on class B.
```php
$container->registerInjector(new Injector('A', function($deps){
    return new A($deps['B']);
}, ['B']));
```

And register the injector dependencies. In this case B.
```php
$container->registerInjector(new  Injector('B', function($deps){
    return new A($deps['B']);
}));
```

To resolve a class, all you need to do is:
```php
$A = $container->resolve('A');
```

It will instantiate A and inject its dependencies through their injectors.

# Note

The injector constructor takes three parameters. The first parameter must be the name of the class (or dependency), the third parameter is an array containing a list of dependencies (names must match first parameter). The second
parameter is an anonymous function that takes one parameter, the dependencies as an array of objects and is responsible for both instantiation and dependency injection.

The injector implementation borrows from [pimple](http://pimple.sensiolabs.org/) examples, mostly the anonymous function idea.

# Exceptions note

`$container->resolve()` is responsible for throwing 2 kind of exceptions: `MinusFour\DIContainer\InjectorNotFoundException` and `MinusFour\DIContainer\DependencyUnmetException`. First only occurs if there's no injector for said class, second one is thrown when the container fails to find the injector of the dependency.
