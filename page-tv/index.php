<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php
/**
 * Previsão do Tempo em PHP
 * 
 * @author Thiago Belem <contato@thiagobelem.net>
 */

// Localização
$cidade = 'São Paulo'; // Cidade
$estado = 'São Paulo'; // Estado (sem abreviação!)
$pais = 'Brazil'; // País (em inglês)
$idioma = 'pt-br'; // Idioma de resposta (pt-br)

// URL principal da API
$googleWeather = 'http://www.google.com/ig/api';

// Montamos a URL que será chamada
// Usamos a função urlencode() para substituir caracteres especiais
$apiUrl = $googleWeather . '?weather=' . urlencode($cidade) . ',' . urlencode($estado) . ',' . urlencode($pais) . '&hl=' . $idioma;

// Pegamos o resultado da API
$resultado = file_get_contents($apiUrl);

// Usamos o SimpleXML para pegar a resposta
// O SimpleXML precisa receber valores em UTF-8, então usamos o uft8_encode()
$xml = simplexml_load_string(utf8_encode($resultado));

// Separamos as informações encontradas
$info = $xml->xpath('/xml_api_reply/weather/forecast_information');
$atual = $xml->xpath('/xml_api_reply/weather/current_conditions');
$proximos = $xml->xpath('/xml_api_reply/weather/forecast_conditions');

?>

<h3>Previsão Atual</h3>
<p><?php echo $info[0]->city['data']; ?></p>

<table>
	<tr>
		<td><img src="<?php echo $atual[0]->icon['data']; ?>" alt="weather" /></td>
		<td><?php echo $atual[0]->temp_c['data']; ?>&deg; C<br /><?php echo $atual[0]->condition['data']; ?></td>
	</tr>
</table>

< h3>Próximos dias</h3>
<table>
	<?php foreach ($proximos AS $item) { ?>
	<tr>
		<td><?php echo $item->day_of_week['data'];?></td>
		<td><img src="http://www.google.com<?php echo $item->icon['data']; ?>" alt="weather" /></td>
		<td><?php echo $item->low['data']; ?>/<?php echo $item->high['data']; ?>&deg; C<br /><?php echo $item->condition['data']; ?></td>
	</tr>
	<?php } ?>
</table>
