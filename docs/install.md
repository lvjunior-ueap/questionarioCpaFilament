# 📦 Instalação – Projeto CPA 2026 (UEAP)

## 📋 Requisitos

* PHP 8.1+
* Composer
* MySQL / MariaDB
* Node.js (opcional, se usar assets)
* Laravel CLI

---

## 🚀 Passo a passo

### 1. Clonar o projeto

```bash
git clone <repo-url>
cd questionarioCpaFilament
```

---

### 2. Instalar dependências

```bash
composer install
```

---

### 3. Configurar ambiente

```bash
cp .env.example .env
```

Editar `.env` com os dados do banco:

```env
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
```

---

### 4. Gerar chave da aplicação

```bash
php artisan key:generate
```

---

### 5. Rodar migrations + seeders

```bash
php artisan migrate:fresh --seed
```

---

### 6. Subir servidor local

```bash
php artisan serve
```

Acesse:

```
http://localhost:8000
```

---

## 🧪 Reset completo do banco

Sempre que precisar recriar tudo:

```bash
php artisan migrate:fresh --seed
```

---

## ⚠️ Observações

* Os seeders criam **todos os questionários completos**
* Não é necessário criar dados manualmente
* O sistema já inicia pronto para uso

---
