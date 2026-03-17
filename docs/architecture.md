# 🧠 Arquitetura – Projeto CPA 2026 (UEAP)

## 📊 Visão Geral

Sistema de avaliação institucional baseado no SINAES/MEC, com surveys por público e captura estruturada de respostas.

## 🔄 Fluxo principal

1. Usuário acessa `/` (landing page).
2. Faz login em `/login` com **CPF + senha**.
3. Sistema redireciona:
   - admin → `/admin/reports`
   - não-admin → `/survey/{audience}`
4. Usuário responde questionário.
5. Sistema grava:
   - `responses` (submissão)
   - `answers` (resposta por pergunta, em JSON)

## 🧱 Modelo de dados

```text
Survey
├── Questions (gerais)
├── Dimensions
│   └── Questions
│       └── Options
└── Responses
    └── Answers
```

### Entidades

- **Survey**: name, audience, year, version, is_active, intro_text
- **Dimension**: survey_id, name, order
- **Question**: survey_id, dimension_id (nullable), text, type, required, order
- **Option**: question_id, label, value, order
- **Response**: survey_id, respondent_hash (nullable)
- **Answer**: response_id, question_id, value (json)
- **User**: name, email, cpf, audience (nullable), is_admin

## 🔐 Autorização

- Rotas de survey exigem autenticação.
- Middleware de audiência impede usuário comum de acessar survey de outro público.
- Relatório administrativo é protegido por middleware de admin.

## 👨‍💼 Consulta admin

A consulta simples em `/admin/reports` traz por survey:

- quantidade de respostas (`withCount('responses')`)
- data/hora da última resposta (`withMax('responses', 'created_at')`)

## 🎨 Interface

As telas públicas/admin usam layout unificado com estilo institucional (cores azul/laranja), melhorando legibilidade e acolhimento.
