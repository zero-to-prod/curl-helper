# Zerotoprod\CurlHelper

![](art/logo.png)

[![Repo](https://img.shields.io/badge/github-gray?logo=github)](https://github.com/zero-to-prod/curl-helper)
[![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/zero-to-prod/curl-helper/test.yml?label=test)](https://github.com/zero-to-prod/curl-helper/actions)
[![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/zero-to-prod/curl-helper/backwards_compatibility.yml?label=backwards_compatibility)](https://github.com/zero-to-prod/curl-helper/actions)
[![Packagist Downloads](https://img.shields.io/packagist/dt/zero-to-prod/curl-helper?color=blue)](https://packagist.org/packages/zero-to-prod/curl-helper/stats)
[![php](https://img.shields.io/packagist/php-v/zero-to-prod/curl-helper.svg?color=purple)](https://packagist.org/packages/zero-to-prod/curl-helper/stats)
[![Packagist Version](https://img.shields.io/packagist/v/zero-to-prod/curl-helper?color=f28d1a)](https://packagist.org/packages/zero-to-prod/curl-helper)
[![License](https://img.shields.io/packagist/l/zero-to-prod/curl-helper?color=pink)](https://github.com/zero-to-prod/curl-helper/blob/main/LICENSE.md)
[![wakatime](https://wakatime.com/badge/github/zero-to-prod/curl-helper.svg)](https://wakatime.com/badge/github/zero-to-prod/curl-helper)
[![Hits-of-Code](https://hitsofcode.com/github/zero-to-prod/curl-helper?branch=main)](https://hitsofcode.com/github/zero-to-prod/curl-helper/view?branch=main)

## Contents

- [Introduction](#introduction)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
  - [parseHeaders](#parseheaders)
- [Local Development](./LOCAL_DEVELOPMENT.md)
- [Contributing](#contributing)

## Introduction

A helper for curl.

## Requirements

- PHP 7.1 or higher.

## Installation

Install `Zerotoprod\CurlHelper` via [Composer](https://getcomposer.org/):

```bash
composer require zero-to-prod/curl-helper
```

This will add the package to your project’s dependencies and create an autoloader entry for it.

## Usage

### parseHeaders()

Return the headers of a request as an array.

```php
use Zerotoprod\CurlHelper\CurlHelper;

$CurlHandle = curl_init('https://google.com');
curl_setopt_array($CurlHandle, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER => true,
]);
$response = curl_exec($CurlHandle);
$header_size = curl_getinfo($CurlHandle, CURLINFO_HEADER_SIZE);
curl_close($CurlHandle);

$headers = CurlHelper::parseHeaders($response, $header_size);

```

## Contributing

Contributions, issues, and feature requests are welcome!
Feel free to check the [issues](https://github.com/zero-to-prod/curl-helper/issues) page if you want to contribute.

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Commit changes (`git commit -m 'Add some feature'`).
4. Push to the branch (`git push origin feature-branch`).
5. Create a new Pull Request.
