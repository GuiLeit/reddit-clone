# DEVELOPMENT.md - Reddit Clone

## Visão Geral da Solução

Este projeto é um clone do Reddit desenvolvido em Laravel. A aplicação permite aos usuários criar comunidades, postar conteúdo, comentar e votar em posts e comentários.

### Funcionalidades Principais

- **Sistema de Autenticação**: Login/registro via Filament
- **Comunidades**: Criação e gestão de comunidades
- **Posts**: Criação de posts com título, corpo e comunidade
- **Comentários**: Sistema de comentários
- **Sistema de Votação**: Upvote/downvote para posts e comentários
- **Interface Responsiva**: Layout responsivo para mobile e desktop
- **Painel Administrativo**: Gestão completa via Filament

### Arquitetura Técnica

- **Backend**: Laravel 11 com Eloquent ORM
- **Frontend**: Blade Templates + Alpine.js + Tailwind CSS
- **Admin Panel**: Filament v4
- **Build Tools**: Vite
- **Database**: Sqlite

## Justificativa das Principais Decisões Técnicas

- Tabela "CommunityMembers" -> ligar as comunidades aos usuários
- "creator_id" na tabela de comunidades -> reduzir a carga do banco de dados ao executar querys de verificação para atualizar as comunidades
- Tabelas de votos separadas para posts e comentários -> reduzir a carga do banco de dados ao listar dados

## Anotações do Processo

**Período**: Início do desenvolvimento
**Atividades**:

- Configuração do Laravel 11 com Vite e Filament V4 (fornecido pelo organizador do projeto)
- Desenvolvimento do diagrama relacional de banco de dados
- Criação do layout
- Criação das Comunidades com membros
- Criação do painel de administrador com Filament
- Criação de Posts
- Criação de Comentários

**Desafios Encontrados**:

- Compatibilidade entre Filament v4 e Laravel 11
- Configuração do painel do usuário com Filament v4
- Setup inicial das variáveis CSS
