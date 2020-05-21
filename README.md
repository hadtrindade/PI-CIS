# CIS
Para conclusão do Seminário de Orientação de Projeto Integrador, surgiu o projeto da CIS - Central Inteligente de Suporte, utilizando tudo o que foi aprendido em semestres anteriores.
Na CIS foram utilizadas as seguintes ténologias:

* Asterisk
* OpenLDAP
* GLPI
* APIS do google: Distance Matrix, Text-to-Speech

## Objetivos:

* Criar uma central telefônica integrada aos sistemas da empresa, capaz de realizar abertura de tickets no GLPI, encaminhar e atribuir chamada e ticket para o técnico mais próximo do cliente ou para a fila de atendimento ao usuário.
* Gerenciar atendimento na escala de plantão.

## Arquivos de configuração do Asterisk:
1. Copiar arquivos de configuração de asterisk para [/etc/asterisk](https://github.com/hadtrindade/PI-CIS/tree/master/Asterisk)
1. `cp Asterisk/* /etc/asterisk/`
## Aplicação CIS
1. Copiar Classes para [/cis](https://github.com/hadtrindade/PI-CIS/tree/master/asterisk_agi-bin)
1. `cp App/* /cis/`
