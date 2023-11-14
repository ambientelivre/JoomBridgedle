# plugin Joombridgedle 
este plugin foi desenvolvido para receber a quantidades de alunos em um curso do moodle
## como instalar
1 baixe o zip no git , no botão <>CODE
2 como admistrador no joomla va em extensions , install , upload package files e selecione o arquivo zip
apos isso va em extensions , menage e habilite o plugin

## configuraçoes
va em extensions , plugins , e clique no nome do plugin para abrir as configurações
insira a url , use esta url como base : http://url/do/seu/site/exemplo.php/?wsfunction="coloque o servico externo"&wstoken="seu token"&wsfunction=core_enrol_get_enrolled_users&moodlewsrestformat=json&courseid="id do seu curso"
o shortcode é exatamente igual ao que você colocar, é recomendado colocá-lo entre {} para evitar ativações involuntárias

