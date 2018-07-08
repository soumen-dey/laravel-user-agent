# laravel-user-agent

### An advanced user agent detector for Laravel 5.5 and above.

A powerful package allowing you to detect the user's Browser, Platform and more. This package provides a very simple API and requires no configurations at all.

## Installation

Via Composer

``` bash
$ composer require soumen-dey/laravel-user-agent
```
__Note:__ This package is tested and is fully compatible with Laravel 5.5 and above, not sure about support below Laravel 5.5.

If you are on Laravel 5.4 or below, you need to manually register the `ServiceProvider` and the `Alias`. In your `config/app.php` file just do:

```php
'providers' => [
    // ...
    Soumen\Agent\AgentServiceProvider::class,
];

'aliases' => [
	//...
    'Agent' => Soumen\Agent\Facades\Agent::class,
];
```
For Laravel 5.5 and above, you don't need to do anything, just install the package and you are good to go!

## Usage

* [Setup](#setup)
* [API](#api)
	* [The Facade](#the-agent-facade)
	* [Services](#services)
* [Fetching Properties](#fetching-properties)
	* [Properties as Parameter](#properties-as-parameter)
* [Browser](#browser)
* [Platform](#platform)
* [Device](#device)
* [User Agent](#user-agent)
* [Header](#header)
* [Server](#server)

### Setup

If you have an alias set up for the `Agent` class, you don't need to import anything. However, if the alias is not set, you can do:

```php
use Soumen\Agent\Agent;

// or

use Soumen\Agent\Facades\Agent
```

You are now ready to use the package.

### API

#### The `Agent` Facade

You can access the visitor's details such as the browser using:

```php
Agent::browser(); // returns all the details related to the visitor's browser
```

Likewise you can also fetch other details:

```php
Agent::ip(); // the ip address of the visitor
Agent::device(); // details related to the visitor's device, eg, Phone, Tablet, etc.
Agent::header(); // details related to the request's header
Agent::platform(); // details related to the platform of the visitor, eg. Windows, etc.
Agent::userAgent(); // returns the HTTP_USER_AGENT string
```

You can also fetch server related info:

```php
Agent::server(); // returns details related to the server
```

#### Available Methods

| Methods | |
| ----- | ----- |
| `Agent::ip()` | Returns the visitor's `ip` address. |
| `Agent::all()` | Returns all the details about the visitor. |
| `Agent::get()` | Same as the `all()` method.
| `Agent::header()` | Get information related to the request's header. |
| `Agent::server()` | Get information related to the applications's server. |
| `Agent::device()` | Get information related to the visitor's device, eg. Apple, Samsung, Mobile, Tablet, etc. |
| `Agent::browser()` | Get information related to the visitor's browser. |
| `Agent::platform()` | Get information related to the visitor's platform, eg. Windows, Mac, etc. |
| `Agent::userAgent()` | Returns the `HTTP_USER_AGENT` string. |

You can also retrieve properties:

```php
Agent::browser('name'); // Firefox 61
Agent::browser()->name; // Firefox 61
Agent::browser()->getName(); // Firefox 61
```

Individual services handles the task of fetching visitor information, for more information read the [Services](#services) section.

To get individual service:

```php
$browser = Agent::get('browser'); // returns the browser service
$browser = Agent::browser(); // same as above
```

### Services

The `Agnet` facade is a global wrapper for individual services that handles the actual task of fetching information about the visitor. You can call the Services directly if you want to be more specific.

Get details about the visitor's browser for example:

```php
use Soumen\Agent\Services\Browser;

Browser::get(); // returns all details related to the visitor's browser
Browser::getDetails(); // same as get() method
```

The API for every service is similar except for some minor changes, so you can do:


```php
use Soumen\Agnet\Services\Device;
use Soumen\Agent\Services\Platform;

$device = Device::get(); // get details about the visitor's device
$platform = Platform::get(); // get details related to the visitor's platform
```


### Available Services

| Service | Namespace | Usage | |
| ----- | ----- | ----- | ----- |
| [`Browser`](#browser) | `Soumen\Agent\Services\Browser` | `Browser::get()`,<br>`Browser::getDetails()` | Returns all the information related to the visitor's browser |
| [`Platform`](#platform) | `Soumen\Agent\Services\Platform` | `Platform::get()`,<br>`Platform::getDetails()` | Returns all the information related to the visitor's platform, eg. Windows, Mac, etc. |
| [`Device`](#device) | `Soumen\Agent\Services\Device` | `Device::get()`,<br>`Device::getDetails()` | Returns all the information related to the visitor's device, eg, Mobile or Tablet, Name, etc. |
| [`UserAgent`](#user-agent) | `Soumen\Agent\Services\UserAgnet` | `UserAgent::get()`,<br>`UserAgent::getDetails()` | Returns the visitor's `HTTP_USER_AGENT` string |
| [`Header`](#header) | `Soumen\Agent\Services\Header` | `Header::get()`,<br>`Header::getDetails()` | Returns all information related to the request's `header` |
| [`Server`](#server) | `Soumen\Agent\Services\Server` | `Server::get()`,<br>`Server::getDetails()` | Returns information about the application's server. |

### Fetching Properties

To get individual browser property such as `name` do one of the following:

``` php
$browser = Agent::browser('name');
$browser = Agent::browser()->name;
$browser = Agent::browser()->name();
$browser = Agent::browser()->getName();
```

Using the Service:

```php
use Soumen\Agent\Services\Browser;

// get the name of the browser
$browser = Browser::get('name');
$browser = Browser::get()->name;
$browser = Browser::get()->name();
$browser = Browser::get()->getName();

// or

$browser = Browser::getDetails('name');
$browser = Browser::getDetails()->name;
...
// You get the idea
```

This applies to all the available properties of the browser. Refer to the section for each service for more information.

#### Properties as parameter

You can use the property name as the parameter, so you can do:

```php
Agent::browser('name'); // Firefox 61
Agent::platform('name'); // Windows 10
```

Instead of:

```php
Agent::browser()->name;
Agent::platform()->name;
```

Using individual service:

```php
use Soumen\Agent\Services\Browser;
use Soumen\Agent\Services\Platform;

Browser::get('name'); // Firefox 61
Platform::get('name'); // Windows 10

// or

Browser::getDetails('name'); // Firefox 61
Platform::getDetails('name'); // Windows 10
```

__Note:__ The parameter should be the ***exact*** same string as the property name.

For a list of available properties, refer to the __Properties__ section of the respective __Service__

### Browser


Using the Facade:

```php
$browser = Agent::browser();
```
Using the Service:

```php
use Soumen\Agent\Services\Browser;

$browser = Browser::get();

// or

$browser = Browser::getDetails();
```

##### Available Properties:

| Properties | Methods | |
|-----|-----|-----|
| `$browser->name` | `$browser->name()`,<br> `$browser->getName()` | Returns the name of the browser. |
| `$browser->version` | `$browser->version()`,<br> `$browser->getVersion()` | Returns the browser's version number. |
| `$browser->versionMajor` | `$browser->versionMajor()`,<br> `$browser->getVersionMajor()` | Returns the browser's semantic major version number. |
| `$browser->versionMinor` | `$browser->versionMinor()`,<br> `$browser->getVersionMinor()` | Returns the browser's semantic minor version number. |
| `$browser->versionPatch` | `$browser->versionPatch()`,<br> `$browser->getVersionPatch()` | Returns the browser's semantic patch version. |
| `$browser->engine` | `$browser->engine()`,<br> `$browser->getEngine()` | Returns the browser's rendering engine. |
| `$browser->family` | `$browser->family()`,<br> `$browser->getFamily()`,<br> `$browser->getVendor()` | Returns the browser's vendor. Eg. Chrome, Firefox, etc. |

### Platform

Using the Facade:

```php
$platform = Agent::platform();
```

Using the Service:

```php
use Soumen\Agent\Services\Platform;

$platform = Platform::get();

// or

$platform = Platform::getDetails();
```

##### Available Properties:

| Properties | Methods | |
|-----|-----|-----|
| `$platform->name` | `$platform->name()`,<br> `$platform->getName()` | Returns the name of the Operating System. |
| `$platform->family` | `$platform->family()`,<br> `$platform->getFamily()`,<br> `$platform->getVendor()` | Returns the Operating System's vendor. Eg. Windows, Mac, Linux, etc. |
| `$platform->version` | `$platform->version()`,<br> `$platform->getVersion()` | Returns the Operating System's human friendly version eg. XP, Vista, etc. |
| `$platform->versionMajor` | `$platform->versionMajor()`,<br> `$platform->getVersionMajor()` | Returns the Operating System's semantic major version number. |
| `$platform->versionMinor` | `$platform->versionMinor()`,<br> `$platform->getVersionMinor()` | Returns the Operating System's semantic minor version number. |
| `$platform->versionPatch` | `$platform->versionPatch()`,<br> `$platform->getVersionPatch()` | Returns the Operating System's semantic patch version. |


### Device

Using the Facade:

```php
$device = Agent::device();
```

Using the Service:

```php
use Soumen\Agent\Services\Device;

$device = Device::get();

// or

$device = Device::getDetails();
```

##### Available Properties:

| Properties | Methods | |
|-----|-----|-----|
| `$device->family` | `$device->family()`,<br> `$device->getFamily()`,<br> `$device->getVendor()` | Returns the device's vendor like Samsung, Apple, Huawei. |
| `$device->model` | `$device->model()`,<br> `$device->getModel()` | Returns the device's brand name like iPad, iPhone, Nexus. |
| `$device->mobileGrade` | `$device->mobileGrade()`,<br> `$device->getMobileGrade()` | Returns the device's mobile grade in scale of A,B,C for performance. |
| `$device->isMobile` | `$device->isMobile()` <br> `$device->getIsMobile()` | Determines if the device is a mobile device, returns boolean. |
| `$device->isTablet` | `$device->isTablet()` <br> `$device->getIsTablet()` | Determines if the device is a tablet device, returns boolean. |
| `$device->isDesktop` | `$device->isDesktop()` <br> `$device->getIsDesktop()` | Determines if the device is a desktop computer, returns boolean. |
| `$device->isBot` | `$device->isBot()` <br> `$device->getIsBot()` | Determines if the device is a crawler / bot, returns boolean  |
| | `$device->getType() ` | Returns the type of device eg. mobile, tablet, etc. |

### User Agent

Using the Facade:

```php
$userAgent = Agent::userAgent();
```

Using the Service:

```php
use Soumen\Agent\Services\UserAgent;

$userAgent = UserAgent::get();
```

No specific properties for this service.

### Header

Using the Facade:

```php
$header = Agent::header();
```

Using the Service:

```php
use Soumen\Agent\Service\Header;

$header = Header::get();

// or

$header = Header::getDetails();
```

#### Available Properties

| Properties | Methods | Parameters |
| ----- | ----- | ----- |
| `$header->host`,<br>`$header->host`,<br> | `$header->host()`,<br>`$header->host()`,<br>`$header->getHost()` | `host`|
| `$header->userAgent`,<br>`$header->user_agent`,<br> | `$header->userAgent()`,<br>`$header->user_agent()`,<br>`$header->getUserAgent()` | `user-agent`|
| `$header->accept`,<br>`$header->accept`,<br> | `$header->accept()`,<br>`$header->accept()`,<br>`$header->getAccept()` | `accept`|
| `$header->acceptLanguage`,<br>`$header->accept_language`,<br> | `$header->acceptLanguage()`,<br>`$header->accept_language()`,<br>`$header->getAcceptLanguage()` | `accept-language`|
| `$header->acceptEncoding`,<br>`$header->accept_encoding`,<br> | `$header->acceptEncoding()`,<br>`$header->accept_encoding()`,<br>`$header->getAcceptEncoding()` | `accept-encoding`|
| `$header->cookie`,<br>`$header->cookie`,<br> | `$header->cookie()`,<br>`$header->cookie()`,<br>`$header->getCookie()` | `cookie`|
| `$header->connection`,<br>`$header->connection`,<br> | `$header->connection()`,<br>`$header->connection()`,<br>`$header->getConnection()` | `connection`|
| `$header->upgradeInsecureRequests`,<br>`$header->upgrade_insecure_requests`,<br> | `$header->upgradeInsecureRequests()`,<br>`$header->upgrade_insecure_requests()`,<br>`$header->getUpgradeInsecureRequests()` | `upgrade-insecure-requests`|
| `$header->cacheControl`,<br>`$header->cache_control`,<br> | `$header->cacheControl()`,<br>`$header->cache_control()`,<br>`$header->getCacheControl()` | `cache-control`|


You can use the property names as the string in the *parameter* column:

```php
Header::get('user-agent');
Agent::header('user-agent');
```

### Server

Using the Facade:

```php
$server = Agent::server();
```

Using the Service:

```php
use Soumen\Agent\Services\Server;

$server = Server::get();

// or

$server = Server::getDetails();
```

#### Available Properties

| Properties | Methods | |
| ----- | ----- | ----- |
`$server->DOCUMENT_ROOT`,<br>`$server->documentRoot` | `$server->DOCUMENT_ROOT()`,<br>`$server->documentRoot()`,<br>`$server->getDocumentRoot()` | Returns the value of PHP's `$_SERVER['DOCUMENT_ROOT']` superglobal. |
`$server->REMOTE_ADDR`,<br>`$server->remoteAddr` | `$server->REMOTE_ADDR()`,<br>`$server->remoteAddr()`,<br>`$server->getRemoteAddr()` | Returns the value of PHP's `$_SERVER['REMOTE_ADDR']` superglobal. |
`$server->REMOTE_PORT`,<br>`$server->remotePort` | `$server->REMOTE_PORT()`,<br>`$server->remotePort()`,<br>`$server->getRemotePort()` | Returns the value of PHP's `$_SERVER['REMOTE_PORT']` superglobal. |
`$server->SERVER_SOFTWARE`,<br>`$server->serverSoftware` | `$server->SERVER_SOFTWARE()`,<br>`$server->serverSoftware()`,<br>`$server->getServerSoftware()` | Returns the value of PHP's `$_SERVER['SERVER_SOFTWARE']` superglobal. |
`$server->SERVER_PROTOCOL`,<br>`$server->serverProtocol` | `$server->SERVER_PROTOCOL()`,<br>`$server->serverProtocol()`,<br>`$server->getServerProtocol()` | Returns the value of PHP's `$_SERVER['SERVER_PROTOCOL']` superglobal. |
`$server->SERVER_NAME`,<br>`$server->serverName` | `$server->SERVER_NAME()`,<br>`$server->serverName()`,<br>`$server->getServerName()` | Returns the value of PHP's `$_SERVER['SERVER_NAME']` superglobal. |
`$server->SERVER_PORT`,<br>`$server->serverPort` | `$server->SERVER_PORT()`,<br>`$server->serverPort()`,<br>`$server->getServerPort()` | Returns the value of PHP's `$_SERVER['SERVER_PORT']` superglobal. |
`$server->REQUEST_URI`,<br>`$server->requestUri` | `$server->REQUEST_URI()`,<br>`$server->requestUri()`,<br>`$server->getRequestUri()` | Returns the value of PHP's `$_SERVER['REQUEST_URI']` superglobal. |
`$server->REQUEST_METHOD`,<br>`$server->requestMethod` | `$server->REQUEST_METHOD()`,<br>`$server->requestMethod()`,<br>`$server->getRequestMethod()` | Returns the value of PHP's `$_SERVER['REQUEST_METHOD']` superglobal. |
`$server->SCRIPT_NAME`,<br>`$server->scriptName` | `$server->SCRIPT_NAME()`,<br>`$server->scriptName()`,<br>`$server->getScriptName()` | Returns the value of PHP's `$_SERVER['SCRIPT_NAME']` superglobal. |
`$server->SCRIPT_FILENAME`,<br>`$server->scriptFilename` | `$server->SCRIPT_FILENAME()`,<br>`$server->scriptFilename()`,<br>`$server->getScriptFilename()` | Returns the value of PHP's `$_SERVER['SCRIPT_FILENAME']` superglobal. |
`$server->PATH_INFO`,<br>`$server->pathInfo` | `$server->PATH_INFO()`,<br>`$server->pathInfo()`,<br>`$server->getPathInfo()` | Returns the value of PHP's `$_SERVER['PATH_INFO']` superglobal. |
`$server->PHP_SELF`,<br>`$server->phpSelf` | `$server->PHP_SELF()`,<br>`$server->phpSelf()`,<br>`$server->getPhpSelf()` | Returns the value of PHP's `$_SERVER['PHP_SELF']` superglobal. |
`$server->HTTP_HOST`,<br>`$server->httpHost` | `$server->HTTP_HOST()`,<br>`$server->httpHost()`,<br>`$server->getHttpHost()` | Returns the value of PHP's `$_SERVER['HTTP_HOST']` superglobal. |
`$server->HTTP_USER_AGENT`,<br>`$server->httpUserAgent` | `$server->HTTP_USER_AGENT()`,<br>`$server->httpUserAgent()`,<br>`$server->getHttpUserAgent()` | Returns the value of PHP's `$_SERVER['HTTP_USER_AGENT']` superglobal. |
`$server->HTTP_ACCEPT`,<br>`$server->httpAccept` | `$server->HTTP_ACCEPT()`,<br>`$server->httpAccept()`,<br>`$server->getHttpAccept()` | Returns the value of PHP's `$_SERVER['HTTP_ACCEPT']` superglobal. |
`$server->HTTP_ACCEPT_LANGUAGE`,<br>`$server->httpAcceptLanguage` | `$server->HTTP_ACCEPT_LANGUAGE()`,<br>`$server->httpAcceptLanguage()`,<br>`$server->getHttpAcceptLanguage()` | Returns the value of PHP's `$_SERVER['HTTP_ACCEPT_LANGUAGE']` superglobal. |
`$server->HTTP_ACCEPT_ENCODING`,<br>`$server->httpAcceptEncoding` | `$server->HTTP_ACCEPT_ENCODING()`,<br>`$server->httpAcceptEncoding()`,<br>`$server->getHttpAcceptEncoding()` | Returns the value of PHP's `$_SERVER['HTTP_ACCEPT_ENCODING']` superglobal. |
`$server->HTTP_COOKIE`,<br>`$server->httpCookie` | `$server->HTTP_COOKIE()`,<br>`$server->httpCookie()`,<br>`$server->getHttpCookie()` | Returns the value of PHP's `$_SERVER['HTTP_COOKIE']` superglobal. |
`$server->HTTP_CONNECTION`,<br>`$server->httpConnection` | `$server->HTTP_CONNECTION()`,<br>`$server->httpConnection()`,<br>`$server->getHttpConnection()` | Returns the value of PHP's `$_SERVER['HTTP_CONNECTION']` superglobal. |
`$server->HTTP_UPGRADE_INSECURE_REQUESTS`,<br>`$server->httpUpgradeInsecureRequests` | `$server->HTTP_UPGRADE_INSECURE_REQUESTS()`,<br>`$server->httpUpgradeInsecureRequests()`,<br>`$server->getHttpUpgradeInsecureRequests()` | Returns the value of PHP's `$_SERVER['HTTP_UPGRADE_INSECURE_REQUESTS']` superglobal. |
`$server->HTTP_CACHE_CONTROL`,<br>`$server->httpCacheControl` | `$server->HTTP_CACHE_CONTROL()`,<br>`$server->httpCacheControl()`,<br>`$server->getHttpCacheControl()` | Returns the value of PHP's `$_SERVER['HTTP_CACHE_CONTROL']` superglobal. |
`$server->REQUEST_TIME_FLOAT`,<br>`$server->requestTimeFloat` | `$server->REQUEST_TIME_FLOAT()`,<br>`$server->requestTimeFloat()`,<br>`$server->getRequestTimeFloat()` | Returns the value of PHP's `$_SERVER['REQUEST_TIME_FLOAT']` superglobal. |
`$server->REQUEST_TIME`,<br>`$server->requestTime` | `$server->REQUEST_TIME()`,<br>`$server->requestTime()`,<br>`$server->getRequestTime()` | Returns the value of PHP's `$_SERVER['REQUEST_TIME']` superglobal. |


## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email me at <soumendeyemail@gmail.com>.

## Credits

- [Soumen Dey][link-author]
- [All Contributors][link-contributors]
- A big thanks to [hisorange/browser-detect](#https://github.com/hisorange/browser-detect).

## License

This package is released under the MIT License (MIT). Please see the [license file](license.md) for more information.

[link-packagist]: https://packagist.org/packages/soumen-dey/laravel-user-agent
[link-downloads]: https://packagist.org/packages/soumen-dey/laravel-user-agent
[link-author]: https://github.com/soumen-dey
[link-contributors]: ../../contributors]