<!doctype html>
<x-header title="{{ $resource->title }}" />

<body>
    <!-- Layout wrapper -->
    <div id="top" class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- sidebar Menu -->
            <x-sidebar />
            <!-- / sidebarMenu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <x-navbar />
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <!-- Order Statistics -->
                            <div class="col-md-6 col-lg-12 col-xl-12 order-0 mb-6">
                                <div class="card h-100">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="card-title mb-0">
                                            <h5 class="mb-1 me-2">View resource </h5>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <div class="card mb-6 shadow border">
                                            <div class="card-body">
                                                <h5 class="card-title mb-1">{{ $resource->title }}</h5>
                                                <div class="ima">
                                                   @if (str_contains($resource->file,"image"))
                                                        <img src="{{ $resource->file? asset('storage/' . $resource->file) : asset('no-image.png') }}" alt="post image" class="img-fluid border m-2 rounded-start" style="width: 400px; height: 300px; object-fit: cover;">
                                                   @elseif (str_contains($resource->file,"video"))
                                                        <video class="img-fluid border m-2 rounded-start"  style="width: 400px; height: 300px; object-fit: cover;"  src="{{ asset('storage/' . $resource->file) }}" controls autoplay></video>
                                                        @else
                                                        <span width="200px" height="200px" class="inline-block">
                                                            <i class="menu-icon tf-icons bx bx-detail"></i>
                                                        </span>
                                                   @endif
                                                </div>
                                                <div class="card-subtitle mb-4">{{ $resource->created_at->diffForHumans() }}</div>
                                                <p class="card-text">
                                                    {{ $resource->description }}
                                                </p>
                                                <a href="/admin/resource/{{ $resource->id }}/edit" class="card-link inline-block btn btn-success">edit</a>
                                                <form action="/admin/resource/{{ $resource->id  }}"  class="inline-block"  method="post">
                                                    @csrf
                                                    @method("delete")
                                                    <button id="delete" type="submit" class="card-link inline-block btn btn-danger">delete</button>
                                                </form>
                                                @if ($resource->file)
                                                    <a href="{{ asset('storage/' . $resource->file) }}" download="{{$resource->title  }}" class="btn text-primary border rounded-3 m-2">
                                                    download resource </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        @if ($resource->url)
                                        <a target="_blank" href="{{ $resource->url }}" class="link">resource url</a>
                                           @else
                                        <span> no url</span>
                                        @endif
                                         
                                         <p class="lead text-center">
                                           Type:    {{ $resource->type }}
                                         </p>
                                    </div>
                                </div>
                            </div>
                            <!--/ Order Statistics -->
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <x-footer />
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <div class="buy-now">
        <a href="#top" class="btn btn-danger btn-buy-now">top</a>
    </div>

    <!-- Core JS -->
    <x-scripts />
    {{-- core js end  --}}
    <script>
           const deleteButtons = document.querySelectorAll("#delete"); // Select all delete buttons
    deleteButtons.forEach(deleteButton => {
        deleteButton.addEventListener("click", function (e) {
            e.preventDefault(); // Prevent the default form submission
            const form = e.target.closest("form"); // Get the closest parent form
            swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit the form programmatically
                }
            });
        });
    });
    </script>
</body>

</html>
