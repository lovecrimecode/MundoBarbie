<?php
require 'library/template/template.php';
Template::applyTemplate();

$character = new Character();
?>

<div class='container'>
    <h1 class='text-border'>Registro de Personajes</h1>
    <h3>Por favor ingrese los datos del personaje</h3>

    <form action="save.php" method="POST">
        <input type="hidden" name="id" value="<?= $character->id ?? '' ?>">

        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" required value="<?= $character->name ?? '' ?>" placeholder="Nombre del personaje" />

        <label for="birthday">Fecha de nacimiento:</label>
        <input type="date" name="birthday" id="birthday" required value="<?= $character->birthday ?? '' ?>" placeholder="Fecha de nacimiento del personaje" />

        <label for="profession">Profesion:</label>
        <input type="text" name="profession" id="profession" required value="<?= $character->profession ?? '' ?>" placeholder="Profesion del personaje" />

        <br>
        <button type="sumbit" class="button">Guardar personaje</button>