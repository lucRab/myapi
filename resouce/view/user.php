<?php $this->layout('master') ?>

<h1>User</h1>

<form action="/teste" method="post">
    <input type="text" name="name" placeholder="digite o seu nome">
    <input type="text" name="email" placeholder="digite o seu email">
    <input type="password" name="password" placeholder="digite o sua senha">
    <button type="submit">Enviar</button>
</form>