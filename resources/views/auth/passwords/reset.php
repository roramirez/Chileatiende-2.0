<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <section class="login-container">
                <div class="login-logo">
                    <img src="images/logo.svg" alt="ChileAtiende" class="img-responsive" />
                </div>
                <div class="login-box">
                    <div class="panel-heading">Reestablecer Contraseña</div>

                    <form class="form-horizontal" method="POST" action="<?= route('password.request') ?>">
                        <?= csrf_field() ?>

                        <input type="hidden" name="token" value="<?= $token ?>">

                        <div class="form-group<?= $errors->has('email') ? ' has-error' : '' ?>">
                            <label for="email" class="col-md-12 control-label">Correo electrónico</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="<?= $email or old('email') ?>" required autofocus>

                                <?php if ($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?= $errors->first('email') ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="form-group<?= $errors->has('password') ? ' has-error' : '' ?>">
                            <label for="password" class="col-md-12 control-label">Contraseña</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" required>

                                <?php if ($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?= $errors->first('password') ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="form-group<?= $errors->has('password_confirmation') ? ' has-error' : '' ?>">
                            <label for="password-confirm" class="col-md-12 control-label">Confirmar Contraseña</label>
                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                <?php if ($errors->has('password_confirmation')): ?>
                                    <span class="help-block">
                                        <strong><?= $errors->first('password_confirmation') ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="login-button">
                                    Reestablecer Contraseña
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>


        </div>
    </div>
</div>
