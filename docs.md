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
|public|<em><strong>run</strong>( string $url  string $type  string $code ): void</em><br>|
|public|<em><strong>responseCode</strong>( string $code ): void</em><br>|
|private|<em><strong>redirectTo</strong>( string $url  string $type ): void</em><br>|
|private|<em><strong>getCodeMessage</strong>( string $code ): string</em><br>|
|private|<em><strong>getRedirectType</strong>( string $type ): string</em><br>|


<a id="rudra_redirect_redirectfacade"></a>

### Class: Rudra\Redirect\RedirectFacade
| Visibility | Function |
|:-----------|:---------|
|public static|<em><strong>__callStatic</strong>( string $method  array $parameters ): mixed</em><br>|


<a id="rudra_redirect_redirectinterface"></a>

### Class: Rudra\Redirect\RedirectInterface
| Visibility | Function |
|:-----------|:---------|
|abstract public|<em><strong>run</strong>( string $url  string $type  string $code ): void</em><br>|
|abstract public|<em><strong>responseCode</strong>( string $code ): void</em><br>|
<hr>

###### created with [Rudra-Documentation-Collector](#https://github.com/Jagepard/Rudra-Documentation-Collector)
