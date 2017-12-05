<h1>API Portal de Servicios del Estado 1.0</h1>
<hr>
<p>La API del Portal de Servicios del Estado es la interfaz para programadores que permite integrar los contenidos de este portal en tu sitio web.</p>
<h2>Autorización</h2>
<p>Para hacer llamadas a esta API se requerirá un código de acceso (access_token) que se enviará como parámetro en cada request. <a href="https://www.chileatiende.gob.cl/desarrolladores/access_token">Puedes solicitar tu código de acceso haciendo click aquí.</a></p>
<h3>Llamadas a la API</h3>
<pre>GET https://www.chileatiende.gob.cl/api/fichas/{fichaId}</pre>
<h3>Parámetros comunes</h3>
<p>Los diferentes métodos de esta interfaz de programación requieren distintos atributos como parte de la URL, como parámetros de la consulta. Adicionalmente hay parámetros que son comunes para todos los métodos. Todos éstos son pasados como parámetros de la consulta opcionales</p>
<table class="table table-bordered">
    <tbody>
        <tr>
            <th>Nombre del parámetro</th>
            <th>Valor</th>
            <th>Descripción</th>
        </tr>
        <tr>
            <td>access_token</td>
            <td>string</td>
            <td>Token para acceder a los métodos de esta API. Se debe solicitar.</td>
        </tr>
        <tr>
            <td>type</td>
            <td>string</td>
            <td>Formato en que se desean obtener los datos. Puede ser json o xml. Por defecto se utiliza json.</td>
        </tr>
        <tr>
            <td>callback</td>
            <td>string</td>
            <td>Especifica la función JavaScript que será pasada como respuesta para usar la API con <a target="_blank" href="http://en.wikipedia.org/wiki/JSONP">JSONP</a></td>
        </tr>
    </tbody>
</table>
<h3>Formatos de los datos</h3>
<p>Los recursos de la API de este portal vienen en formato json. Este es un ejemplo de cómo se vería una ficha.</p>
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