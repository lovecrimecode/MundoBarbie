<?php
ob_start();
require 'library/template/template.php';
require 'library/components.php';
Template::applyTemplate();

if (isset($_GET['delete'])) {
     $id = $_GET['delete'];
     $file = DATA_FOLDER . "{$id}.json";
     if (file_exists($file)) {
          if (unlink($file)) {
               ob_end_clean();
               header("Location: index.php?deleteSuccess=1");
          } else {
               ob_end_clean();
               header("Location: index.php?error=1");
          }
     } else {
          ob_end_clean();
          header("Location: index.php?error=2");
     }
     exit;
}
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
                    echo "<td>
                              <a href='register.php?id=" . $character['id'] . "' class='button'>Editar</a>
                              <a href='index.php?delete=" . $character['id'] . "' class='button'>Eliminar</a>
                          </td>";
                    echo "</tr>";
               }
          }
          ?>
     </tbody>
</table>

<?php if (isset($_GET['deleteSuccess'])): ?>
     <script>
          alert("Personaje eliminado correctamente!");
     </script>
<?php elseif (isset($_GET['error'])): ?>
     <script>
          alert("Error al eliminar el personaje. Por favor intente de nuevo.");
     </script>
<?php endif; ?>