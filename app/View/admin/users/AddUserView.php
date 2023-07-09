<div>
  <h2>Agregar nuevo usuario</h2>
  <!--en el metodo action de este formulario llamaremos al metodo Add de nuestro controlador -->
  <form 
  action="http://localhost/php-appweb/?c=UserController&m=Add" 
  method="post" 
  enctype="multipart/form-data">
    <p>
      <label for="nombre">Nombre : </label><br />
      <input type="text" name="nombre" id="nombre" placeholder="Nombre" />
    </p>
    <p>
      <label for="email">Email : </label><br />
      <input
        type="email"
        name="email"
        id="email"
        placeholder="email"
      />
    </p>
    
    <p>
        <label for="usuario">Usuario : </label><br />
        <input type="text" name="usuario" id="usuario" placeholder="Usuario"/>
    </p>
    <p>
        <label for="password">Password : </label><br>
        <input type="password" name="password" id="password" placeholder="Password"/>
    </p>
    <p>
        <label for="puesto">Puesto : </label><br>
        <select name="puesto" id="puesto">
            <option value="administrador">Administrador</option>
            <option value="usuario">Usuario</option>
        </select>
    </p>
    <p>
      <label for="avatar">Avatar de usuario : </label><br>
      <input type="file" name="avatar" id="avatar" accept="image/*">
    </p>
    <p><input type="submit" value="Add User"></p>
  </form>
</div>