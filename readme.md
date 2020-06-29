# Scafolder

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

This is where your description should go. Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require omenejoseph/scafolder
```
## Usage

## What it does
This library simplifies file/class scafolding for laravel developers looking to have an organized and easy way to
create fast becoming popular classes like Repositories, Services and Util helpers via bash commands.

### Commands currently available
#### 1. Bootstrapping Repository Pattern
Repository pattern is fast becoming a choice design pattern for many laravel developers. Setting up a repository requires creating as 
much as 2 classes and one 1 interface. With this library, you can set up a Repository with just one command
``` bash
$ php artisan make:repo Model
```
Here model represents the Model you want to create the repository for such as Post or User. This commands created 3 files:
1. The repository class (namespace: App\Repositories)
2. The contract that the repository implements (namespace: App\Contracts)
3. A Service Provider class that binds the interface to the repository (namespace: App\ServiceProviders)

After that, all you need to do is register the Service provider generated in your config.app.providers array so it would be auto discovered.
This class

#### 2. Bootstrapping Services
Its fast becoming a norm for laravel developers to have a lean controller and model class. This has given rise to many developers opting 
to have service classes servicing each controller. These service classes house the bulk of the logic usually hosted in the controller
class thus making it very lean. The controller just has to instantiate the class and make use of methods that perform actions for the
controller. Creating a service class:
``` bash
$ php artisan make:service Model
```
This creates a service class in the App\Services namespace

#### 3. Bootstrapping Traits
Many developers rely on traits to abstract common methods to classes. With this library, Creating a trait is as easy and running an artisan command
``` bash
$ php artisan make:trait TraitName
```
This creates a trait in the App\Traits namespace

## Future updates
We are looking to adding commands to create facades and util classes

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.


## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [Omene Joseph Ogheneruno][https://omenejoseph.com.ng]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/omenejoseph/scafolder.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/omenejoseph/scafolder.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/omenejoseph/scafolder/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/omenejoseph/scafolder
[link-downloads]: https://packagist.org/packages/omenejoseph/scafolder
[link-travis]: https://travis-ci.org/omenejoseph/scafolder
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/omenejoseph
[link-contributors]: ../../contributors
