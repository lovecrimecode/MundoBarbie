<?php
require 'library/template/template.php';
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
               <th>Edad</th>
               <th>Profesion</th>
               <th>Acciones</th>
          </tr>
     </thead>
     <tbody>
          <?php
          // lista de personajes
          

          // Boton para editar
          ?>
          <a href="register.php?id=" <?= $character->id ?>" class="button">Editar</a>
     </tbody>
</table>



<?php
function listCharacters()
{
     $characters = [];
     foreach (scandir(DATA_FOLDER) as $file) {

          $filePath = DATA_FOLDER . $file;
          if (!is_file($filePath)) continue;

          $id = pathinfo($file, PATHINFO_FILENAME); //obtiene solo el nombre sin ".json"
          $characters[] = getCharacter($id);
     }
     return $characters;
}