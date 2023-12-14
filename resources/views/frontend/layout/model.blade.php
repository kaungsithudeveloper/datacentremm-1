<div class="modal fade" id="signin-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <ul class="nav nav-tabs card-header-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#signin-tab" data-toggle="tab" role="tab"
                            aria-selected="true">
                            <i class="czi-unlocked mr-2 mt-n1"></i>Sign in
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#signup-tab" data-toggle="tab" role="tab" aria-selected="false">
                            <i class="czi-user mr-2 mt-n1"></i>Sign up
                        </a>
                    </li>
                </ul>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body tab-content py-4">
                <form method="POST" action="{{ url('login') }}" id="myForm"
                    class="needs-validation tab-pane fade show active" autocomplete="off" novalidate id="signin-tab">
                    @csrf
                    <div class="form-group">
                        <label for="si-email">Email address</label>
                        <input name="email" class="input100 border-start-1 form-control ms-0" type="email"
                            placeholder="Email" required>
                        <div class="invalid-feedback">
                            Please provide a valid email address.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="si-password">Password</label>
                        <div class="password-toggle">
                            <input name="password" class="input100 border-start-1 form-control ms-0" type="password"
                                placeholder="Password" required>
                            <label class="password-toggle-btn">
                                <input class="custom-control-input" type="checkbox">
                                <i class="czi-eye password-toggle-indicator"></i>
                                <span class="sr-only">Show password</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group d-flex flex-wrap justify-content-between">
                        <div class="custom-control custom-checkbox mb-2">
                            <input class="custom-control-input" type="checkbox" id="si-remember" name="remember">
                            <label class="custom-control-label" for="si-remember">Remember me</label>
                        </div>
                        <a class="font-size-sm" href="#">Forgot password?</a>
                    </div>
                    <button class="btn btn-primary btn-block btn-shadow" type="submit">Sign in</button>
                </form>

                <form class="needs-validation tab-pane fade" autocomplete="off" novalidate id="signup-tab"
                    method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label for="su-name">Full name</label>
                        <input class="form-control" type="text" id="su-name" name="name" placeholder="Username"
                            required>
                        <div class="invalid-feedback">Please fill in your name.</div>
                    </div>
                    <div class="form-group">
                        <label for="su-email">Email address</label>
                        <input class="form-control" type="email" id="su-email" name="email" placeholder="Email"
                            required>
                        <div class="invalid-feedback">Please provide a valid email address.</div>
                    </div>
                    <div class="form-group">
                        <label for="su-password">Password</label>
                        <div class="password-toggle">
                            <input class="form-control" type="password" id="su-password" name="password" required>
                            <label class="password-toggle-btn">
                                <input class="custom-control-input" type="checkbox">
                                <i class="czi-eye password-toggle-indicator"></i>
                                <span class="sr-only">Show password</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="su-password-confirm">Confirm password</label>
                        <div class="password-toggle">
                            <input class="form-control" type="password" id="su-password-confirm"
                                name="password_confirmation" required>
                            <label class="password-toggle-btn">
                                <input class="custom-control-input" type="checkbox">
                                <i class="czi-eye password-toggle-indicator"></i>
                                <span class="sr-only">Show password</span>
                            </label>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block btn-shadow" type="submit" name="login">
                        Sign up</button>
                </form>
            </div>
        </div>
    </div>
</div>
