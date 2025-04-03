<?php

// Definición de el folder "data/" en donde iran los personajes como "DATA_FOLDER"
define("DATA_FOLDER", "data/");

// Función para guardar un personaje en el folder de datos
function storeCharacter($id, $data)
{
    if (!is_dir(DATA_FOLDER)) {
        mkdir(DATA_FOLDER, 0777, true);
    }

    $file = DATA_FOLDER . "{$id}.json"; // Archivo json con los datos del personaje segun id
    return file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT)) !== false;
}

function updateCharacter($id, $data)
{
    $file = DATA_FOLDER . "{$id}.json";
    if (file_exists($file)) {
        return file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT)) !== false;
    } else {
        return false;
    }
}

// Función para listar los personajes en el folder de datos
function listCharacters()
{
     $files = scandir(DATA_FOLDER);
     $files = array_diff($files, ['.', '..']);

     if (empty($files)) {
          return null;
     }

     $characters = [];
     foreach ($files as $file) {
          $filePath = DATA_FOLDER . $file;

          if (!is_file($filePath) || pathinfo($file, PATHINFO_EXTENSION) !== 'json') {
               continue;
          }

          $content = file_get_contents($filePath);
          if ($content === false) {
               continue; 
          }

          $data = json_decode($content, true);
          if (json_last_error() !== JSON_ERROR_NONE) {
               continue;
          }

          $characters[] = $data;
     }

     return empty($characters) ? null : $characters;
}

function deleteCharacter($id)
{
     $file = DATA_FOLDER . "{$id}.json";
     if (file_exists($file)) {
          if (!unlink($file)) {
               throw new RuntimeException("Error al eliminar el archivo de personaje.");
          }
          return true;
     } else {
          return false;
     }
}