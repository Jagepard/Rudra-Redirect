## Rudra-Redirect | [API](https://github.com/Jagepard/Rudra-Redirect/blob/master/docs.md "Documentation API")
[![PHPUnit](https://github.com/Jagepard/Rudra-Redirect/actions/workflows/php.yml/badge.svg)](https://github.com/Jagepard/Rudra-Redirect/actions/workflows/php.yml)
[![Maintainability](https://qlty.sh/gh/Jagepard/projects/Rudra-Redirect/maintainability.svg)](https://qlty.sh/gh/Jagepard/projects/Rudra-Redirect)
[![CodeFactor](https://www.codefactor.io/repository/github/jagepard/rudra-redirect/badge)](https://www.codefactor.io/repository/github/jagepard/rudra-redirect)

A lightweight HTTP redirection component for the Rudra Framework.
## Installation

```bash
composer require rudra/redirect
```
### Usage
##### Basic redirection
```php
use Rudra\Redirect\RedirectFacade as Redirect;

// Simple redirect (302 Found)
Redirect::run('https://example.com/new-page');

// Permanent redirect (301 Moved Permanently) with a relative path
Redirect::run('/new-page', 301);
```
### URL Handling Logic
##### The component uses straightforward logic without hidden magic:
- Absolute URLs: If the provided `$url` starts with `http://` or `https://`, it is used exactly as provided.
- Relative URLs: If the `$url` does not start with a protocol, the component automatically prepends the base URL from your configuration: `Rudra::config()->get('url') . '/' . $url`.
### Redirect Back
Redirects the user to the previous page using the `HTTP_REFERER` header. If the referer is not available, it falls back to the specified path (default is `/`).
```php
// Redirect back, fallback to homepage if referer is missing (302 Found)
Redirect::back();

// Redirect back with a custom fallback and specific status code
Redirect::back('/dashboard', 303);
```
### Helper Functions
##### For even simpler usage, the component provides global helper functions:
```php
// Equivalent to Redirect::run()
redirect('/some-page', 302);

// Equivalent to Redirect::back()
back('/fallback-page', 302);
```
### Setting response code only
```php
Redirect::responseCode(404);
```
### Supported HTTP status codes
The component supports all standard HTTP status codes (1xx–5xx), including:
- 1xx — Informational (100 Continue, 101 Switching Protocols, 102 Processing, 103 Early Hints)
- 2xx — Success (200 OK, 201 Created, 204 No Content, etc.)
- 3xx — Redirection (301 Moved Permanently, 302 Found, 307 Temporary Redirect, 308 Permanent Redirect, etc.)
- 4xx — Client errors (400 Bad Request, 401 Unauthorized, 403 Forbidden, 404 Not Found, 418 I'm a teapot, etc.)
- 5xx — Server errors (500 Internal Server Error, 502 Bad Gateway, 503 Service Unavailable, etc.)
The full list is available in ```Redirect::CODE_MESSAGES```.

Attempting to use an unsupported code will throw an `\InvalidArgumentException`.

## License

This project is licensed under the **Mozilla Public License 2.0 (MPL-2.0)** — a free, open-source license that:

- Requires preservation of copyright and license notices,
- Allows commercial and non-commercial use,
- Requires that any modifications to the original files remain open under MPL-2.0,
- Permits combining with proprietary code in larger works.

📄 Full license text: [LICENSE](./LICENSE)  
🌐 Official MPL-2.0 page: https://mozilla.org/MPL/2.0/
