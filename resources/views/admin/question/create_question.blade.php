<?phptype html>
<x-header title="{{ 'question' }}" />
namespace App\Http\Controllers;
<body>
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;ut-content-navbar">
use App\Models\Option;yout-container">
use App\Models\Question; Menu -->
use App\Models\Quiz;ar />
use Illuminate\Http\Request;nu -->
use Illuminate\Support\Js;ntainer -->
            <div class="layout-page">
class QuestionController extends Controller
{               <x-navbar />
    /**         <!-- / Navbar -->
     * Display a listing of the resource.
     */         <div class="content-wrapper">
    public function index()ntent -->
    {               <div class="container-xxl flex-grow-1 container-p-y">
        //              <div class="row">
        return view("admin.question.create_question");
    }                       <div class="col-md-6 col-lg-12 col-xl-12 order-0 mb-6">
                                <div class="card h-100">
    /**                             <div class="card-header d-flex justify-content-between">
     * Show the form for creating a new resource.s="card-title mb-0">
     */                                     <h5 class="mb-1 me-2"> @auth
    public function create(Quiz $quiz)              {{ auth()->user()->name }}/'s Profile
    {                                           @endauth </h5>
        //                              </div>
        return view("admin.question.create_question",["quiz"=>$quiz]);
    }                               </div>

    /**                             <div class="card-body m-2 p-2 shadow shadow-md">
     * Store a newly created resource in storage.ion="/admin/add-question" method="post">
     */                                     @csrf
    public function store(Request $request) @method('post')
    {                                       <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
        $validated = $request->validate([      <input type="hidden" id="current_question_id" name="current_question_id" value="">
            "question_text" => ["required"],                               <div class="form-floating col-lg-11 m-1">
            "quiz_id" => ["required"],<label for="question_text">Question Text</label>
        ]);      <input required value="{{ old('question_text') }}" class="form-control"
                                       type="text" name="question_text" id="question_text" />
        $q = Question::create([                                  </div>
            "quiz_id" => $request["quiz_id"],              <button id="submit_question" type="button"
            "question_text" => $request["question_text"],   class="btn shadow d-inline-block border btn-primary"> submit
        ]);/button>

        return response()->json([
            "success" => true,           <div class="input-group mb-3">
            "message" => "Question added successfully!",  <div class="input-group-text">
            "data" => [ut class="form-check-input mt-0" type="radio" name="iscorrect"
                "question_id" => $q->id, // Return the question ID-label="Checkbox for following text input">
                "quiz_id" => $request["quiz_id"],                                     </div>
                "question_text" => $request["question_text"]                                           <input type="text" class="form-control" placeholder="Alternative A"
            ]                                                    id="option_texta" name="option_texta"
        ]);                                             aria-label="Text input with checkbox">
    }    <input type="text" class="form-control" readonly name="option_labelA"
                                             value="A" aria-label="Read-only input">
    /**ton type="button" class="btn btn-primary submit-label"
     * Add a question label to the database.                                               data-label-id="option_texta" data-radio-value="A">Submit</button>
     */   </div>
    public function addOptionLabel(Request $request)
    {input-group mb-3">
        $validated = $request->validate([ <div class="input-group-text">
            'option_text' => 'required|string',            <input class="form-check-input mt-0" type="radio" name="iscorrect"
            'option_label' => 'required|string|max:255',                                             value="B" aria-label="Checkbox for following text input">
            'is_correct' => 'required|boolean',                                                </div>
            'question_id' => 'required',<input type="text" class="form-control" placeholder="Alternative B"
        ]);                         id="option_textb" name="option_textb"
a-label="Text input with checkbox">
        // Save the option label to the databasetype="text" class="form-control" readonly name="option_labelB"
        $o=Option::create([="B" aria-label="Read-only input">
            'option_text' => $validated['option_text'],on type="button" class="btn btn-primary submit-label"
            'question_id' => $validated['question_id'],                                         data-label-id="option_textb" data-radio-value="B">Submit</button>
            'option_label' => $validated['option_label'],                                            </div>
            'is_correct' => $validated['is_correct'],
        ]);              <div class="input-group mb-3">
put-group-text">
        return response()->json([                              <input class="form-check-input mt-0" type="radio" name="iscorrect"
            'success' => true,                                             value="C" aria-label="Checkbox for following text input">
            'message' => 'Question label added successfully!',                                           </div>
            'data'=>$o                                                <input type="text" class="form-control" placeholder="Alternative C"
        ]);                                             id="option_textc" name="option_textc"
    }              aria-label="Text input with checkbox">
                                         <input type="text" class="form-control" readonly name="option_labelC"
    /**                value="C" aria-label="Read-only input">
     * Display the specified resource.                                           <button type="button" class="btn btn-primary submit-label"
     */                                          data-label-id="option_textc" data-radio-value="C">Submit</button>
    public function show(Quiz $quiz)                   </div>
    {
        //                                       <div class="input-group mb-3">
        // dd($question);                                                <div class="input-group-text">
        return view("admin.question.show",['quiz'=>$quiz]);                                             <input class="form-check-input mt-0" type="radio" name="iscorrect"
    }value="D" aria-label="Checkbox for following text input">
                                         </div>
    /**    <input type="text" class="form-control"
     * Show the form for editing the specified resource.                                               placeholder="Alternative D" id="option_textd" name="option_textd"
     */                                          aria-label="Text input with checkbox">
    public function edit(Question $question)                                           <input type="text" class="form-control" readonly
    {                                                    name="option_labelD" value="D" aria-label="Read-only input">
        //                                         <button type="button" class="btn btn-primary submit-label"
    }    data-label-id="option_textd" data-radio-value="D">Submit</button>
                                     </div>
    /**-2 btn btn-primary" value="add question"
     * Update the specified resource in storage.                                           name="add_question" id="add_question"> --}}
     */                                      <a class="link btn " href="/admin/view-question/{{ $quiz->id }} "> reset and add question</a>
    public function update(UpdateQuestionRequest $request, Question $question)                                   </form>
    {
        //                             </div>
    }2 p-2 shadow shadow-md">
                                 <table class="table table-striped table-outline-primary ">
    /** class="bg-secondary ">
     * Remove the specified resource from storage.                                           <th class="text-white">
     */                                          Question
    public function destroy(Question $question)                </th>
    {
        //                                               a
        $question->delete();                                                    </th>
        return back()->with("success","Question deleted successfully");                                         <th class="text-white">
    }       b
                                         </th>
    /**       <th class="text-white">
     * Get the correct answer for a question.                                               c
     */
    public function getCorrectAnswer($id)                                                <th class="text-white">
    {
        $question = Question::with('options')->findOrFail($id);                                                </th>
                   <th class="text-white">
        $correctOption = $question->options->where('is_correct', true)->first();               Action
              </th>
        if ($correctOption) {
            return response()->json([                             <tbody>
                'success' => true,                                       @foreach ($quiz->questions as $question)
                'correct_answer' => "{$correctOption->option_label}: {$correctOption->option_text}"                                                    <tr>
            ]);                       <td>{{ $question->question_text }}</td>
        }                         <td>{{ $question->options->where('option_label', 'A')->first()->option_text ?? 'N/A' }}</td>
ion->options->where('option_label', 'B')->first()->option_text ?? 'N/A' }}</td>
        return response()->json([                                             <td>{{ $question->options->where('option_label', 'C')->first()->option_text ?? 'N/A' }}</td>
            'success' => false,                                                   <td>{{ $question->options->where('option_label', 'D')->first()->option_text ?? 'N/A' }}</td>
            'message' => 'No correct answer found for this question.'                                                       <td>
        ]);                                                            <form action="/admin/question/{{ $question->id }}" method="POST" style="display: inline;">



}    }                                                                @csrf
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
        document.addEventListener("DOMContentLoaded", function() {
            const submitButton = document.getElementById("submit_question");
            const form = document.querySelector("form");

            // Prevent default form submission
            form.addEventListener("submit", function(e) {
                e.preventDefault(); // Prevent the default form submission
            });

            submitButton.addEventListener("click", async function () {
                const questionText = document.getElementById("question_text").value;

                if (!questionText) {
                    alert("Please enter a question text.");
                    return;
                }

                try {
                    // Send the question text and quiz ID first
                    const response = await fetch("/admin/question/store", {
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
                        console.log(data);

                        // Store the question_id in a hidden input field
                        document.getElementById("current_question_id").value = data.data.question_id;

                        document.getElementById("question_text").disabled = true; // Disable the question input
                    } else {
                        alert(data.message || "An error occurred while adding the question.");
                    }
                } catch (error) {
                    console.error("Error:", error);
                    alert("An error occurred. Please try again.");
                }
            });

            const submitButtons = document.querySelectorAll(".submit-label");

            submitButtons.forEach((button) => {
                button.addEventListener("click", async function () {
                    const labelId = button.getAttribute("data-label-id");
                    const radioValue = button.getAttribute("data-radio-value");
                    const labelInput = document.getElementById(labelId);
                    const optionLabelElement = document.querySelector(`input[name="option_label${radioValue}"]`);
                    const isCorrectElement = document.querySelector(`input[name="iscorrect"][value="${radioValue}"]`);
                    const questionId = document.getElementById("current_question_id").value; // Get the current question ID

                    // Check if labelInput exists
                    if (!labelInput) {
                        console.error(`Label input with ID "${labelId}" not found.`);
                        alert(`Label input with ID "${labelId}" not found.`);
                        return;
                    }

                    // Check if optionLabelElement exists
                    if (!optionLabelElement) {
                        console.error(`Option label with name "option_label${radioValue}" not found.`);
                        alert(`Option label with name "option_label${radioValue}" not found.`);
                        return;
                    }

                    // Check if isCorrectElement exists
                    if (!isCorrectElement) {
                        console.error(`Radio button with value "${radioValue}" not found.`);
                        alert(`Radio button with value "${radioValue}" not found.`);
                        return;
                    }

                    const optionLabel = optionLabelElement.value;
                    const isCorrect = isCorrectElement.checked;

                    if (!labelInput.value) {
                        alert("Please fill in the label before submitting.");
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
                                option_text: labelInput.value, // The text of the option
                                option_label: optionLabel, // The label of the option (e.g., "A", "B", etc.)
                                is_correct: isCorrect, // Whether this option is correct
                                question_id: questionId // Use the current question ID
                            })
                        });

                        const data = await response.json();

                        if (response.ok && data.success) {
                            alert("Option submitted successfully!");
                            console.log(data);
                            labelInput.disabled = true; // Disable the input field
                            button.disabled = true; // Disable the button
                        } else {
                            console.log(data.message);
                            alert(data.message || "An error occurred while submitting the option.");
                        }
                    } catch (error) {
                        console.error("Error:", error);
                        alert("An error occurred. Please try again.");
                    }
                });
            });

            // Delete button functionality
            const deleteButtons = document.querySelectorAll("#delete");
            deleteButtons.forEach((deleteButton) => {
                deleteButton.addEventListener("click", function(e) {
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
