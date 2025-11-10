# Sistema de Gestão CCT - Timor Leste

[![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-orange.svg)](https://mysql.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

Sistema completo de gestão de café desenvolvido em Laravel para Timor Leste. Gerencie produtores, tipos de café, armazéns, transações e gere relatórios profissionais mensais.

## 🌟 Características

- **Gestão Completa de Produtores**: CRUD completo para cadastro e gerenciamento de produtores de café
- **Tipos de Café**: Controle de diferentes variedades e tipos de café
- **Armazéns**: Gestão de locais de armazenamento
- **Transações**: Registro de produção e vendas com controle de estoque
- **Relatórios Profissionais**: Relatórios mensais com gráficos, métricas e impressão otimizada
- **Dashboard Administrativo**: Interface moderna com navegação intuitiva
- **Autenticação**: Sistema de login e registro seguro
- **Interface Responsiva**: Design adaptável para desktop e mobile

## 🚀 Instalação e Configuração

### Pré-requisitos

- PHP 8.2 ou superior
- Composer
- MySQL 8.0 ou superior
- Node.js e NPM (para assets)
- XAMPP ou servidor web similar

### Passos de Instalação

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/GrigorioG3123/SIstema-Ai-Fuan-Kakau.git
   cd SIstema-Ai-Fuan-Kakau
   ```

2. **Instale as dependências do PHP:**
   ```bash
   composer install
   ```

3. **Instale as dependências do Node.js:**
   ```bash
   npm install
   ```

4. **Configure o arquivo de ambiente:**
   ```bash
   cp .env.example .env
   ```

   Edite o arquivo `.env` com suas configurações:
   ```env
   APP_NAME="Sistema CCT - Timor Leste"
   APP_ENV=local
   APP_KEY=
   APP_DEBUG=true
   APP_URL=http://localhost

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=cct_laravel
   DB_USERNAME=seu_usuario
   DB_PASSWORD=sua_senha
   ```

5. **Gere a chave da aplicação:**
   ```bash
   php artisan key:generate
   ```

6. **Execute as migrações e seeders:**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Compile os assets:**
   ```bash
   npm run build
   # ou para desenvolvimento
   npm run dev
   ```

8. **Inicie o servidor:**
   ```bash
   php artisan serve
   ```

   Acesse: http://localhost:8000

## 📊 Funcionalidades

### Gestão de Produtores
- Cadastro completo de produtores
- Visualização de detalhes
- Edição de informações
- Controle de status ativo/inativo

### Gestão de Café
- Cadastro de tipos de café
- Controle de variedades
- Gestão de preços e características

### Gestão de Armazéns
- Cadastro de locais de armazenamento
- Controle de capacidade
- Localização geográfica

### Transações
- Registro de produção
- Registro de vendas
- Controle de estoque automático
- Histórico completo de transações

### Relatórios
- **Relatório Geral**: Visão geral do sistema
- **Relatório Anual**: Análise anual com gráficos
- **Relatório Mensal**: Relatório profissional mensal com:
  - Resumo executivo com métricas chave
  - Gráfico de desempenho produção vs vendas
  - Quebra detalhada por tipo de transação
  - Desempenho diário (quando disponível)
  - Otimização para impressão

## 🛠️ Tecnologias Utilizadas

- **Laravel 10.x**: Framework PHP robusto e elegante
- **MySQL**: Banco de dados relacional
- **Bootstrap 5**: Framework CSS responsivo
- **Chart.js**: Gráficos interativos
- **AdminLTE**: Template administrativo
- **Font Awesome**: Ícones vetoriais
- **Vite**: Build tool moderno

## 📁 Estrutura do Projeto

```
cct-laravel/
├── app/
│   ├── Http/Controllers/Admin/    # Controladores administrativos
│   ├── Models/                   # Modelos Eloquent
│   └── Providers/               # Service Providers
├── database/
│   ├── migrations/              # Migrações do banco
│   └── seeders/                 # Seeders para dados iniciais
├── public/                      # Assets públicos
├── resources/
│   ├── css/                     # Stylesheets
│   ├── js/                      # JavaScript
│   └── views/                   # Templates Blade
│       └── admin/               # Views administrativas
│           ├── relatorios/      # Relatórios
│           ├── produtors/       # Gestão de produtores
│           ├── kafe-tipu/       # Tipos de café
│           ├── armajen/         # Armazéns
│           └── transasauns/     # Transações
└── routes/
    └── web.php                  # Rotas da aplicação
```

## 🔧 Comandos Úteis

```bash
# Limpar cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Executar testes
php artisan test

# Criar novo controlador
php artisan make:controller NomeController

# Criar nova migração
php artisan make:migration nome_da_migracao

# Criar novo model
php artisan make:model NomeModel
```

## 📈 Relatórios Disponíveis

### Relatório Mensal
- **Métricas Principais**: Produção total, vendas, estoque atual, receita
- **Taxa de Conversão**: Percentual de produção convertida em vendas
- **Gráfico de Desempenho**: Comparação visual produção vs vendas
- **Quebra Detalhada**: Análise por tipo de transação
- **Desempenho Diário**: Quando há dados suficientes
- **Impressão Otimizada**: Layout profissional para relatórios impressos

## 🤝 Contribuição

1. Fork o projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📝 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## 👥 Desenvolvedores

- **GrigorioG3123** - Desenvolvimento inicial

## 🙏 Agradecimentos

- Laravel Framework
- Comunidade PHP
- Governo de Timor Leste
- Produtores de café locais

## 📞 Suporte

Para suporte técnico ou dúvidas:
- Abra uma issue no GitHub
- Email: [seu-email@exemplo.com]

---

**Sistema desenvolvido para Timor Leste 🇹🇱**
*Promovendo a gestão eficiente da produção de café local*
