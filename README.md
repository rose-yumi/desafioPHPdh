Desafio PHP Estruturado

1 *) Criar uma tela ( createProduto.php ) com um formulário a partir do
qual o usuário poderá cadastrar produtos. Precisaremos dos
seguintes campos:
● nome do produto
● descrição do produto
● preço
● foto (upload)
Deve-se validar os campos do lado do servidor e, eventualmente,
destacar os campos preenchidos i ncorretamente segundo os
critérios:
● O preço deve ser numérico.
● O nome do produto e a foto são obrigatórios.
A descrição é opcional. Salvar os produtos num arquivo
produtos.json. Cada produto deve ter um número i nteiro único como
identificador.

2 *) Criar uma tela (i ndexProdutos.php) que deve mostrar uma tabela
com todas as i nformações de todos os produtos exceto a foto. A
última coluna dessa tabela deve ser um link para a tela descrita na
tela abaixo.

3 *) Criar uma tela ( showProduto.php ) com as informações de um
produto. Essa tela deve permitir a exclusão do produto.

4 **) Fazer uma tela (e ditProduto.php) que permita a alterção das
informações de um produto.

5 *) Criar uma tela (c reateUsuario.php) de cadastro de usuários com
campos nome, e-mail, senha e confirmação de senha. Guardar
usuários num arquivo usuarios.json. Os campos devem ser validados
seguindo os seguintes critérios:
● O nome e o email são de preenchimentos obrigatórios.
● A senha deve ter no mínimo 6 caracteres.
● A senha e a confirmação de senha devem ser iguais.
A senha de cada usuário deve ser armazenada criptografada. A tela
de cadastro dos usuários também deve conter uma lista com todos
os usuários.
Ao lado de cada usuário acrescente um botão que, quando clicado,
deve remover o usuário.

6 **) Cada i tem da lista de usuários (item 5) deve conter um link que
direciona para uma tela que será capaz de alterar as i nformações de
um usuário.

7 *) Fazer uma tela de login para os usuários.

8 *) Fazer com que o acesso às telas construídas nos items 1, 2, 3, 4, 5
e 6. Sejam acessíveis somente a usuários logados.

9) Excetuando a tela de login, todas as telas devem exibir uma barra
de navegação para que o usuário possa alternar entre telas e,
eventualmente efetuar o logout.