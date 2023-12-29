<?php $this->layout('master')?>
    <div class="column"></div>
<div class="columns is-mobile is-centered">
    <div class="column is-narrow is-two-fifths">
        <div class="card">
            <div class="card-content ">
                <h2 class="is-size-2 has-text-centered">Cadastro</h2>
                <form action="/user" method="post" class="form-cadastro">
                    <div class="field">
                        <label class="label">Nome</label>
                        <div class="control">
                            <input type="text" class="input" name="name" placeholder="digite o seu nome">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Email</label>
                        <div class="control">
                            <input type="text" class="input" name="email" placeholder="digite o seu email">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Senha</label>
                        <div class="control">
                            <input type="password" class="input name="password" placeholder="digite o sua senha">
                        </div>
                    </div>
                    <div class="field">
                        <div class="control has-text-centered">
                            <button type="submit" class="button is-black is-outlined">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
