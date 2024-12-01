@extends('system.layouts.config')

@section('create')
@endsection

@section('data')
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button"
                    role="tab" aria-controls="nav-home-tab" aria-selected="false">General</button>
                <button class="nav-link" id="locations-tab" data-bs-toggle="tab" data-bs-target="#locations" type="button"
                    role="tab" aria-controls="locations-tab" aria-selected="false">Locations</button>
                <button class="nav-link" id="nav-social-media-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Social Media</button>
                <button class="nav-link" id="about-us-tab" data-bs-toggle="tab" data-bs-target="#about-us" type="button"
                    role="tab" aria-controls="about-us-tab" aria-selected="false">About Us</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                <div class="card">
                    <div class="card-body">
                        @include('system.frontend-config.general')
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="locations" role="tabpanel" aria-labelledby="locations-tab" tabindex="0">
                <div class="card">
                    <div class="card-body">
                        @include('system.frontend-config.locations')
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-social-media-tab"
                tabindex="0">
                <div class="card">
                    <div class="card-body">
                        @include('system.frontend-config.social-media')
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="about-us" role="tabpanel" aria-labelledby="about-us-tab" tabindex="0">
                <div class="card">
                    <div class="card-body">
                        @include('system.frontend-config.about-us')
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </form>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to handle tab changes
            function handleTabChange(tabId) {
                history.pushState(null, null, '#' + tabId);
                document.querySelectorAll('.nav-link').forEach(tab => {
                    tab.classList.remove('active');
                    tab.setAttribute('aria-selected', 'false');
                });
                document.querySelector('.nav-link[data-bs-target="#' + tabId + '"]').classList.add('active');
                document.querySelector('.nav-link[data-bs-target="#' + tabId + '"]').setAttribute('aria-selected',
                    'true');
                document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('show', 'active'));
                document.querySelector('#' + tabId).classList.add('show', 'active');
            }

            // Check for hash in URL and set the tab accordingly
            const hash = window.location.hash.substr(1);
            if (hash) {
                handleTabChange(hash);
            } else {
                handleTabChange('nav-home'); // Default to the first tab if no hash
            }

            // Event listeners for tab clicks
            document.querySelectorAll('.nav-link').forEach(tab => {
                tab.addEventListener('click', function() {
                    const tabId = this.getAttribute('data-bs-target').substr(1);
                    handleTabChange(tabId);
                });
            });
        });
    </script>
@endsection
