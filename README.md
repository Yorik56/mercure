# Install

```
composer req mercure
```

# Config

> .env

```
MERCURE_URL=http://localhost:3000/.well-known/mercure
MERCURE_PUBLIC_URL=http://localhost:3000/.well-known/mercure
MERCURE_PUBLISH_URL=.well-known/mercure
MERCURE_JWT_SECRET=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJtZXJjdXJlIjp7InN1YnNjcmliZSI6WyIqIl0sInB1Ymxpc2giOlsiKiJdfX0.M1yJUov4a6oLrigTqBZQO_ohWUsg3Uz1bnLD4MIyWLo
```

> config/packages/mercure.yaml

```yaml
mercure:
    hubs:
        default:
            url: '%env(MERCURE_URL)%'
            jwt: '%env(MERCURE_JWT_SECRET)%'
```
> Makefile
```yaml
mercure_server:
	./bin/mercure --publisher-jwt-key='!ChangeMe!' --jwt-key='!ChangeMe!' --addr='localhost:3000' --demo='1' --debug --allow-anonymous='1' --cors-allowed-origins='*' --publish-allowed-origins='http://localhost:3000/.well-known/mercure'
```

# Client Side
## Subscribe to mercure
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
# Server Side

## Publishing data

```php
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
