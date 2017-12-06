<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <section class="login-container">
                <div class="login-logo">
                    <img src="images/logo.svg" alt="ChileAtiende" class="img-responsive" />
                </div>
                <div class="login-box">
                    <div>Reestablecer Contraseña</div>

                    <?php if (session('status')):?>
                        <div class="alert alert-success">
                            <?= session('status') ?>
                        </div>
                    <?php endif ?>

                    <form class="form-horizontal" method="POST" action="<?= route('password.email') ?>">
                        <?= csrf_field() ?>

                        <div class="form-group<?= $errors->has('email') ? ' has-error' : '' ?>">
                            <label for="email" class="col-md-12 control-label">Correo electrónico</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="<?= old('email') ?>" required>

                                <?php if ($errors->has('email')):?>
                                    <span class="help-block">
                                        <strong><?= $errors->first('email') ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="login-button">
                                    Enviar Link de Reestablecimiento de Contraseña
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
