# 📦 Instalação – Projeto CPA 2026 (UEAP)

## 📋 Requisitos

- PHP 8.2+
- Composer
- MySQL / MariaDB
- Node.js (opcional para assets)

---

## 🚀 Passo a passo

### 1) Clonar

```bash
git clone <repo-url>
cd questionarioCpaFilament
```

### 2) Instalar dependências

```bash
composer install
```

### 3) Configurar ambiente

```bash
cp .env.example .env
```

Ajuste banco no `.env`:

```env
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
```

### 4) Gerar chave

```bash
php artisan key:generate
```

### 5) Migrar e popular banco

```bash
php artisan migrate:fresh --seed
```

### 6) Subir aplicação

```bash
php artisan serve
```

Acesse: `http://localhost:8000`

---

## 🔐 Fluxo de acesso

- Página inicial: `/`
- Login: `/login` (CPF + senha)
- Após login:
  - usuário comum → `/survey/{audience}`
  - admin → `/admin/reports`

---

## 👥 Seed de usuários

`SystemUsersSeeder` cria 100 usuários:

- 2 administradores (`is_admin = true`)
- 98 não-admin (`is_admin = false`)

Credenciais de admin para homologação:

- CPF: `00000000001` / senha: `password`
- CPF: `00000000002` / senha: `password`

---

## 🧪 Reset completo

```bash
php artisan migrate:fresh --seed
```
