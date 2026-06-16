## Table of contents
- [Rudra\Redirect\Redirect](#rudra_redirect_redirect)
- [Rudra\Redirect\RedirectFacade](#rudra_redirect_redirectfacade)
- [Rudra\Redirect\RedirectInterface](#rudra_redirect_redirectinterface)


---



<a id="rudra_redirect_redirect"></a>

### Class: Rudra\Redirect\Redirect
| Visibility | Function |
|:-----------|:---------|
| public | `run(string $url, string $type, int $code): void`<br>Executes a redirection with the specified URL, type, and HTTP status code.<br>The method sets the response code and performs the redirection.<br>If the environment is not "test", the script execution is terminated. |
| public | `responseCode(int $code): void`<br>Sets the HTTP response code with the specified status code.<br>The method constructs the header using the server protocol and the provided code. |
| private | `redirectTo(string $url, string $type): void`<br>Performs the redirection to the specified URL with the given type.<br>The method sets the appropriate header for redirection. |
| private | `getCodeMessage(int $code): string`<br>Retrieves the message associated with the given HTTP status code.<br>If the code is not found, the script terminates with an error message. |
| private | `getRedirectType(string $type): string`<br>Retrieves the redirection type header based on the specified type.<br>If the type is not found, a default redirection to the base URL is returned. |


<a id="rudra_redirect_redirectfacade"></a>

### Class: Rudra\Redirect\RedirectFacade
| Visibility | Function |
|:-----------|:---------|
| public static | `__callStatic(string $method, array $parameters): mixed`<br>Handles static method calls for the Facade class<br>It dynamically resolves the underlying class name by removing "Facade" from the class name<br>If the resolved class does not exist, it attempts to clean up the class name by removing spaces<br>If the resolved class is not already registered in the container, it registers it<br>Finally, it delegates the static method call to the resolved class instance |


<a id="rudra_redirect_redirectinterface"></a>

### Class: Rudra\Redirect\RedirectInterface
| Visibility | Function |
|:-----------|:---------|
| abstract public | `run(string $url, string $type, int $code): void`<br> |
| abstract public | `responseCode(int $code): void`<br> |


---

###### created with [Rudra-Documentation-Collector](https://github.com/Jagepard/Rudra-Documentation-Collector)
