# plugin Joombridgedle 
este plugin foi desenvolvido para receber a quantidades de alunos em um curso do moodle
## como instalar
<br> 1 baixe o zip no git , no botão <>CODE <br/>
2 como admistrador no joomla va em extensions , install , upload package files e selecione o arquivo zip
apos isso va em extensions , menage e habilite o plugin

## configuraçoes
<br> va em extensions , plugins , e clique no nome do plugin para abrir as configurações <br/>
insira a url , use esta url como base : http://url/do/seu/site/exemplo.php/?wsfunction="coloque_o_servico_externo"&wstoken="seu_token"&wsfunction=core_enrol_get_enrolled_users&moodlewsrestformat=json&courseid="id_do_seu_curso"
<br> o shortcode é exatamente igual ao que você colocar, é recomendado colocá-lo entre {} para evitar ativações involuntárias <br/>

