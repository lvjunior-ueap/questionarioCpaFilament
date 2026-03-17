# 📊 Projeto CPA 2026 – Sistema de Avaliação Institucional (UEAP)

## 📌 Contexto

Sistema desenvolvido em **Laravel** para aplicação dos questionários da **Comissão Própria de Avaliação (CPA)** da UEAP, referente ao ciclo de avaliação de 2025 (aplicação em 2026).

O sistema segue o modelo do **SINAES (MEC)** e contém múltiplos questionários, cada um direcionado a um público específico.

---

## 👥 Públicos (Surveys)

Cada público possui um **seeder próprio**, com estrutura independente:

* Docente
* Técnico
* Discente
* Comunidade Externa
* Egresso
* Funcionários de Transposição
* Gestão

Cada survey possui:

* `name`
* `audience` (enum `AudienceType`)
* `year`
* `version`
* `is_active`
* `intro_text`

---

## 🧱 Estrutura de Dados

Hierarquia:

Survey
└── Dimensions
  └── Questions
    └── Options

### Models principais:

* `Survey`
* `Dimension`
* `Question`
* `Option`
* (respostas: `SurveyResponse`, `Answer`)

---

## 🧩 Tipos de Pergunta

### 1. RADIO

Usado para perguntas iniciais:

* vínculo com a UEAP
* campus

### 2. CHECKBOX

Usado em:

* Dimensão IV (formas de comunicação)

### 3. LIKERT

Principal tipo (maioria das perguntas)

---

## 📊 Escalas Likert implementadas

### ✅ Likert 7 (padrão completo)

```php
[
 'Não sei',
 'Não se aplica',
 'Discordo totalmente',
 'Discordo parcialmente',
 'Indiferente',
 'Concordo parcialmente',
 'Concordo totalmente',
]
```

### ✅ Likert 6 (sem "Não se aplica")

```php
[
 'Não sei',
 'Discordo totalmente',
 'Discordo parcialmente',
 'Indiferente',
 'Concordo parcialmente',
 'Concordo totalmente',
]
```

Helpers usados:

* `createLikertScale7()`
* `createLikertScale6SemNSA()`

---

## 📐 Estrutura das Dimensões

Cada survey segue o modelo padrão do SINAES:

1. Missão e PDI
2. Ensino, Pesquisa e Extensão
3. Responsabilidade Social
4. Comunicação com a sociedade ⚠️ (estrutura especial)
5. Políticas de pessoal
6. Organização e gestão
7. Infraestrutura
8. Planejamento e avaliação
9. Atendimento aos estudantes ⚠️ (escala 6)
10. Sustentabilidade financeira

---

## ⚠️ Particularidades importantes

### 🔹 Dimensão IV (Comunicação)

Possui **3 blocos diferentes**:

1. Checkbox (formas de comunicação)
2. Likert por meio (Rádio, TV, etc.) → escala 6
3. Indicadores gerais → escala 6

---

### 🔹 Dimensão IX

* Usa **Likert 6 (sem "Não se aplica")**

---

### 🔹 Demais dimensões

* Usam **Likert 7**

---

## 🧠 Decisão arquitetural importante

Os seeders foram construídos com as seguintes diretrizes:

* 🔁 **Repetição intencional de código**
* 📄 **Fidelidade total ao documento oficial da CPA**
* ❌ Sem abstrações avançadas
* ❌ Sem geração dinâmica de perguntas
* ✅ Clareza > DRY

Objetivo:

> Facilitar manutenção e validação por pessoas não técnicas (CPA)

---

## 🚫 Importante (não alterar por enquanto)

* NÃO refatorar os seeders
* NÃO unificar dimensões entre públicos
* NÃO abstrair estruturas
* NÃO alterar escalas

Motivo:

> O foco atual é manter consistência com o documento oficial aprovado pela CPA.

---

## ✅ Estado atual do projeto

* Todos os **7 questionários completos**
* Todas as **10 dimensões implementadas**
* Todas as **perguntas seedadas**
* Estrutura validada e consistente

---

## 🧪 Comando para reset completo

```bash
php artisan migrate:fresh --seed
```

---

## 🎯 Próximos passos esperados

* Testar fluxo completo de respostas
* Validar persistência (answers)
* Ajustes finos após validação da CPA
* (Possíveis mudanças futuras nas escalas)

---

## 💡 Observação final

Este projeto foi construído priorizando:

* confiabilidade
* rastreabilidade
* aderência institucional

E NÃO otimização de código.

---

### 🔹 Criação de perguntas

- Perguntas SEMPRE devem ser criadas via relacionamento:

  - Dentro de dimensão:
    $dimension->questions()->create([...])

  - Fora de dimensão:
    $survey->questions()->create([...]) com dimension_id = null

- NUNCA criar perguntas diretamente com Question::create sem contexto

---

### 🔹 Estrutura obrigatória

- Toda Question DEVE ter:
  - survey_id obrigatório
  - dimension_id pode ser null

---

### 🔹 Ordem de criação (seeders)

SEMPRE seguir:

1. Criar Survey
2. Criar perguntas gerais (sem dimensão)
3. Criar Dimensions
4. Criar Questions dentro das Dimensions
5. Criar Options

---

### 🔹 Escalas Likert

- NÃO alterar textos das opções
- NÃO alterar ordem
- NÃO criar novas variações

---

### 🔹 Dimensão IV (REGRA CRÍTICA)

SEMPRE seguir 3 blocos:

1. CHECKBOX (formas)
2. LIKERT por meio (escala 6)
3. Indicadores (escala 6)

---

### 🔹 Dimensão IX

- SEMPRE usar Likert 6
- NUNCA usar "Não se aplica"

---

### 🔹 Seeders

- NÃO refatorar
- NÃO usar loops genéricos avançados
- NÃO criar abstrações
- REPETIÇÃO É INTENCIONAL

---

### 🔹 Respostas (Answers)

- value é armazenado como ARRAY (JSON)
- CHECKBOX → array de valores
- RADIO / LIKERT → valor único
- TEXT → string

---

### 🔹 Proibições

NUNCA:

- Unificar seeders
- Criar factories para perguntas
- Criar geradores dinâmicos
- Alterar estrutura das dimensões
- Alterar textos das perguntas
