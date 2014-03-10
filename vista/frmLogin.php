<div class="contenedorPrincipal">
    <div id="bordeRedondeado">
      <form action="">
          <div class="form-group">
            <label class="sr-only" for="txtUser">Usuario</label>
            <input type="user" class="form-control" id="txtUser" autofocus placeholder="usuario" required>
          </div>
          <div class="form-group">
            <label class="sr-only" for="txtPass">Contraseña</label>
            <input type="password" class="form-control" id="txtPass" placeholder="Contraseña" required>
          </div>
          <button type="submit" class="btn btn-default" onclick="loguearUsuario();" onkeypress="loguearUsuario();">Ingresar</button>
      </form>
<!--
        <form accept-charset="UTF-8">
            <label>Usuario:</label> 
            <input name="txtUsuario" type="text" autofocus placeholder="Usuario" required>
            <label>Clave:</label>
            <input name="txtClave" type="clave" placeholder="Contraseña" required>
            <input name="btnGuardar" type="submit" value="Ingresar">
        </form>
-->
    </div>
</div>