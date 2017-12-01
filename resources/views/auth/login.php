<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <section class="login-container">
                <div class="login-logo">
                    <img src="images/logo.svg" alt="ChileAtiende" class="img-responsive" />
                </div>
                <div class="login-box">
                    <form class="form-horizontal" method="POST" action="<?= route('login') ?>">
                        <?= csrf_field() ?>
                        <div class="form-group<?= $errors->has('email') ? ' has-error' : '' ?>">
                            <label for="email" class="col-md-12 control-label">correo electrónico</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="<?= old('email') ?>" required autofocus>

                                <?php if ($errors->has('email')):?>
                                    <span class="help-block">
                                        <strong><?= $errors->first('email') ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group<?= $errors->has('password') ? ' has-error' : '' ?>">
                            <label for="password" class="col-md-12 control-label">contraseña</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" required>

                                <?php if ($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?= $errors->first('password') ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 text-left">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" <?= old('remember') ? 'checked' : '' ?>> Recuérdame
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="login-button">
                                    Ingresar
                                </button>
                            </div>
                            <div class="col-md-12">
                                <a class="link-forgot" href="<?= route('password.request') ?>">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>

