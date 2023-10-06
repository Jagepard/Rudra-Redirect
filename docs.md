## Table of contents
- [Rudra\Redirect\Redirect](#rudra_redirect_redirect)
- [Rudra\Redirect\RedirectFacade](#rudra_redirect_redirectfacade)
- [Rudra\Redirect\RedirectInterface](#rudra_redirect_redirectinterface)
<hr>

<a id="rudra_redirect_redirect"></a>

### Class: Rudra\Redirect\Redirect
##### implements [Rudra\Redirect\RedirectInterface](#rudra_redirect_redirectinterface)
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>run</strong>( string $url  string $type  string $code ): void</em><br>Redirects to the specified destination<br>Перенаправляет по указанному адресату|
|public|<em><strong>responseCode</strong>( string $code ): void</em><br>Sets HTTP response status code<br>Устанавливает код состояния ответа HTTP|
|private|<em><strong>redirectTo</strong>( string $url  string $type ): void</em><br>Redirects to the specified destination<br>Перенаправляет по указанному адресату|
|private|<em><strong>getCodeMessage</strong>( string $code ): string</em><br>Gets HTTP status message<br>Получает сообщение о статусе HTTP|
|private|<em><strong>getRedirectType</strong>( string $type ): string</em><br>Gets the prefix for the HTTP header<br>Получает префикс для HTTPзаголовка|


<a id="rudra_redirect_redirectfacade"></a>

### Class: Rudra\Redirect\RedirectFacade
| Visibility | Function |
|:-----------|:---------|
|public static|<em><strong>__callStatic</strong>( string $method  array $parameters )</em><br>Calls class methods statically<br>Вызывает методы класса статически|


<a id="rudra_redirect_redirectinterface"></a>

### Class: Rudra\Redirect\RedirectInterface
| Visibility | Function |
|:-----------|:---------|
|abstract public|<em><strong>run</strong>( string $url  string $type  string $code ): void</em><br>Redirects to the specified destination<br>Перенаправляет по указанному адресату|
|abstract public|<em><strong>responseCode</strong>( string $code ): void</em><br>Sets HTTP response status code<br>Устанавливает код состояния ответа HTTP|
<hr>

###### created with [Rudra-Documentation-Collector](#https://github.com/Jagepard/Rudra-Documentation-Collector)
