<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row gy-6">
                <!-- Congratulations card -->
                <div class="col-md-12 col-lg-4">
                    <div class="card">
                        <div class="card-body text-nowrap">
                            <h5 class="card-title mb-0 flex-wrap text-nowrap">Welcome To Web Planning! 💍
                            </h5>
                            <p class="mb-2" style="color: red">{{ Auth::user()->name }}</p>
                            <h4 class="text-primary mb-0">Rp {{ number_format($totalBudget, 0, ',', '.') }}</h4>
                            <p class="mb-2">{{ number_format($totalProgressPercentage, 1) }}% of target 🚀</p>
                            <a href="javascript:;" class="btn btn-sm btn-primary">Explore</a>
                        </div>
                        <img src="{{ asset('materio/assets/img/backgrounds/wed.png') }}"
                            class="position-absolute bottom-0 end-0 me-5 mb-5" width="150" alt="view sales" />
                    </div>
                </div>
                <!--/ Congratulations card -->

                <!-- Transactions -->
                <div class="col-lg-8">
                    <div class="card h-100">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-title m-0 me-2">Web Planning</h5>
                                <div class="dropdown">
                                    <button class="btn text-body-secondary p-0" type="button" id="transactionID"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-base ri ri-more-2-line icon-24px"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                                        <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                    </div>
                                </div>
                            </div>
                            <p class="small mb-0"><span class="h6 mb-0">Umam & Indah</span></p>
                        </div>
                        <div class="card-body pt-lg-10">
                            <div class="row g-6">
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-primary rounded shadow-xs">
                                                <i class="icon-base ri ri-folder-line icon-24px"></i>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <p class="mb-0 fw-semibold">Kategori</p>
                                            <h5 class="mb-0">{{ number_format($totalKategori) }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-success rounded shadow-xs">
                                                <i class="icon-base ri ri-calendar-check-line icon-24px"></i>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <p class="mb-0 fw-semibold">Planing</p>
                                            <h5 class="mb-0">{{ number_format($totalPlanning) }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-warning rounded shadow-xs">
                                                <i class="icon-base ri ri-user-line icon-24px"></i>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <p class="mb-0 fw-semibold">Tamu</p>
                                            <h5 class="mb-0">{{ number_format($totalTamu) }}</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-info rounded shadow-xs">
                                                <i class="icon-base ri ri-gift-line icon-24px"></i>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <p class="mb-0 fw-semibold">Gift</p>
                                            <h5 class="mb-0">{{ number_format($totalMS) }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Transactions -->

                <!-- Weekly Overview Chart -->
                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-1">Weekly Overview</h5>
                                <div class="dropdown">
                                    <button class="btn text-body-secondary p-0" type="button"
                                        id="weeklyOverviewDropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="icon-base ri ri-more-2-line icon-24px"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end"
                                        aria-labelledby="weeklyOverviewDropdown">
                                        <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-lg-2">
                            <div id="weeklyOverviewChart"></div>
                            <div class="mt-1 mt-md-3">
                                <div class="d-flex align-items-center gap-4">
                                    <h4 class="mb-0">45%</h4>
                                    <p class="mb-0">Your sales performance is 45% 😎 better compared to last
                                        month</p>
                                </div>
                                <div class="d-grid mt-3 mt-md-4">
                                    <button class="btn btn-primary" type="button">Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Weekly Overview Chart -->

                <!-- Total Earnings -->
                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 me-2">Total Earning</h5>
                            <div class="dropdown">
                                <button class="btn text-body-secondary p-0" type="button" id="totalEarnings"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-base ri ri-more-2-line icon-24px"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalEarnings">
                                    <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-lg-8">
                            <div class="mb-5 mb-lg-12">
                                <div class="d-flex align-items-center">
                                    <h3 class="mb-0">$24,895</h3>
                                    <span class="text-success ms-2">
                                        <i class="icon-base ri ri-arrow-up-s-line icon-sm"></i>
                                        <span>10%</span>
                                    </span>
                                </div>
                                <p class="mb-0">Compared to $84,325 last year</p>
                            </div>
                            <ul class="p-0 m-0">
                                <li class="d-flex mb-6">
                                    <div class="avatar flex-shrink-0 bg-lightest rounded me-3">
                                        <img src="{{ asset('materio/assets/img/icons/misc/zipcar.png') }}"
                                            alt="zipcar" />
                                    </div>
                                    <div
                                        class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Zipcar</h6>
                                            <p class="mb-0">Vuejs, React & HTML</p>
                                        </div>
                                        <div>
                                            <h6 class="mb-2">$24,895.65</h6>
                                            <div class="progress bg-label-primary" style="height: 4px">
                                                <div class="progress-bar bg-primary" style="width: 75%"
                                                    role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-6">
                                    <div class="avatar flex-shrink-0 bg-lightest rounded me-3">
                                        <img src="{{ asset('materio/assets/img/icons/misc/bitbank.png') }}"
                                            alt="bitbank" />
                                    </div>
                                    <div
                                        class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Bitbank</h6>
                                            <p class="mb-0">Sketch, Figma & XD</p>
                                        </div>
                                        <div>
                                            <h6 class="mb-2">$8,6500.20</h6>
                                            <div class="progress bg-label-info" style="height: 4px">
                                                <div class="progress-bar bg-info" style="width: 75%" role="progressbar"
                                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex">
                                    <div class="avatar flex-shrink-0 bg-lightest rounded me-3">

                                        <img src="{{ asset('materio/assets/img/icons/misc/aviato.png') }}"
                                            alt="aviato" />
                                    </div>
                                    <div
                                        class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Aviato</h6>
                                            <p class="mb-0">HTML & Angular</p>
                                        </div>
                                        <div>
                                            <h6 class="mb-2">$1,2450.80</h6>
                                            <div class="progress bg-label-secondary" style="height: 4px">
                                                <div class="progress-bar bg-secondary" style="width: 75%"
                                                    role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/ Total Earnings -->

                <!-- Four Cards -->
                <div class="col-xl-4 col-md-6">
                    <div class="row gy-6">
                        <!-- Total Profit line chart -->
                        <div class="col-sm-6">
                            <div class="card h-100">
                                <div class="card-header pb-0">
                                    <h4 class="mb-0">$86.4k</h4>
                                </div>
                                <div class="card-body">
                                    <div id="totalProfitLineChart" class="mb-3"></div>
                                    <h6 class="text-center mb-0">Total Profit</h6>
                                </div>
                            </div>
                        </div>
                        <!--/ Total Profit line chart -->
                        <!-- Total Profit Weekly Project -->
                        <div class="col-sm-6">
                            <div class="card h-100">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-secondary rounded-circle shadow-xs">
                                            <i class="icon-base ri ri-pie-chart-2-line icon-24px"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn text-body-secondary p-0" type="button" id="totalProfitID"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-base ri ri-more-2-line icon-24px"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalProfitID">
                                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h6 class="mb-1">Total Profit</h6>
                                    <div class="d-flex flex-wrap mb-1 align-items-center">
                                        <h4 class="mb-0 me-2">$25.6k</h4>
                                        <p class="text-success mb-0">+42%</p>
                                    </div>
                                    <small>Weekly Project</small>
                                </div>
                            </div>
                        </div>
                        <!--/ Total Profit Weekly Project -->
                        <!-- New Yearly Project -->
                        <div class="col-sm-6">
                            <div class="card h-100">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-primary rounded-circle shadow-xs">
                                            <i class="icon-base ri ri-file-word-2-line icon-24px"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn text-body-secondary p-0" type="button" id="newProjectID"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-base ri ri-more-2-line icon-24px"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="newProjectID">
                                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h6 class="mb-1">New Project</h6>
                                    <div class="d-flex flex-wrap mb-1 align-items-center">
                                        <h4 class="mb-0 me-2">862</h4>
                                        <p class="text-danger mb-0">-18%</p>
                                    </div>
                                    <small>Yearly Project</small>
                                </div>
                            </div>
                        </div>
                        <!--/ New Yearly Project -->
                        <!-- Sessions chart -->
                        <div class="col-sm-6">
                            <div class="card h-100">
                                <div class="card-header pb-0">
                                    <h4 class="mb-0">2,856</h4>
                                </div>
                                <div class="card-body">
                                    <div id="sessionsColumnChart" class="mb-3"></div>
                                    <h6 class="text-center mb-0">Sessions</h6>
                                </div>
                            </div>
                        </div>
                        <!--/ Sessions chart -->
                    </div>
                </div>
                <!--/ four cards -->
            </div>
        </div>
        <!-- / Content -->

        <!-- Footer -->
        {{-- <footer class="content-footer footer bg-footer-theme">
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
        </footer> --}}
        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
    </div>
</x-app-layout>
