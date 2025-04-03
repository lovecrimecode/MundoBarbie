<?php
require 'library/template/template.php';
require 'library/components.php';
Template::applyTemplate();
?>

<h1 class="text-border">Bienvenidx al mundo Barbie</h1>
<h2 class="text-border">En donde puedes ser lo que quieras ser!</h2>

<a href="register.php" class="button">Registrar personaje</a>

<h3>Personajes del mundo Barbie:</h3>

<table>
     <thead>
          <tr>
               <th>ID</th>
               <th>Nombre</th>
               <th>Fecha de Nacimiento</th>
               <th>Profesion</th>
               <th>Acciones</th>
          </tr>
     </thead>
     <tbody>
          <?php
          $data = listCharacters();
          if (empty($data)) {
               echo "<tr><td colspan='5'>No hay personajes registrados.</td></tr>";
          } else {
               foreach ($data as $character) {
                    echo "<tr>";
                    echo "<td>" . $character['id'] . "</td>";
                    echo "<td>" . $character['name'] . "</td>";
                    echo "<td>" . $character['birthday'] . "</td>";
                    echo "<td>" . $character['profession'] . "</td>";
                    echo "<td><a href='register.php?id=" . $character['id'] . "' class='button'>Editar</a></td>";
                    echo "</tr>";
               }
          }
          ?>
     </tbody>
</table>