<?php
require 'library/template/template.php';
Template::applyTemplate();

$character = new Character();

// Cargar los datos del personaje si se está editando
if (isset($_GET['id'])) {
    $character->id = $_GET['id'];
    $files = glob('data/*.json');
    foreach ($files as $file) {
        $content = json_decode(file_get_contents($file), true);
        if ($content['id'] == $character->id) {
            $character->name = $content['name'];
            $character->birthday = $content['birthday'];
            $character->profession = $content['profession'];
            break;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $birthday = htmlspecialchars($_POST['birthday']);
    $profession = htmlspecialchars($_POST['profession']);

    if (empty($name) || empty($birthday) || empty($profession)) {
        header("Location: index.php?error=1");
        exit;
    }

    $character->id = $_POST['id'] ?? '';
    $character->name = $name;
    $character->birthday = $birthday;
    $character->profession = $profession;

    // Guardar o editar el personaje
    if (isset($_GET['id'])) {
        if (updateCharacter($character->id, $character)) {
            header("Location: index.php?success=1");
        } else {
            header("Location: index.php?error=2");
        }
    } else {
        if (storeCharacter($character->id, $character)) {
            header("Location: index.php?success=1");
        } else {
            header("Location: index.php?error=2");
        }
    }
    exit;
}

?>

<div class='container'>
    <h1 class='text-border'>Registro de Personajes</h1>
    <h3>Por favor ingrese los datos del personaje</h3>

    <form action="register.php<?= isset($_GET['id']) ? '?id=' . $_GET['id'] : '' ?>" method="POST">
        <input type="hidden" name="id" value="<?= $character->id ?? '' ?>">

        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" required value="<?= $character->name ?? '' ?>" placeholder="Nombre del personaje" />

        <label for="birthday">Fecha de nacimiento:</label>
        <input type="date" name="birthday" id="birthday" required value="<?= $character->birthday ?? '' ?>" placeholder="Fecha de nacimiento del personaje" />

        <label for="profession">Profesion:</label>
        <input type="text" name="profession" id="profession" required value="<?= $character->profession ?? '' ?>" placeholder="Profesion del personaje" />

        <br><button type="submit" class="button">Guardar personaje</button>
    </form>
</div>

<script>
    // Verificar si se ha guardado el personaje correctamente o si hubo un error
    document.addEventListener('DOMContentLoaded', () => {
        const params = new URLSearchParams(window.location.search);

        if (params.has('success')) {
            alert("Personaje guardado correctamente!");
            window.location.href = "index.php";
        } else if (params.has('error')) {
            alert("Error al guardar el personaje. Por favor intente de nuevo.");
        }
    });
</script>

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
