# loc-garden
# LocGarden — Locação de Equipamentos para Jardinagem 🌿

## 🌱 1. Nome e Objetivo do Projeto
**Nome:** LocGarden  
**Objetivo:** Desenvolver uma plataforma web moderna, responsiva e funcional para a locação de máquinas e ferramentas de jardinagem e paisagismo. O sistema permite que clientes explorem o catálogo por categorias, visualizem equipamentos em destaque, realizem cadastro/login e solicitem agendamentos de locação diretamente pelo site com armazenamento em banco de dados.

---

## 🌻 2. Integrantes do Grupo
- **Emanuele Pereira Pauli**
  
---

## 🛠️ 3. Tecnologias Utilizadas
- **Front-end:** HTML5, CSS3 (Flexbox, CSS Grid e Design Responsivo) e Google Fonts (`Plus Jakarta Sans` e `Bebas Neue`).
- **Back-end:** PHP 8+.
- **Banco de Dados:** MySQL.
- **Prototipação e Design:** Figma.

---

## ✨ 4. Principais Funcionalidades
- 🚜 **Vitrine Principal (Hero):** Apresentação em destaque de equipamentos com chamadas diretas para locação e informações.
- 🌿 **Navegação por Categorias:** Organização visual das áreas de atuação (*Corte e Acabamento*, *Poda e Manejo*, *Limpeza*, *Manutenção do Solo*, *Tratamento* e *Outros*).
- 🌾 **Catálogo de Destaques e Atendimento Rápido:** Exibição dos principais equipamentos (*Giro Zero*, *Carrinho de Cortar Grama* e *Roçadeira*) com botão de contato direto via **WhatsApp** com mensagem personalizada
- 📅 **Agendamento Online (`salvar_contato.php`):** Formulário interativo onde o cliente escolhe o equipamento desejado, informa seus dados e registra a solicitação diretamente no banco de dados MySQL.
- 🔐 **Área do Cliente (`login.html` e `auth.php`):** Tela dedicada para cadastro de novos usuários (com criptografia de senha via `password_hash`) e autenticação de clientes cadastrados.

---

## 📋 5. Requisitos e Dependências Necessários
- Navegador web atualizado (Google Chrome, Microsoft Edge, Firefox, etc.).
- Ambiente de servidor local com suporte a **Apache**, **PHP 8.0 ou superior** e **MySQL / phpMyAdmin** (como **XAMPP**, **WAMP** ou **Laragon**).
- Conexão com a internet para o carregamento das fontes externas via Google Fonts.

---

## ⚙️ 6. Instruções para Instalação, Configuração e Execução

1. **Obtenha os arquivos do projeto:**
   ```bash
   git clone [https://github.com/emanuelipereira12-dev/loc-garden.git](https://github.com/emanuelipereira12-dev/loc-garden.git)
