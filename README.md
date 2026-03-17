# 📊 CPA 2026 – Sistema de Avaliação Institucional (UEAP)

Sistema Laravel para aplicação dos questionários da Comissão Própria de Avaliação (CPA), seguindo o modelo SINAES/MEC.

## ✅ Estado atual

O sistema atualmente possui:

- **7 surveys completos** (por público) com seeders oficiais.
- Fluxo público com **landing page** (`/`) e autenticação por **CPF + senha** (`/login`).
- Redirecionamento automático após login:
  - usuário comum → survey da sua audiência,
  - admin → consulta simples em `/admin/reports`.
- Controle de acesso por audiência (usuário comum só acessa seu próprio survey).
- Persistência de respostas em `responses` + `answers` (valor em JSON/array).
- Interface visual institucional (paleta azul/laranja, layout acolhedor e legível).

---

## 🚀 Funcionalidades

- Múltiplos questionários por público.
- Estrutura por dimensões (I–X) + perguntas gerais e finais.
- Tipos de pergunta: RADIO, CHECKBOX, LIKERT, TEXT.
- Escalas Likert de 6 e 7 pontos (conforme regras CPA).
- Área administrativa básica para consulta de respostas por questionário.

---

## 🧱 Stack

- PHP 8.2+
- Laravel 12
- Filament 5 (painel admin)
- MySQL / MariaDB

---

## ⚙️ Instalação rápida

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

Acesse: `http://localhost:8000`

---

## 👤 Usuários seedados

O seeder do sistema cria **100 usuários**:

- **2 admins**
  - CPF: `00000000001`
  - CPF: `00000000002`
- **98 usuários comuns** com variação de `cpf` e `audience`.
- Senha padrão dos usuários seedados: `password`.

---

## 📚 Documentação

- `docs/install.md`
- `docs/architecture.md`
- `docs/LLM.md`

---

## 🎯 Objetivo

Priorizar confiabilidade institucional, rastreabilidade e aderência ao documento oficial da CPA.
