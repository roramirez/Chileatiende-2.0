<h1>Fichas</h1>
<p>Fichas es un listado de fichas de este portal. Los métodos permiten obtener una ficha, listar una serie de fichas o listar fichas pertenecientes a un servicio en particular.</p>
<h3>Métodos</h3>
<ul>
    <li><a href="https://www.chileatiende.gob.cl/desarrolladores/fichas_obtener">Obtener</a>: Obtiene una ficha</li>
    <li>Listar: Lista todas las fichas</li>
    <li>listarPorServicio: Lista todas las fichas de un servicio/institución en particular.</li>
</ul>
<h3>Representación del recurso</h3>
<p>Una ficha es representada como una estructura json. Este es un ejemplo de cómo se vería una ficha.</p>
<pre>
{
   "ficha":{
      "id":"1",
      "fecha":"2011-08-18 11:57:16",
      "servicio":"Direcci\u00f3n de Previsi\u00f3n de Carabineros de Chile",
      "titulo":"\u00bfC\u00f3mo solicito a la Direcci\u00f3n de Previsi\u00f3n de Carabineros de Chile (DIPRECA) el Pago Complementario del Reintegro M\u00e9dico?",
      "objetivo":"
Solicitar a la Dirección de Previsión de Carabineros de Chile (DIPRECA) el Pago Complementario del Reintegro Médico o gastos asociados a la atención de salud. El trámite puede realizarse durante todo el año en los horarios definidos por la institución.<\/p>",
      "beneficiarios":"

El personal activo de Carabineros de Chile, DIPRECA, Investigaciones de Chile y Gendarmería de Chile, además, de los pensionados de retiro y los montepiados.<\/p>",
      "costo":"

Ninguno.<\/p>",
      "vigencia":"

Anual.<\/p>",
      "plazo":"

27 días hábiles, aproximadamente.<\/p>",
      "marco_legal":"",
      "temas":{
         "tema":[
            "Salud"
         ]
      },
      "tags":{
         "tag":[
            "DIPRECA",
            "Carabineros"
         ]
      }
   }
}
</pre>