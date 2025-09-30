# 🎬 Controle de Filmes Assistidos

Sistema simples para gerenciar sua lista de filmes assistidos e não assistidos.

## ✨ Funcionalidades

- � Cadastrar filmes (título, diretor, ano, avaliação)
- ✅ Marcar como assistido/não assistido
- 🔍 Pesquisar filmes por título
- 📱 Interface responsiva

## � Como usar

### Instalação
```bash
# Clone o projeto
git clone https://github.com/PedroLuucas/controle-de-filmes-assistidos.git
cd controle-de-filmes-assistidos

# Instale dependências
composer install
npm install

# Configure o ambiente
cp .env.example .env
php artisan key:generate
php artisan migrate

# Inicie o servidor
php artisan serve
```

### Primeiro acesso
1. Acesse `http://localhost:8000`
2. Clique em "Cadastre-se aqui" para criar uma conta
3. Faça login e comece a adicionar seus filmes

## 🛠️ Tecnologias

- Laravel 12
- PHP 8.2
- Tailwind CSS
- SQLite
