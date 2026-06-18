## Rudra-Redirect / Перенаправление | [API](https://github.com/Jagepard/Rudra-Redirect/blob/master/docs.md "Documentation API")
[![PHPUnit](https://github.com/Jagepard/Rudra-Redirect/actions/workflows/php.yml/badge.svg)](https://github.com/Jagepard/Rudra-Redirect/actions/workflows/php.yml)
[![Maintainability](https://qlty.sh/gh/Jagepard/projects/Rudra-Redirect/maintainability.svg)](https://qlty.sh/gh/Jagepard/projects/Rudra-Redirect)
[![CodeFactor](https://www.codefactor.io/repository/github/jagepard/rudra-redirect/badge)](https://www.codefactor.io/repository/github/jagepard/rudra-redirect)

A lightweight HTTP redirection component for the Rudra Framework.
## Installation

```bash
composer require rudra/redirect
```
#### Usage
##### Basic redirection
```php
use Rudra\Redirect\RedirectFacade as Redirect;

// Simple redirect (302 Found)
Redirect::run('https://example.com/new-page');

// Permanent redirect (301 Moved Permanently)
Redirect::run('https://example.com/new-page', '', 301);
```
#### Redirect types
##### The component supports three redirect types:
```php
// Full URL — sends "Location: " + your URL as-is
Redirect::run('https://example.com/page', 'full');

// Basic URL — prepends "http://" automatically
Redirect::run('example.com/page', 'basic');

// Secure URL — prepends "https://" automatically
Redirect::run('example.com/page', 'secure');
```
If an unknown type is passed, the component falls back to the base URL from the configuration ```Rudra::config()->get('url') . '/'```.
#### Setting response code only
```php
Redirect::responseCode(404);
```
#### Supported HTTP status codes
The component supports all standard HTTP status codes (1xx–5xx), including:
- 1xx — Informational (100 Continue, 101 Switching Protocols, 102 Processing, 103 Early Hints)
- 2xx — Success (200 OK, 201 Created, 204 No Content, etc.)
- 3xx — Redirection (301 Moved Permanently, 302 Found, 307 Temporary Redirect, 308 Permanent Redirect, etc.)
- 4xx — Client errors (400 Bad Request, 401 Unauthorized, 403 Forbidden, 404 Not Found, 418 I'm a teapot, etc.)
- 5xx — Server errors (500 Internal Server Error, 502 Bad Gateway, 503 Service Unavailable, etc.)
The full list is available in ```Redirect::CODE_MESSAGES```.
## License

This project is licensed under the **Mozilla Public License 2.0 (MPL-2.0)** — a free, open-source license that:

- Requires preservation of copyright and license notices,
- Allows commercial and non-commercial use,
- Requires that any modifications to the original files remain open under MPL-2.0,
- Permits combining with proprietary code in larger works.

📄 Full license text: [LICENSE](./LICENSE)  
🌐 Official MPL-2.0 page: https://mozilla.org/MPL/2.0/
