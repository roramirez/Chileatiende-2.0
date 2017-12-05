<h1>Servicios: obtener</h1>
<p>Obtiene un servicio.</p>
<h3>Request HTTP</h3>
<pre>
GET https://www.chileatiende.gob.cl/api/servicios/{servicioId}
</pre>
<h3>Parámetros</h3>
<table class="table table-bordered">
    <tbody>
        <tr>
            <th>Nombre del parámetro</th>
            <th>Valor</th>
            <th>Descripción</th>
        </tr>
        <tr>
            <td colspan="3">Parámetros requeridos</td>
        </tr>
        <tr>
            <td>servicioId</td>
            <td>string</td>
            <td>Identificador único de un servicio del Estado.</td>
        </tr>
    </tbody>
</table>
<h3>Response HTTP</h3>
<p>Si el request es correcto, se devuelve un <a href="/desarrolladores/servicios">recurso servicio.</a></p>