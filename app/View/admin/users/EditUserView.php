<div>
  <h2>Actualizacion de datos de usuario</h2>
  <!--en el metodo action de este formulario llamaremos al metodo Add de nuestro controlador -->
  <form action="http://localhost/php-appweb/?c=UserController&m=Edit" method="post" enctype="multipart/form-data">
    <p>
      <label for="nombre">Nombre : </label><br />
      <input
        type="text"
        name="nombre"
        id="nombre"
        placeholder="Nombre"
        value="<?= $datos['nombre'] ?>"
      />
    </p>
    <p>
      <label for="email">Email : </label><br />
      <input
        type="email"
        name="email"
        id="email"
        placeholder="Apellido Paterno"
        value="<?= $datos['email'] ?>"
      />
    </p>
    
    <p>
      <label for="usuario">Usuario : </label><br />
      <input
        type="text"
        name="usuario"
        id="usuario"
        placeholder="Usuario"
        value="<?= $datos['usuario'] ?>"
      />
    </p>
    <p>
      <label for="password">Password : </label><br />
      <input
        type="password"
        name="password"
        id="password"
        placeholder="Password"
        value="<?= $datos['password'] ?>"
      />
    </p>
    <p>
      <label for="puesto">Puesto : </label><br />
      <select name="puesto" id="puesto">
        <option value="administrador">Administrador</option>
        <option value="usuario">Usuario</option>
      </select>
    </p>
    <p>
      <label for="avatar">Avatar de usuario : </label><br>
      <input type="file" name="avatar" id="avatar" accept="image/*" value="<?=$datos['avatar']?>">
    </p>
    <p>
      <input
        type="hidden"
        name="idUsuarios"
        value="<?= $datos['idUsuarios'] ?>"
        readonly
        id="idUsuarios"
      />
    </p>
    <p><input type="submit" value="Edit" /></p>
  </form>
</div>