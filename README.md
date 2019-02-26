RQL - Resource Query Language Package
====================

<p align="center">
<a href="https://scrutinizer-ci.com/g/noitran/rql/code-structure"><img src="https://img.shields.io/scrutinizer/coverage/g/noitran/rql.svg?style=flat-square" alt="Coverage Status"></img></a>
<a href="https://scrutinizer-ci.com/g/noitran/rql"><img src="https://img.shields.io/scrutinizer/g/noitran/rql.svg?style=flat-square" alt="Quality Score"></img></a>
<a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License"></img></a>
<a href="https://github.com/noitran/rql/releases"><img src="https://img.shields.io/github/release/noitran/rql.svg?style=flat-square" alt="Latest Version"></img></a>
<a href="https://packagist.org/packages/noitran/rql"><img src="https://img.shields.io/packagist/dt/noitran/rql.svg?style=flat-square" alt="Total Downloads"></img></a>
</p>

## About

Package allows to use Resource Query Language (RQL) with Laravel's Eloquent ORM. Providers a simple and light-weight API for adding dynamic querying capabilities to HTTP based applications. Package functions as connector between HTTP requests and ORM. Currently only Eloquent Processor is included, but pacakge capabilities can be easly extended by adding new Processor.

## Install

* Install as composer package

```bash
$ composer require noitran/rql
```

## Usage

```php
use Noitran\RQL\Tests\Stubs\Models\User;
use Noitran\RQL\ExprQueue;
use Noitran\RQL\Processors\EloquentProcessor;

// Getting builder instance of model, or builder 
// instance from noitran/repositories also can be passed.
$builder = User::query();

$queue = new ExprQueue();

// Creating expression
$exprClasses = $this->queue->enqueue(
	new \Noitran\RQL\Expressions\EqExpr(null, 'name', 'John')
);

// Attaching expression into builder
$query = (new EloquentProcessor($this->builder))->process($exprClasses);

// Thats it! Expression has been applied. Can be checked by dumping query.
// Example:
dd($query->toSql());

// Dumps attached expression to sql:
// select * from "users" where "name" = ?
```

All samples can be viewed in testfile: `Noitran\RQL\Tests\Processors\EloquentProcessorTest`

## Todo

* Add request / input parsers.
* Improve relation / column bindings.
* Improve docs and add more samples.
