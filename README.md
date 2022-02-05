# mercure

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
