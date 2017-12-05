<h1>Servicios: listar</h1>
<p>Lista todos los servicios (instituciones) que publican en este portal.</p>
<h3>Request HTTP</h3>
<pre>GET https://www.chileatiende.gob.cl/api/servicios</pre>
<h3>Response HTTP</h3>
<p>Si el request es correcto, se devuelve la siguiente estructura.</p>
<pre>
{
    "fichas":{
        "titulo":"Listado de Servicios",
        "tipo":"chileatiende#serviciosFeed",
        "items": [
            recurso servicio
        ]
    }
}
</pre>
<table class="table table-bordered">
    <tbody>
        <tr>
            <th>Nombre del parámetro</th>
            <th>Valor</th>
            <th>Descripción</th>
        </tr>
        <tr>
            <td>titulo</td>
            <td>string</td>
            <td>El título de este listado de fichas.</td>
        </tr>
        <tr>
            <td>tipo</td>
            <td>string</td>
            <td>Identifica el nombre de este recurso.</td>
        </tr>
        <tr>
            <td>items</td>
            <td>list</td>
            <td>El listado de servicios.</td>
        </tr>
    </tbody>
</table>