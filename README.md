=======
OpenCfP
=======

An open source PHP-based application designed to improve the experience of managing and submitting to a call for papers for a technology conference.

## Introduction

OpenCfP was created to address the needs of conference organizers when opening and selecting proposals for their conference. The primary audience for this project is conference organizers without an existing CfP management solution and without the ability to either create a custom solution or license an existing solution. Specifically the OpenCfP is a way to provide the functionality many conferences have duplicated repeatedly, sometimes with lackluster results.

The main goals for the OpenCfP project are to:

 * provide an interface for conference organizers to schedule and manage submissions to a call for papers;
 * allow conference organizers to sort, filter, and select from proposed sessions;
 * allow submitters to create and export a speaker profile, connected to popular services speakers are likely already using; and
 * be a free alternative to using tools which are not exactly suited for the task which many first conferences end up using.

## Requirements

This project is developed and tested to run on PHP version 5.3.21 or later and MySQL version 5.5 or later.

## Installation

The OpenCfP development environment is managed via [Vagrant](http://www.vagrantup.com/) and provisioned via [Puppet](http://puppetlabs.com/). You can set up a development environment by following these steps:

1. Download, install, and configure the dependencies.

  * VirtualBox (https://www.virtualbox.org)
  * Ruby (http://www.ruby-lang.org)
  * Vagrant (http://www.vagrantup.com)

2. Clone the source repository to any location on your machine.

```
git clone git://github.com/jcarouth/opencfp.git /path/to/opencfp
```

3. Install the project dependencies using [Composer](http://getcomposer.org).

```
curl -sS https://getcomposer.org/installer | php
php composer.phar install --dev
```

**NOTE:** If you are using Windows, please [follow the installation instructions](http://getcomposer.org/doc/00-intro.md#installation-windows) provided by the composer project.

4. Start and provision your development virtual machine using vagrant.

```
vagrant up
```

5. Browse to your development instance using a web browser.

```
open http://opencfp.dev
```

You can now modify the files that make up the application. Saving the files will automatically update them on the virtual machine and will be reflected by viewing the site in your web browser.

## Tests

Tests are written using [PHPUnit](https://github.com/sebastianbergmann/phpunit) and can be run by running:

```
bin/phpunit
```

## License

This software is licensed under the [MIT License](LICENSE).

## Contributing

All contributions are welcome and evaluated for inclusion in this project. If you have a request, please submit as much detail about your request as an issue on [github](http://github.com/jcarouth/opencfp). If you have a bug to fix or you want to implement a feature yourself, please fork the repository and send a pull request when you are ready with your fix. Tests are required before a pull request will be accepted and merged. If you need help with the tests aspect please reach out to other contributors.
