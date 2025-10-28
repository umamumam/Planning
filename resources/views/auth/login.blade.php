<!doctype html>

<html lang="en" class="layout-wide customizer-hide" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="robots" content="noindex, nofollow" />

    <title>MenjadiHalal</title>

    <meta name="description" content="" />

    <link rel="icon" type="image/x-icon" href="{{ asset('materio/assets/img/backgrounds/wed.png') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('materio/assets/vendor/fonts/iconify-icons.css') }}" />

    <link rel="stylesheet" href="{{ asset('materio/assets/vendor/libs/node-waves/node-waves.css') }}" />

    <link rel="stylesheet" href="{{ asset('materio/assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('materio/assets/css/demo.css') }}" />

    <link rel="stylesheet" href="{{ asset('materio/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('materio/assets/vendor/css/pages/page-auth.css') }}" />

    <script src="{{ asset('materio/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('materio/assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Content -->

    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-6 mx-4">
                <!-- Login -->
                <div class="card p-sm-7 p-2">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mt-5">
                        <a href="/" class="app-brand-link gap-3">
                            <span class="app-brand-logo demo">
                                <img src="{{ asset('materio/assets/img/backgrounds/wed.png') }}" alt="My Wedding Logo"
                                    width="50" class="rounded">
                            </span>
                            <span class="app-brand-text demo text-heading fw-semibold">MenjadiHalal</span>
                        </a>
                    </div>

                    <!-- /Logo -->

                    <div class="card-body mt-1">
                        <h4 class="mb-1">Welcome to web!</h4>
                        <p class="mb-5">Please sign-in to your account and start the adventure</p>

                        <form id="formAuthentication" class="mb-5" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-floating form-floating-outline mb-5 form-control-validation">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter your email or username" autofocus />
                                <label for="email">Email or Username</label>
                            </div>
                            <div class="mb-5">
                                <div class="form-password-toggle form-control-validation">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                            <input type="password" id="password" class="form-control" name="password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password" />
                                            <label for="password">Password</label>
                                        </div>
                                        <span class="input-group-text cursor-pointer"><i
                                                class="icon-base ri ri-eye-off-line icon-20px"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-5 pb-2 d-flex justify-content-between pt-2 align-items-center">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="checkbox" id="remember-me" />
                                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                                </div>
                                <a href="auth-forgot-password-basic.html" class="float-end mb-1">
                                    <span>Forgot Password?</span>
                                </a>
                            </div>
                            <div class="mb-5">
                                <button class="btn btn-primary d-grid w-100" type="submit">login</button>
                            </div>
                        </form>

                        <p class="text-center mb-5">
                            <span>New on our platform?</span>
                            <a href="auth-register-basic.html">
                                <span>Create an account</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Login -->
                <img src="{{ asset('materio/assets/img/illustrations/cin1.png') }}" alt="auth-tree"
                    class="authentication-image-object-left d-none d-lg-block" width="200" />
                <img src="{{ asset('materio/assets/img/illustrations/auth-basic-mask-light.png') }}"
                    class="authentication-image d-none d-lg-block scaleX-n1-rtl" height="172" alt="triangle-bg" />
                <img src="{{ asset('materio/assets/img/illustrations/btt.png') }}" alt="auth-tree"
                    class="authentication-image-object-right d-none d-lg-block" width="200"/>
            </div>
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->

    <script src="{{ asset('materio/assets/vendor/libs/jquery/jquery.js') }}"></script>

    <script src="{{ asset('materio/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('materio/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('materio/assets/vendor/libs/node-waves/node-waves.js') }}"></script>

    <script src="{{ asset('materio/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('materio/assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->

    <script src="{{ asset('materio/assets/js/main.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async="async" defer="defer" src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
