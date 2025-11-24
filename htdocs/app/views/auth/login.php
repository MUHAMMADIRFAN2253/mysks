<div class="container d-flex justify-content-center align-items-center flex-column" style="min-height: 105vh;">
    <div class="card shadow-lg" style="width: 400px;">
        <div class="card-header bg-gradient-info text-white text-center">
            <h4>
                <i class="fas fa-university me-2"></i> My SKS: Sistem Kuliah Santai
            </h4>
        </div>
        <div class="card-body">
            
            <?php
            if (isset($_SESSION['login_error'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_SESSION['login_error']; ?>
                </div>
            <?php
                unset($_SESSION['login_error']);
            endif;
            ?>

            <form action="<?= BASEURL; ?>/auth/login" method="POST">
                <div class="form-group mb-3">
                    <label for="nim">NIP / NIM</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIP atau NIM Anda" required autocomplete="username">
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Kata Sandi Anda" required autocomplete="current-password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">
                            Remember Me
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-info btn-block w-100 mb-3">
                    <i class="fas fa-sign-in-alt me-1"></i> Login
                </button>
            </form>
            <div class="text-center">
                <a class="small text-info" href="forgot-password.html">Forgot Password?</a>
            </div>
            <div class="text-center">
                <a class="small text-info" href="register.html">Create an Account!</a>
            </div>
        </div>
    </div>
    <p class="text-white mt-3 text-center">admin: admin123</p>
    <p class="text-white text-center">password: admin123</p>
</div>
