<div>
  <h1>Homeview de usuarios</h1>
  <p>
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nobis expedita, quibusdam distinctio dolor soluta placeat ipsum nesciunt consectetur tenetur harum iste. Expedita ab itaque amet animi qui accusantium totam distinctio?
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, voluptatum itaque, asperiores minima iusto, odit quam omnis commodi nihil similique quidem obcaecati culpa? Rem nisi, perferendis omnis doloribus voluptatem quod.
  </p>
  <p>
    <!--Agregamos enlace para agregar un nuevo usuario-->
    <a href="http://localhost/php-appweb/?c=UserController&m=CallFormAdd">Agregar nuevo usuario</a>
  </p>
  <br>
  <table border=1>
    <thead>
      <tr><td>Nombre</td>
      <td>email</td>
      <td>usuario</td>
      <td>puesto</td>
      <td>Acciones</td>
      </tr>
    </thead>
    <tbody>
      <?php
       foreach($datos as $dato){
        echo "<tr>";
        echo "<td>".$dato['nombre']."</td>";
        echo "<td>".$dato['email']."</td>";
        echo "<td>".$dato['usuario']."</td>";
        echo "<td>".$dato['puesto']."</td>";
        echo "<td> <button onclick='editar(".$dato['idUsuarios'].")'>Editar</button><br>
        <button onclick='eliminar(".$dato['idUsuarios'].")'>Eliminar</button> </td>";
        echo "</tr>";
       }
      ?>
    </tbody>
  </table>

  <script>
    //creamos la funcion para eliminar un usuario por medio de su id y confirmamos si se desea eliminar
    function eliminar(id){
      if(confirm("¿Desea eliminar el usuario?")){
        window.location.href="http://localhost/php-appweb/?c=UserController&m=Delete&id="+id;
        
      }
    }
    //creamos la funcion para editar un usuario por medio de su id
    function editar(id){
      window.location.href="http://localhost/php-appweb/?c=UserController&m=CallFormEdit&id="+id;
    }
  </script>
</div>