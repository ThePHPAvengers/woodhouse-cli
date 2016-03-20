# Woodhouse

Woodhouse is a PHP scaffolding tool.
It helps you to :

 - **start a new project in PHP**, generating all the base files in a simple command line.
 - **improve an existing project**, running several modules with specific actions.

Woodhouse generates all the files you need for a library, a web application, a framework project, and so on.
You can even **load your own bootstrap**.

Woodhouse will run several modules during the scaffolding of a new project, or independently on an existing project.
You can **choose which module** to install according to your own needs. 
You can also create your own module.

![Woodhouse during project scaffolding](put link to screenshot)


## What does Woodhouse scaffold?

Woodhouse installs and params your project:

 1. Download the bootstrap and its dependencies with Composer
 2. Param the Composer config (composer.json)
 3. Dump the autoloader of Composer with your new package name
 4. Execute the installed modules.
 
 
### Examples of bootstrap

 - psr4Skeleton       - A PSR-2/4 skeleton package
 - UniApi             - A Universal api http client
 - UniApiExampleSDK   - An example SDK implementation for UniApi

 - .. what you want!
 

### Examples of modules

## Installation

Install Woodhouse with Composer:

```console
$ composer global require thephpavengers/woodhouse
```

Be sure you have set the COMPOSER_BIN_DIR in your path. 

For more information, see the detailed [installation doc](http://woodhouse.readthedocs.org/) of Woodhouse.


## Scaffold your project

To create a new project, run the `new` command of Woodhouse and choose your bootstrap:

```console
$ woodhouse new
```

For more information, see the detailed [scaffolding doc](http://woodhouse.readthedocs.org/en/latest/scaffolding/) of Woodhouse.


## Modules

A module is a plugin added to Woodhouse.
This plugin will execute some specific actions. 
For example, the git module will init Git in your project.

You can easily develop your own module and add it to Woodhouse.

The modules can run during the scaffolding of a new project, or improve an existing project.

For more information, see the detailed [modules doc](http://woodhouse.readthedocs.org/en/latest/modules/) of Woodhouse.

### Install pre-defined modules

```console
$ woodhouse module install
```

### Run modules on an existing project

```console
$ woodhouse module run
```

## Documentation

See the [Woodhouse documentation](http://woodhouse.readthedocs.org/).
 - [Installation](http://woodhouse.readthedocs.org/en/latest/installation/)
 - [Usage](http://woodhouse.readthedocs.org/en/latest/scaffolding/)
 - [Aliases](http://woodhouse.readthedocs.org/en/latest/aliases/)
 - [Modules](http://woodhouse.readthedocs.org/en/latest/modules/)

## Contribution and roadmap

See the [Woodhouse wiki](https://github.com/ThePHPAvengers/woodhouse/wiki).

