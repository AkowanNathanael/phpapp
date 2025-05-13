<!doctype html>
<x-header title="all question" />
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
                        <div class="container mt-4">
                
                            <h2>Manage Questions</h2>
                    
                            <!-- Add Question Form -->
                            <form id="add-question-form">
                                @csrf
                                <input type="hidden" id="current_question_id" name="current_question_id" value="">
                                <div class="form-floating mb-3">
                                    <label for="question_text">Question Text</label>
                                    <input required value="{{ old('question_text') }}" class="form-control" type="text" name="question_text" id="question_text" />
                                </div>
                                <button id="submit_question" type="button" class="btn btn-primary">Submit Question</button>
                            </form>
                    
                            <!-- Add Options -->
                            <div class="mt-4">
                                <h4>Options</h4>
                    
                                <!-- Option A -->
                                <div class="input-group mb-3">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" type="radio" name="iscorrect" value="A" aria-label="Checkbox for following text input">
                                    </div>
                                    <input type="text" class="form-control" placeholder="Alternative A" id="option_texta" name="option_texta" aria-label="Text input with checkbox">
                                    <input type="text" class="form-control" readonly name="option_labelA" value="A" aria-label="Read-only input">
                                    <button type="button" class="btn btn-primary submit-label" data-label-id="option_texta" data-radio-value="A">Submit</button>
                                </div>
                    
                                <!-- Option B -->
                                <div class="input-group mb-3">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" type="radio" name="iscorrect" value="B" aria-label="Checkbox for following text input">
                                    </div>
                                    <input type="text" class="form-control" placeholder="Alternative B" id="option_textb" name="option_textb" aria-label="Text input with checkbox">
                                    <input type="text" class="form-control" readonly name="option_labelB" value="B" aria-label="Read-only input">
                                    <button type="button" class="btn btn-primary submit-label" data-label-id="option_textb" data-radio-value="B">Submit</button>
                                </div>
                    
                                <!-- Option C -->
                                <div class="input-group mb-3">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" type="radio" name="iscorrect" value="C" aria-label="Checkbox for following text input">
                                    </div>
                                    <input type="text" class="form-control" placeholder="Alternative C" id="option_textc" name="option_textc" aria-label="Text input with checkbox">
                                    <input type="text" class="form-control" readonly name="option_labelC" value="C" aria-label="Read-only input">
                                    <button type="button" class="btn btn-primary submit-label" data-label-id="option_textc" data-radio-value="C">Submit</button>
                                </div>
                    
                                <!-- Option D -->
                                <div class="input-group mb-3">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" type="radio" name="iscorrect" value="D" aria-label="Checkbox for following text input">
                                    </div>
                                    <input type="text" class="form-control" placeholder="Alternative D" id="option_textd" name="option_textd" aria-label="Text input with checkbox">
                                    <input type="text" class="form-control" readonly name="option_labelD" value="D" aria-label="Read-only input">
                                    <button type="button" class="btn btn-primary submit-label" data-label-id="option_textd" data-radio-value="D">Submit</button>
                                </div>
                            </div>
                    
                            <!-- Questions Table -->
                            <div class="mt-4">
                                <h4>Existing Questions</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Question</th>
                                            <th>Options</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($quiz->questions as $question)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $question->question_text }}</td>
                                                <td>
                                                    <ul>
                                                        @foreach ($question->options as $option)
                                                            <li><strong>{{ $option->option_label }}:</strong> {{ $option->option_text }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <form action="/admin/question/{{ $question->id }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
    <script>
    document.addEventListener("DOMContentLoaded", function () {
    var els = document.querySelectorAll(".option");
    els.forEach(element => {
        element.disabled = "";
    });
    console.log(els);

    new DataTable("#basic");
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
});
</script>
    {{-- core js end  --}}
</body>
</html>

