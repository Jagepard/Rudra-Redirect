## Table of contents

- [\Rudra\Redirect](#class-rudraredirect)
- [\Rudra\Interfaces\RedirectInterface (interface)](#interface-rudrainterfacesredirectinterface)

<hr /><a id="class-rudraredirect"></a>
### Class: \Rudra\Redirect

> Class Redirect

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Rudra\Interfaces\ContainerInterface</em> <strong>$container</strong>, <em>\string</em> <strong>$url</strong>, <em>\string</em> <strong>$env</strong>)</strong> : <em>void</em><br /><em>Redirect constructor.</em> |
| public | <strong>container()</strong> : <em>\Rudra\Interfaces\ContainerInterface</em> |
| public | <strong>getUrl()</strong> : <em>string</em> |
| public | <strong>responseCode(</strong><em>\string</em> <strong>$code</strong>)</strong> : <em>void</em> |
| public | <strong>run(</strong><em>\string</em> <strong>$url=`''`</strong>, <em>\string</em> <strong>$type=`''`</strong>, <em>\string</em> <strong>$code=`'302'`</strong>)</strong> : <em>void</em> |
| protected | <strong>getCodeMessage(</strong><em>\string</em> <strong>$code</strong>)</strong> : <em>string</em> |
| protected | <strong>getRedirectType(</strong><em>\string</em> <strong>$type</strong>)</strong> : <em>string</em> |
| protected | <strong>redirectTo(</strong><em>mixed/\string</em> <strong>$url</strong>, <em>mixed/\string</em> <strong>$type</strong>)</strong> : <em>void</em> |

*This class implements [\Rudra\Interfaces\RedirectInterface](#interface-rudrainterfacesredirectinterface)*

<hr /><a id="interface-rudrainterfacesredirectinterface"></a>
### Interface: \Rudra\Interfaces\RedirectInterface

> Interface RedirectInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\Rudra\Interfaces\ContainerInterface</em> <strong>$container</strong>, <em>\string</em> <strong>$appUrl</strong>, <em>\string</em> <strong>$env</strong>)</strong> : <em>void</em><br /><em>RedirectInterface constructor.</em> |
| public | <strong>responseCode(</strong><em>\string</em> <strong>$code</strong>)</strong> : <em>void</em> |
| public | <strong>run(</strong><em>\string</em> <strong>$url=`''`</strong>, <em>\string</em> <strong>$type=`''`</strong>, <em>\string</em> <strong>$code=`''`</strong>)</strong> : <em>mixed</em> |

