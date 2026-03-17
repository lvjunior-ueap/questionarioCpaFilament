# 📊 CPA 2026 – Sistema de Avaliação Institucional (UEAP)

Sistema desenvolvido em Laravel para aplicação dos questionários da Comissão Própria de Avaliação (CPA), seguindo o modelo do SINAES (MEC).

---

## 🚀 Funcionalidades

* Múltiplos questionários por público
* Estrutura baseada em dimensões (I–X)
* Suporte a escalas Likert (6 e 7 pontos)
* Respostas anônimas
* Seeders completos com dados oficiais

---

## 🧱 Stack

* Laravel
* MySQL / MariaDB
* PHP 8+

---

## ⚙️ Instalação rápida

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

---

## 📚 Documentação

* `docs/install.md`
* `docs/architecture.md`

---

## 🎯 Objetivo

Sistema voltado para:

* confiabilidade institucional
* rastreabilidade
* aderência ao documento oficial da CPA

---

## ⚠️ Observação

O projeto prioriza **clareza e fidelidade ao modelo da CPA**, não otimização de código.

---
