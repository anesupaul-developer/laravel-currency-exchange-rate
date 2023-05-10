<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Currency Exchange Rate Api

    - Test Driven Development
    - SOLID PRINCIPLES
        S - Single Responsibility Principle.
        O - Open/Closed Principle.
        L - Liskov Substitution Principle.
        I - Interface Segregation Principle.
        D - Dependency Inversion Principle.
    - API Integration
    - Caching
    - Rate limiting

Create an account on https://app.freecurrencyapi.com

# Running the application

1. after cloning the project, add the env keys for FREE_CURRENCY_KEY_ID and FREE_CURRENCY_TTL

2. Run php artisan test to make sure everything is working as expected

3. On your local machine run a HTTP Get Request inside Postman or Insomia http://localhost:8000/api/currency-rates

4. To convert a currency use http://localhost:8000/api/currency-conversion?amount=800&from_currency=USD&to_currency=ZAR

5. To get supported currencies see https://freecurrencyapi.com/docs/currency-list




