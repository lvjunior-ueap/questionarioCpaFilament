# Plano de Implementação - Hardening de Segurança

## Status: CRÍTICO → Resulta de testes OWASP Top 10

## Prioridades

### P1: BLOQUEANTE (Implementar ASAP)
- [ ] **Headers de Segurança** - Missing X-Frame-Options, CSP, XSS-Protection, X-Content-Type-Options
  - Risco: Clickjacking, XSS, MIME Sniffing
  - Implementar via `app/Http/Middleware/SecurityHeaders.php`
  - Aplicar globalmente em `app/Http/Kernel.php`

- [ ] **X-Powered-By Removal** - PHP Version Disclosure
  - Risco: Information Disclosure (baixo, mas fácil de eliminar)
  - Remover em `php.ini` ou via middleware

### P2: IMPORTANTE (Próximas sprints)
- [ ] **HTTPS Enforcement** - Em produção, forçar SSL/TLS
  - Implementar em config/app.php ou via `.env`
  - Verificar certificado SSL/TLS

- [ ] **Testes de Segurança Automatizados**
  - CI/CD pipeline com verificação de headers
  - Unit tests para validar middlewares

### P3: NICE-TO-HAVE
- [ ] **Rate Limiting no Login** - Prevenir brute force
  - Implementar em routes/web.php com throttle middleware
  
- [ ] **Session Timeout** - Logout automático após inatividade
  - Config em config/session.php

---

## Arquivos a Modificar / Criar

### Criação
1. `app/Http/Middleware/SecurityHeaders.php` - Novo middleware com headers
2. `config/security.php` - Arquivo de config centralizado (opcional)

### Modificação
1. `app/Http/Kernel.php` - Registrar middleware
2. `config/app.php` - Alterar 'debug' e outras configs
3. `.env` (template) - Adicionar variáveis de segurança
4. `php.ini` - Remover X-Powered-By (se possível)

---

## Detalhamento das Tarefas

### Task 1: Middleware de Headers de Segurança
**Responsável**: Agente Implementador
**Tempo estimado**: 30 min
**Arquivo**: Criar `app/Http/Middleware/SecurityHeaders.php`

Headers a adicionar:
```
X-Frame-Options: DENY
X-Content-Type-Options: nosniff
X-XSS-Protection: 1; mode=block
Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline'; img-src *; font-src 'self' data:;
Strict-Transport-Security: max-age=31536000; includeSubDomains (apenas em HTTPS)
Referrer-Policy: strict-origin-when-cross-origin
Permissions-Policy: geolocation=(), microphone=(), camera=()
```

### Task 2: Registrar Middleware Globalmente
**Responsável**: Agente Implementador
**Tempo estimado**: 10 min
**Arquivo**: Modificar `app/Http/Kernel.php`
- Adicionar `\App\Http\Middleware\SecurityHeaders::class` em `$middleware`

### Task 3: Remover X-Powered-By
**Responsável**: Agente Implementador
**Tempo estimado**: 5 min
**Opções**:
- A) Adicionar em middleware: `header_remove('X-Powered-By');`
- B) Editar `php.ini`: `expose_php = Off`
- C) Via `.htaccess` (Apache): `Header unset X-Powered-By`

### Task 4: Atualizar Variáveis .env
**Responsável**: Agente Implementador
**Tempo estimado**: 5 min
**Arquivo**: `.env` template
```
APP_ENV=production
APP_DEBUG=false
SESSION_SECURE_COOKIES=true (em produção)
SESSION_HTTP_ONLY=true
```

### Task 5: Rate Limiting no Login (Opcional)
**Responsável**: Agente Implementador
**Tempo estimado**: 20 min
**Arquivo**: Modificar `routes/web.php`
- Envolver rota POST /login com `throttle:5,1` (5 tentativas por minuto)

### Task 6: Testes de Segurança
**Responsável**: Agente Implementador (QA)
**Tempo estimado**: 15 min
**Validação**:
```bash
# Após implementação, rodar:
curl -I http://localhost:8002/ | grep -E "X-Frame|CSP|X-XSS|X-Content"
# Deve retornar todos os headers
```

---

## Comandos de Implementação (Resumido)

```bash
# 1. Criar middleware
php artisan make:middleware SecurityHeaders

# 2. Testar headers
curl -I http://localhost:8002/

# 3. Commit
git add . && git commit -m "security: adicionar headers de segurança (A05, A08)"
```

---

## Resultados Esperados (Pós-Implementação)

| Teste | Antes | Depois |
|---|---|---|
| Headers ausentes | ❌ | ✅ |
| X-Powered-By | ⚠️ PHP/8.4 exposto | ✅ Removido |
| CSRF | ✅ | ✅ (sem mudança) |
| Auth | ✅ | ✅ (sem mudança) |

---

## Notas de Contexto

- **Stack**: Laravel 11, PHP 8.4
- **Foco**: OWASP A05 (Security Misconfiguration), A08 (Data Integrity Failures)
- **Ambiente**: Dev (HTTP); Produção deve usar HTTPS
- **Impacto**: Baixo risco de breaking changes (apenas adição de headers)

---

## Follow-up

Após P1 completo, revisar:
- Rate limiting no login (P2)
- HTTPS em produção
- WAF (Web Application Firewall) em produção
