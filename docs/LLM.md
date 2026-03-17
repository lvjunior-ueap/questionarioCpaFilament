# 📊 Projeto CPA 2026 – Guia rápido para LLMs

## Contexto

Aplicação Laravel para questionários da CPA/UEAP (ciclo 2025 aplicado em 2026), com surveys separados por público.

## O que está implementado hoje

- 7 surveys seedados (Docente, Técnico, Discente, Comunidade Externa, Egresso, Transposição, Gestão).
- 10 dimensões por survey (com regras específicas de Likert onde aplicável).
- Login por CPF (`/login`) e redirecionamento automático por perfil.
- Área de consulta administrativa (`/admin/reports`).
- 100 usuários seedados (2 admins + 98 comuns).

## Rotas-chave

- `GET /` → landing
- `GET /login` / `POST /login`
- `POST /logout`
- `GET|POST /survey/{audience}` (com proteção por audiência)
- `GET /admin/reports` (somente admin)

## Regras importantes de modelagem

- `Question` sempre tem `survey_id`.
- `dimension_id` pode ser `null` para perguntas gerais/finais.
- Resposta sempre salva em `answers.value` como array/json.

## Regras dos seeders (manter)

- Não refatorar de forma agressiva (repetição intencional).
- Não alterar textos/ordem das opções Likert.
- Dimensão IV mantém estrutura em 3 blocos.
- Dimensão IX usa Likert 6 (sem “Não se aplica”).

## Dados de acesso seedados (homologação)

- Admin 1: CPF `00000000001` / senha `password`
- Admin 2: CPF `00000000002` / senha `password`

## Objetivo do projeto

Confiabilidade, rastreabilidade e aderência institucional (clareza > abstração).
