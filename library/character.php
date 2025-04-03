<?php

class Character
{
     public $id;
     public $name;
     public $birthday;
     public $profession;

     public function generateCharacterId()
     {
          //obtiene todos los archivos JSON en la carpeta de datos
          $files = glob('data/*.json');
          $max_id = 0;

          foreach ($files as $file) {
               //decodifica el archivo json 
               $content = json_decode(file_get_contents($file), true);

               /* si en el contenido del json, el atributo 'id' existe y es mayor
               al valor de 'maxId' asigna el valor de 'id' a 'maxId' */
               if (isset($content['id']) && $content['id'] > $max_id) {
                    $max_id = $content['id'];
               }
          }

          return $max_id + 1; //retorna el siguiente id disponible
     }
}
