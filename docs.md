## Table of contents
- [Rudra\Redirect\Redirect](#rudra_redirect_redirect)
- [Rudra\Redirect\RedirectFacade](#rudra_redirect_redirectfacade)
- [Rudra\Redirect\RedirectInterface](#rudra_redirect_redirectinterface)
<hr>

<a id="rudra_redirect_redirect"></a>

### Class: Rudra\Redirect\Redirect
| Visibility | Function |
|:-----------|:---------|
| public | `run(string $url, string $type, string $code): void`<br>Executes a redirection with the specified URL, type, and HTTP status code.<br>The method sets the response code and performs the redirection.<br>If the environment is not "test", the script execution is terminated.<br>-------------------------<br>Выполняет перенаправление с указанным URL, типом и HTTP-кодом состояния.<br>Метод устанавливает код ответа и выполняет перенаправление.<br>Если окружение не является "test", выполнение скрипта завершается. |
| public | `responseCode(string $code): void`<br>Sets the HTTP response code with the specified status code.<br>The method constructs the header using the server protocol and the provided code.<br>-------------------------<br>Устанавливает HTTP-код ответа с указанным кодом состояния.<br>Метод формирует заголовок, используя протокол сервера и предоставленный код. |
| private | `redirectTo(string $url, string $type): void`<br>Performs the redirection to the specified URL with the given type.<br>The method sets the appropriate header for redirection.<br>-------------------------<br>Выполняет перенаправление на указанный URL с заданным типом.<br>Метод устанавливает соответствующий заголовок для перенаправления. |
| private | `getCodeMessage(string $code): string`<br>Retrieves the message associated with the given HTTP status code.<br>If the code is not found, the script terminates with an error message.<br>-------------------------<br>Извлекает сообщение, связанное с указанным HTTP-кодом состояния.<br>Если код не найден, выполнение скрипта завершается с сообщением об ошибке. |
| private | `getRedirectType(string $type): string`<br>Retrieves the redirection type header based on the specified type.<br>If the type is not found, a default redirection to the base URL is returned.<br>-------------------------<br>Извлекает заголовок типа перенаправления на основе указанного типа.<br>Если тип не найден, возвращается перенаправление по умолчанию на базовый URL. |


<a id="rudra_redirect_redirectfacade"></a>

### Class: Rudra\Redirect\RedirectFacade
| Visibility | Function |
|:-----------|:---------|
| public static | `__callStatic(string $method, array $parameters): ?mixed`<br>Handles static method calls for the Facade class.<br>It dynamically resolves the underlying class name by removing "Facade" from the class name.<br>If the resolved class does not exist, it attempts to clean up the class name by removing spaces.<br>If the resolved class is not already registered in the container, it registers it.<br>Finally, it delegates the static method call to the resolved class instance.<br>-------------------------<br>Обрабатывает статические вызовы методов для класса Facade.<br>Динамически разрешает имя базового класса, удаляя "Facade" из имени класса.<br>Если разрешённый класс не существует, пытается очистить имя класса, удаляя пробелы.<br>Если разрешённый класс ещё не зарегистрирован в контейнере, он регистрируется.<br>В конце делегирует статический вызов метода экземпляру разрешённого класса. |


<a id="rudra_redirect_redirectinterface"></a>

### Class: Rudra\Redirect\RedirectInterface
| Visibility | Function |
|:-----------|:---------|
| abstract public | `run(string $url, string $type, string $code): void`<br>Executes a redirection with the specified URL, type, and HTTP status code.<br>The method sets the response code and performs the redirection.<br>-------------------------<br>Выполняет перенаправление с указанным URL, типом и HTTP-кодом состояния.<br>Метод устанавливает код ответа и выполняет перенаправление. |
| abstract public | `responseCode(string $code): void`<br>Sets the HTTP response code with the specified status code.<br>-------------------------<br>Устанавливает HTTP-код ответа с указанным кодом состояния. |
<hr>

###### created with [Rudra-Documentation-Collector](#https://github.com/Jagepard/Rudra-Documentation-Collector)
