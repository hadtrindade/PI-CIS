# PI-CIS
Projeto integrador Central Inteligente de Suporte - Asterisk/OpenLDAP/GLPI/Distance Matrix API, Text-to-Speech(Google Cloud Platform)
## Objetivos:
Criar uma central telefônica integrada aos sistemas da empresa, capaz de realizar abertura de chamados no GLPI, atribuir chamado,tranferir a ligação do cliente para o técnico em campo mais próximo e gerenciar escala de técnicos sobreaviso.
## Gerando Ambiente:
1. [Compilando Asterisk, instalando dependências, OpenLDAP e importação do schema do asterisk](https://github.com/hadtrindade/PI-CIS/blob/master/cria%C3%A7%C3%A3o_do_ambiente/Instala%C3%A7%C3%A3o_do_Asterisk)
1. [Criando Container LXC](https://github.com/hadtrindade/PI-CIS/blob/master/cria%C3%A7%C3%A3o_do_ambiente/Cria%C3%A7%C3%A3o%20do%20ambiente)
1. [Instalando GLPI](https://github.com/hadtrindade/PI-CIS/blob/master/cria%C3%A7%C3%A3o_do_ambiente/Instala%C3%A7%C3%A3o%20e%20configura%C3%A7%C3%A3o%20glpi%20no%20ambiente%20gerado)
## Arquivos de configuração:
1. Copiar arquivos de configuração de asterisk para [/etc/asterisk](https://github.com/hadtrindade/PI-CIS/tree/master/asterisk)
1. `cp asterisk/* /etc/asterisk/`
1. Copiar arquivos das AGIs de asterisk_agi-bin para [/var/lib/asterisk/agi-bin/](https://github.com/hadtrindade/PI-CIS/tree/master/asterisk_agi-bin)
1. `cp asterisk_agi-bin/* /var/lib/asterisk/agi-bin/`


teste.