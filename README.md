# Desafio Back-end Payme

Muito obrigado pela oportunidade, realizei o teste tentando me aproximar o máximo possível do solicitado.


### Tecnologias encolhidas:

- PHP (Laravel com Blade): Optei por criar uma versão monolito de base, reutilizando as funções criadas usando o Repository Design Patterns, onde separamos as consultas ao banco por repositórios para criar uma API RESTFul, separada, usando o Sanctum do Laravel para criar autenticação Bearer Token dessa API para proteger as rotas necessárias.
- Docker: Criei uma imagem docker-compose para rodar o projeto.

## Rodando o projeto

```bash
docker-compose up --build
```

## Rotas da aplicação

Rota para login, onde é retornado o Bearer Token:
```http request
POST /login
Content-Type: application/json

{
  "email": "douglaspaianix@gmail.com",
  "password": "admin"
}
```

Rota para registrar um novo usuário, usando Bearer Token gerado no login:
> O parâmetro balance é informado o saldo inicial do usuário, que receberá uma transferência no ato do cadastro, caso não seja informado, o valor será de 1000.

```http request
POST /register
Content-Type: application/json

{
  "nome": "Douglas Paiani",
  "email": "douglaspaianixs@gmail.com",
  "cpf": "03737736091",
  "senha": "admin",
  "balance": 2000
}
```

Rota para efetuar uma nova transferência, usando Bearer Token gerado no login:
```http request
POST /transfer
Content-Type: application/json

{
  "value": 100.0,
  "payer": 4,
  "payee": 15
}
```

Rota para conferir o saldo em carteira de qualquer usuário:
```http request
GET /balance/{id}
Content-Type: application/json
```

