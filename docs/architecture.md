# 🧠 Arquitetura – Projeto CPA 2026 (UEAP)

## 📊 Visão Geral

Sistema de avaliação institucional baseado no modelo do **SINAES (MEC)**, implementado em Laravel.

Estrutura orientada a:

* Clareza
* Rastreabilidade
* Fidelidade ao documento oficial da CPA

---

## 🧱 Modelo de Dados

Hierarquia principal:

```
Survey
├── Questions (gerais)
├── Dimensions
│   └── Questions
└── Responses
    └── Answers
```

---

## 🧩 Entidades principais

### Survey

Representa um questionário completo.

Campos principais:

* name
* audience (enum)
* year
* version
* is_active
* intro_text

Relacionamentos:

* `dimensions()`
* `questions()` ← geral
* `generalQuestions()` ← sem dimensão
* `finalQuestions()` ← pergunta final (ex: sugestões)

---

### Dimension

Agrupa perguntas por tema (SINAES I–X)

* survey_id
* name
* order

---

### Question

Elemento central do sistema.

* survey_id (obrigatório)
* dimension_id (opcional)
* text
* type (enum)
* required
* order

Tipos:

* RADIO
* CHECKBOX
* LIKERT
* TEXT

---

### Option

Opções de resposta para perguntas fechadas.

* question_id
* label
* value
* order

---

### Response

Representa uma submissão completa de um usuário.

* survey_id
* respondent_hash (anonimato)

---

### Answer

Resposta individual de uma pergunta.

* response_id
* question_id
* value (JSON/array)

---

## 📊 Escalas Likert

### Likert 7 (padrão)

* Não sei
* Não se aplica
* Discordo totalmente
* Discordo parcialmente
* Indiferente
* Concordo parcialmente
* Concordo totalmente

---

### Likert 6 (sem NSA)

* Não sei
* Discordo totalmente
* Discordo parcialmente
* Indiferente
* Concordo parcialmente
* Concordo totalmente

---

## ⚠️ Particularidades

### Dimensão IV (Comunicação)

Possui 3 blocos:

1. CHECKBOX (formas de comunicação)
2. LIKERT por meio (escala 6)
3. Indicadores gerais (escala 6)

---

### Dimensão IX

* Usa escala Likert 6

---

### Perguntas fora de dimensão

Separadas em:

* `generalQuestions()` → início
* `finalQuestions()` → final (ex: sugestões)

---

## 🧠 Decisões arquiteturais

* ❌ Sem abstração excessiva
* ❌ Sem geração dinâmica
* ✅ Seeders explícitos
* ✅ Código repetido intencionalmente

Motivo:

> Permitir validação direta pela equipe da CPA

---

## 🔄 Fluxo de dados

1. Usuário acessa survey
2. Sistema carrega:

   * perguntas gerais
   * dimensões + perguntas
3. Usuário responde
4. Cria:

   * Response
   * Answers vinculados

---

## 🎯 Objetivo do sistema

* Avaliação institucional confiável
* Estrutura auditável
* Aderência ao SINAES

---
