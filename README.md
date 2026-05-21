# 🛒 Clone OLX - Full Stack Study (Laravel)

### ⚠️ Status: Projeto de Estudo / Desenvolvimento Pausado
Este repositório é um registro da minha evolução no ecossistema PHP, utilizando o framework **Laravel**. O projeto foca na criação de um marketplace funcional, explorando desde a gestão de banco de dados até a experiência do usuário final.

---

## 💻 Sobre o Projeto
O sistema foi desenvolvido seguindo o padrão **MVC**, permitindo a listagem dinâmica de anúncios e categorias diretamente do banco de dados MySQL.

### 🛠️ O que já foi implementado (Comprovado no Código):
* **Gestão de Anúncios:** CRUD completo para anúncios (Criar, Editar, Visualizar e Deletar) utilizando `AdController`.
* **Sistema de Autenticação:** Implementação nativa do Laravel (`Auth::routes()`) para login e registro de usuários.
* **Middlewares de Segurança:** Proteção de rotas administrativas e de criação de anúncios, permitindo acesso apenas a usuários autenticados.
* **Filtros Avançados:** Lógica de busca (`SearchController`) e filtragem por categorias via Slugs amigáveis.
* **Front-end Dinâmico:** Uso de Blade Engines para renderização de componentes e layouts reaproveitáveis.

---

## 🛡️ Visão de Cibersegurança (O meu diferencial)
Como meu objetivo é a área de **Segurança da Informação**, este projeto Laravel é a base ideal porque já me permitiu praticar:
1.  **Proteção CSRF:** Uso mandatório de tokens em todos os formulários (`@csrf`).
2.  **Segurança de URL (Route Model Binding):** Uso de slugs em vez de IDs numéricos expostos, dificultando a enumeração de recursos.
3.  **ORM Eloquent:** Prevenção nativa contra **SQL Injection** através do uso de Prepared Statements.
4.  **Hashing de Senhas:** Armazenamento seguro de credenciais utilizando BCrypt (padrão do framework).

---

## 🚀 Roadmap de Refatoração (Próximos Passos)
Para elevar o nível de segurança deste sistema, pretendo:
- [ ] Implementar **Validação de Request** rigorosa para prevenir ataques de Mass Assignment.
- [ ] Configurar **Rate Limiting** nas rotas de pesquisa para evitar ataques de negação de serviço (DoS) ou scraping excessivo.
- [ ] Adicionar auditoria de logs para ações críticas (como deletar anúncios).

---

## 📂 Como rodar (Requisitos)
* PHP 8.x
* Composer
* MySQL
