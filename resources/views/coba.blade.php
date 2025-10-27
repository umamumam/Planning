<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Layout & Basic with Icons -->
            <div class="row mb-6 gy-6">
                <!-- Basic Layout -->
                <div class="col-xxl">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Basic Layout</h5>
                            <small class="text-body-secondary float-end">Default label</small>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="basic-default-name"
                                            placeholder="John Doe" />
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label" for="basic-default-company">Company</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="basic-default-company"
                                            placeholder="ACME Inc." />
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label" for="basic-default-email">Email</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <input type="text" id="basic-default-email" class="form-control"
                                                placeholder="john.doe" aria-label="john.doe"
                                                aria-describedby="basic-default-email2" />
                                            <span class="input-group-text" id="basic-default-email2">@example.com</span>
                                        </div>
                                        <div class="form-text">You can use letters, numbers & periods</div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Phone No</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="basic-default-phone" class="form-control phone-mask"
                                            placeholder="658 799 8941" aria-label="658 799 8941"
                                            aria-describedby="basic-default-phone" />
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label" for="basic-default-message">Message</label>
                                    <div class="col-sm-10">
                                        <textarea id="basic-default-message" class="form-control"
                                            placeholder="Hi, Do you have a moment to talk Joe?"
                                            aria-label="Hi, Do you have a moment to talk Joe?"
                                            aria-describedby="basic-icon-default-message2"></textarea>
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Basic with Icons -->
                <div class="col-xxl">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Basic with Icons</h5>
                            <small class="text-body-secondary float-end">Merged input group</small>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label"
                                        for="basic-icon-default-fullname">Name</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                    class="icon-base ri ri-user-line"></i></span>
                                            <input type="text" class="form-control" id="basic-icon-default-fullname"
                                                placeholder="John Doe" aria-label="John Doe"
                                                aria-describedby="basic-icon-default-fullname2" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label"
                                        for="basic-icon-default-company">Company</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-company2" class="input-group-text"><i
                                                    class="icon-base ri ri-building-4-line"></i></span>
                                            <input type="text" id="basic-icon-default-company" class="form-control"
                                                placeholder="ACME Inc." aria-label="ACME Inc."
                                                aria-describedby="basic-icon-default-company2" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Email</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i
                                                    class="icon-base ri ri-mail-line"></i></span>
                                            <input type="text" id="basic-icon-default-email" class="form-control"
                                                placeholder="john.doe" aria-label="john.doe"
                                                aria-describedby="basic-icon-default-email2" />
                                            <span id="basic-icon-default-email2"
                                                class="input-group-text">@example.com</span>
                                        </div>
                                        <div class="form-text">You can use letters, numbers & periods</div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 form-label" for="basic-icon-default-phone">Phone No</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                    class="icon-base ri ri-phone-fill"></i></span>
                                            <input type="text" id="basic-icon-default-phone"
                                                class="form-control phone-mask" placeholder="658 799 8941"
                                                aria-label="658 799 8941"
                                                aria-describedby="basic-icon-default-phone2" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-sm-2 form-label" for="basic-icon-default-message">Message</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-message2" class="input-group-text"><i
                                                    class="icon-base ri ri-chat-4-line"></i></span>
                                            <textarea id="basic-icon-default-message" class="form-control"
                                                placeholder="Hi, Do you have a moment to talk Joe?"
                                                aria-label="Hi, Do you have a moment to talk Joe?"
                                                aria-describedby="basic-icon-default-message2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->

        <!-- Footer -->
        <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl">
                <div
                    class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                    <div class="mb-2 mb-md-0">
                        &#169;
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        , made with ❤️ by
                        <a href="https://themeselection.com" target="_blank"
                            class="footer-link fw-medium">ThemeSelection</a>
                    </div>
                    <div class="d-none d-lg-inline-block">
                        <a href="https://themeselection.com/item/category/admin-templates/" target="_blank"
                            class="footer-link me-4">Admin Templates</a>

                        <a href="https://themeselection.com/license/" class="footer-link me-4"
                            target="_blank">License</a>

                        <a href="https://themeselection.com/item/category/bootstrap-templates/" target="_blank"
                            class="footer-link me-4">Bootstrap Templates</a>
                        <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/documentation/"
                            target="_blank" class="footer-link me-4">Documentation</a>

                        <a href="https://github.com/themeselection/materio-bootstrap-html-admin-template-free/issues"
                            target="_blank" class="footer-link">Support</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
    </div>
</x-app-layout>
