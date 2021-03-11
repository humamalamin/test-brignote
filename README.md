<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Application

This application use Laravel Framework Version 8 and Livewire. Style code use repository pattern for readable other developer. Feature apps is Login, Register use fortify and show list users with table livewire and then documentation API use swagger. References:

- [Documentation API with Swaggger](https://github.com/DarkaOnLine/L5-Swagger).
- [Laravel Engine](https://laravel.com/).
- [Livewire](https://laravel-livewire.com/).
- [Laravel Livewire Table](https://github.com/rappasoft/laravel-livewire-tables).
- [Design Repository Pattern Laravel](https://medium.com/employbl/use-the-repository-design-pattern-in-a-laravel-application-13f0b46a3dce)


## How To Install

```
git clone https://github.com/humamalamin/test-brignote
cd test-brignote
run composer install
cp .env.example to .env
config file .env
run php artisan key:generate
run php artisan migrate --seed
run php artisan serve
```

## How To Generate Documentation API Swagger

```
complete install apps
cd test-brignote
run php artisan l5-swagger:generate
run php artisan serve
access {host}/api/documentation
```

## How To Run Unit Testing

```
.\vendor\bin\phpunit
```
## How To Run With  Docker

Soon

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
