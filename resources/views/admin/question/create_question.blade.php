<!doctype html>
<x-header title="{{ 'question' }}" />

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
                                            <h5 class="mb-1 me-2"> @auth
                                                    {{ auth()->user()->name }}/'s Profile
                                                @endauth </h5>
                                        </div>

                                    </div>

                                    <div class="card-body m-2 p-2 shadow shadow-md">
                                        <form action="/admin/add-question" method="post">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                                            <div class="form-floating col-lg-11 m-1">
                                                <label for="question_text">Question Text</label>
                                                <input required value="{{ old('question_text') }}" class="form-control"
                                                    type="text" name="question_text" id="question_text" />
                                            </div>
                                            <button id="submit_question" type="button"
                                                class="btn shadow d-inline-block border btn-primary"> submit
                                                question</button>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <input class="form-check-input mt-0" type="radio" name="iscorrect" value="a" aria-label="Checkbox for following text input">>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Alternative A" id="question_labela" name="question_labela" aria-label="Text input with checkbox">
                                            </div>

                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <input class="form-check-input mt-0" type="radio" name="iscorrect" value="b" aria-label="Checkbox for following text input">
                                                </div>
                                                <input type="text" class="form-control" placeholder="Alternative B" id="question_labelb" name="question_labelb" aria-label="Text input with checkbox">
                                            </div>

                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <input class="form-check-input mt-0" type="radio" name="iscorrect" value="c" aria-label="Checkbox for following text input">
                                                </div>
                                                <input type="text" class="form-control" placeholder="Alternative C" id="question_labelc" name="question_labelc" aria-label="Text input with checkbox">
                                            </div>

                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <input class="form-check-input mt-0" type="radio" name="iscorrect" value="d" aria-label="Checkbox for following text input">
                                                </div>
                                                <input type="text" class="form-control" placeholder="Alternative D" id="question_labeld" name="question_labeld" aria-label="Text input with checkbox">
                                            </div>
                                            <input type="submit" class="m-2 btn btn-primary" value="add question"
                                                name="add_question" id="add_question">
                                        </form>

                                    </div>
                                    <div class="m-2 p-2 shadow shadow-md">
                                        <table class="table table-striped table-outline-primary ">
                                            <tr class="bg-secondary ">
                                                <th class="text-white">
                                                    Question
                                                </th>
                                                <th class="text-white">
                                                    a
                                                </th>
                                                <th class="text-white">
                                                    b
                                                </th>
                                                <th class="text-white">
                                                    c
                                                </th>
                                                <th class="text-white">
                                                    d
                                                </th>
                                                <th class="text-white">
                                                    Action
                                                </th>
                                            </tr>
                                            <tbody>

                                            </tbody>
                                        </table>
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
        document.addEventListener("DOMContentLoaded", function () {
            const submitButton = document.getElementById("submit_question");

            submitButton.addEventListener("click", async function () {
                const questionText = document.getElementById("question_text").value;

                if (!questionText) {
                    alert("Please enter a question text.");
                    return;
                }

                try {
                    // Send the question text and quiz ID first
                    const response = await fetch("/admin/add-question", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            question_text: questionText,
                            quiz_id: "{{ $quiz->id }}"
                        })
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        alert("Question added successfully!");

                        // Call the function to submit question labels
                        await submitQuestionLabels();

                        // Optionally reload the page or disable inputs
                        document.getElementById("question_text").disabled = true;
                    } else {
                        alert(data.message || "An error occurred while adding the question.");
                    }
                } catch (error) {
                    console.error("Error:", error);
                    alert("An error occurred. Please try again.");
                }
            });

            async function submitQuestionLabels() {
                const labels = [
                    { id: "question_labela", isCorrect: document.querySelector("input[name='iscorrect'][value='a']").checked },
                    { id: "question_labelb", isCorrect: document.querySelector("input[name='iscorrect'][value='b']").checked },
                    { id: "question_labelc", isCorrect: document.querySelector("input[name='iscorrect'][value='c']").checked },
                    { id: "question_labeld", isCorrect: document.querySelector("input[name='iscorrect'][value='d']").checked }
                ];

                for (const label of labels) {
                    const labelInput = document.getElementById(label.id);

                    if (!labelInput.value) {
                        alert(`Please fill in the label for ${label.id}.`);
                        return;
                    }

                    try {
                        const response = await fetch("/admin/add-question-label", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                question_label: labelInput.value,
                                is_correct: label.isCorrect,
                                quiz_id: "{{ $quiz->id }}"
                            })
                        });

                        const data = await response.json();

                        if (!response.ok || !data.success) {
                            console.error("Error submitting label:", data.message);
                            alert(data.message || "An error occurred while submitting the question label.");
                            return;
                        }
                    } catch (error) {
                        console.error("Error:", error);
                        alert("An error occurred while submitting the question label.");
                    }
                }

                alert("All question labels submitted successfully!");
            }

            // Delete button functionality
            const deleteButtons = document.querySelectorAll("#delete");
            deleteButtons.forEach((deleteButton) => {
                deleteButton.addEventListener("click", function (e) {
                    e.preventDefault();
                    const form = e.target.closest("form");
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
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</body>
     
</html>
