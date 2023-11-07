### Linguagem SQL

# Linguagem de definição de dados (DDL, Data Definition Language):

Conjunto de instruções SQL pra definição dos dados e sua estrutura.

-  CREATE - Cria banco de dados, tabelas e colunas.
-   DROP - Exclui o banco de dados, tabelas e colunas.
-   ALTER - Altera banco de dados, tabelas e colunas.
-   TRUNCATE - Esvazia toda a tabela.

# Linguagem de manipulação dos Dados (DML, Data Manipulation Language):

Conjunto de instruções SQL para inserção e manutenção dos dados.

-   INSERT - Insere dados en una tabela.
-   UPDATE - Atualiza os dados existentes em uma tabela.
-   DELETE - Exclui registros de uma tabela.

# Linguagem de Consulta a Dados (DQL, Data Query Language)

-   SELECT - Principal instrução de consulta do SQL
-   SHOW - Exibe todas as informações além dos dados (metadata).
-   HELP - Exibe informações do manual de referência do MySQL.

# Linguagem de controle de Dados (DCL, Data Control Language)

-   GRANT - Essa instrução concede privilégios às contas do usuário.
-   REVOKE - Essa instrução permite revogar os privilégios da conta de usuário.

# Linguagem de transação dos Dados (DTL, Data Transaction Language)

-   START TRANSACTION - Inicia una nova transação.
-   SAVEPOINT - Identifica un determinado ponto em uma transação.
-   COMMIT - É uma instrução de entrega ao SGBD, fazendo com que todas as alterações sejam permanentes.
-   ROLLBACK [TO SAVEPOINT] - É uma instrução ao SGBD para reverter toda a transação, cancelando todas as alterações ou até determinado ponto da transação. 
-   RELEASE SAVEPOINT - Instrução para remoção de um SAVEPOINT.

### -------------------------------------------------------------------------------------------------------------

# USE banco (Seleciona um banco de dados).
# SHOW COLUMNS FROM cidade. (Para monstrar uma tabela contendo os nomes dos campos e suas propriedades).
# SELECT DISTINCT nome FROM cidade (Seleciona os elementos "nome" distintos, sem duplicidade).
# SELECT ALL nome FROM cidade (Seleciona os elementos "nome" incluindo duplicados).
# SELECT * FROM cidade (Seleciona todos os campos da tabela cidade).

# Expresões arimeticas:
# SELECT nome, populacao/2 FROM cidade (Exibira una tabela com os campos nome e populacao dividido por dois).

# Clausula WHERE:
# SELECT nome, populacao FROM cidade WHERE populacao<100000; (Seleciona os campos nome e populacao, onde a populacao seja menor a 100000).

# Conectivos AND, OR, NOT:
# SELECT nome, populacao FROM cidade WHERE populacao BETWEEN 9000 AND 10000; (Seleciona os valores de populacao entre 9000 e 10000).
ou:
# SELECT nome, populacao FROM cidade WHERE populacao>=9000 AND populacao<=10000;
O contrario:
# SELECT nome, populacao FROM cidade WHERE populacao NOT BETWEEN 6000 AND 70000; (Seleciona os valores que no estejam entre 6000 e 7000).

### -------------------------------------------------------------------------------------------------------------

# Estrutura com pontos "." onde se organizam nome-tabela.nome-campo:
Se utiliza para evitar ambiguidades, onde temos alguns campos com nomes iguais em tabelas distintas.

Exemplo:
- Encontre todos os nomes e população das cidades e dos paises que falem portugues.
# SELECT cidade.nome, cidade.populacao, linguapais.linguagem FROM cidade, pais, linguapais WHERE cidade.codigopais = pais.codigo AND pais.codigo = linguapais.codigopais AND linguapais.linguagem = "portugues";

### -------------------------------------------------------------------------------------------------------------


# Clausula AS para renomear os campos, podera ser utilizada na clausula SELECT e FROM:
Ex: nome-antigo AS nome-novo
# SELECT nome, populacao AS populacaoDaCidade FROM cidade; 
(Teremos como resultado uma tabela com o campo Populacao sendo renomeado para PopulacaoDaCidade.)

# Tabem podemos utilizar o AS para definição de variaveis de registro:
Ex: Encontre todos os nomes e população das cidades e linguas do seu pais.

# SELECT C.nome, C.populacao, L.linguagem FROM cidade AS C, pais AS P, linguapais AS L WHERE C.codigopais = P.codigo AND P.codigo = L.codigopais;


### -------------------------------------------------------------------------------------------------------------

# Operações de String e Ordenação utilizando LIKE:
-   Sor% - Localizara qualquer string iniciando com "Sor".
-   %or% - Localizara qualquer string iniciando contendo "or".
-   '_' - Localizara qualquer string com exatamente tres.
-   '_%' - Localizara qualquer string con pelo menos tres.

Exemplo:
- Encontre os nomes de todas as cidades na tabela cidade com nomes iniciados por "Sor", com a sintaxe:
# SELECT nome FROM cidade WHERE nome LIKE 'Sor%';

### -------------------------------------------------------------------------------------------------------------

# Clausula ORDER BY:
Exemplo:
- Encontre os nomes de todas as cidades na tabela cidade, ordenadas por nome:
# SELECT nome FROM cidade ORDER BY nome; (Ordena de forma crescente por padrão).

Pode se especificar o ordem mediante ASC e DESC:

# SELECT nome FROM cidade ORDER BY nome DESC;

### -------------------------------------------------------------------------------------------------------------

# Conjuntos de caracteres CHARSET e agrupamentos COLLATION:

- A cláusula CHARSET, como o próprio nome indica, designa um conjunto de símbolos e codificações e como eles são representados binariamente.

- Já a cláusula COLLATION é o conjunto de regras para comparação de caracteres em um conjunto de caracteres.

# SHOW CHARACTER SET:
- Para verificar quais conjuntos de caracteres estão instalados no seu MySQL, utilize a instrução.

# “utf8_general_ci”

- As siglas _CI (Case Insensitive) - Realizada uma pesquisa de uma palavra seja como for escrita se em maiuscula ou minuscula, vai retornar todas as coincidencias da palavra sem tomar em conta se esta em maiuscula ou minuscula.

- Em contrapartida o _CS (Case Sensitive) - Realiza uma pesquisa exacta como seja que foi escrita a palavra a buscar.

# Obter os padrões de pesquisa para latin1:
- “SHOW COLLATION WHERE Charset = 'latin1';

# Instrução para alteração:
- ALTER DATABASE mundo CHARSET = latin1 COLLATE = latin1_swedish_ci;

### -------------------------------------------------------------------------------------------------------------

# Criar DATA BASE

- Para criarmos um banco de dados chamado “mundo”, com o CHARSET UTF-8 e COLLATION “utf8_general_ci”, a instrução será a seguinte:

# CREATE DATABASE IF NOT EXISTS mundo DEFAULT CHARSET = utf8 DEFAULT COLLATE = utf8_general_ci;


# Ver DATA BASE criada:

 - SHOW DATABASES

### -------------------------------------------------------------------------------------------------------------
 

# ALTER TABLE
- Modificar uma base de dados.

# ADD
- Adicionar novas columnas na tabela

# DROP
- Remover colunas inexistentes
DROP nome_coluna

# FIRST ou AFTER
- Posicionar uma coluna

# Exemplos:
- ALTER TABLE pessoas ADD nome VARCHAR(50);
Adiciona o campo nome.

- ALTER TABLE pessoas DROP COLUMN sobrenome;
Excluye co campo sobrenome

# CHANGE: pode renomear uma coluna e alterar sua definição ou ambos. 
- Exemplo: ALTER TABLE pessoas CHANGE antigo novo BIGINT NOT NULL;

# RENAME COLUMN: pode alterar o nome de uma coluna, mas não sua definição.

