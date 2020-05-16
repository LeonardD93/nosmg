 <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if (session('error'))
                    <div class="alert alert-danger">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                @if (session('warning'))
                    <div class="alert alert-warning">
                        <p>{{ session('warning') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>