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
# Subscribe
```javascript
	  ///////////////////////////
	 // Inscription à mercure //
	///////////////////////////

	// Initialisation de l'url mercure
	const url = new URL('http://localhost:3000/.well-known/mercure')
	// On ajoute le "topic" correspondant aux notifications de chat
	url.searchParams.append('topic','/chat')
	// On écoute les évènements provenant de mercure
	const eventSource = new EventSource(url)
	eventSource.onmessage = (e) => {
		alert('ok');
		console.log(e)
	}
	// Désinscription à mercure
	window.addEventListener('beforeunload', function () {
		if(eventSource != null){
		    eventSource.close()
		}
	})
```
