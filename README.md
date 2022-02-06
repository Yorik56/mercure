# Project Mercure Symfony 6 

## Launch project 
*At the root of this project*

> Get dependencies 

`composer install`

> Create database

`doctrine:migrations:migrate`

> Build css/js

`yarn watch`

> Launch mercure server (after configuration)

`make mercure mercure_server`

## Get Mercure
[https://mercure.rocks/](https://mercure.rocks/)


## How it works

![img.png](assets/img.png)
[tldraw.com](https://www.tldraw.com/)
## Install

```
composer req mercure
```

## Config

> .env

```
MERCURE_URL=http://localhost:3000/.well-known/mercure
MERCURE_PUBLIC_URL=http://localhost:3000/.well-known/mercure
MERCURE_PUBLISH_URL=.well-known/mercure
MERCURE_JWT_SECRET=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJtZXJjdXJlIjp7InN1YnNjcmliZSI6WyIqIl0sInB1Ymxpc2giOlsiKiJdfX0.M1yJUov4a6oLrigTqBZQO_ohWUsg3Uz1bnLD4MIyWLo
```

> [config/packages/mercure.yaml](https://github.com/Yorik56/mercure/blob/main/config/packages/mercure.yaml)

```yaml
mercure:
    hubs:
        default:
            url: '%env(MERCURE_URL)%'
            jwt: '%env(MERCURE_JWT_SECRET)%'
```
> [Makefile](https://github.com/Yorik56/mercure/blob/main/Makefile)
```yaml
mercure_server:
	./bin/mercure --publisher-jwt-key='!ChangeMe!' --jwt-key='!ChangeMe!' --addr='localhost:3000' --demo='1' --debug --allow-anonymous='1' --cors-allowed-origins='*' --publish-allowed-origins='http://localhost:3000/.well-known/mercure'
```

## Client Side
### Subscribe to mercure
> [index.html.twig](https://github.com/Yorik56/mercure/blob/main/templates/home/index.html.twig)
```javascript
	// Init mercure url
	const url = new URL('http://localhost:3000/.well-known/mercure')
	// Adding "topic" corresponding to chat notifications
	url.searchParams.append('topic','/chat')
	// Listening events from mercure
	const eventSource = new EventSource(url)
	eventSource.onmessage = (e) => {
		alert('ok');
		console.log(e)
	}
	// Unsubsribe to mercure listenig
	window.addEventListener('beforeunload', function () {
		if(eventSource != null){
		    eventSource.close()
		}
	})
```
## Server Side

### Publishing data
> [HomeController.php](https://github.com/Yorik56/mercure/blob/main/src/Controller/HomeController.php)
```php
    use Symfony\Component\Mercure\HubInterface;
    use Symfony\Component\Mercure\Update;
    
    ...

    #[Route('/push', name: 'push')]
    public function push(HubInterface $hub): Response
    {
        $update = new Update(
            '/chat',
            json_encode(['data' => 0])
        );

        $hub->publish($update);
        return new Response($this->generateUrl("chat"));
    }
```
