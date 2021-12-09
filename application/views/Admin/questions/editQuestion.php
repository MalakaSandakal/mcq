<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>CodeIgniter Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <style>
    .add-answer {
        /* float:right; */
        padding-top: 5px !important;
        padding-bottom: 5px !important;
    }

    .main {
        background-color: #d7d8da38;
        padding: 50px;
        border: 1px dotted grey;
    }
    h5{
        text-align:center;
        margin-top:50px;
    }
    .success-msg,.error-msg{
        display:none;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav" style="margin-left:auto !important;margin-right:auto !important">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="<?php echo base_url(); ?>admin/questions">Questions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>admin/categories">Categories</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger" href="<?php echo base_url(); ?>admin/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h5>Update question</h5>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 mt-5">
                <div class="main">
                    <div class="question">
                        <div class="mb-3">
                            <label for="" class="form-label">Question :- </label>
                            <input name="question" type="text" class="question-input form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="sort-number" class="form-label">Sort Number :-</label>
                            <input name="sort-number" type="number" class="sort-number form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="category-select" class="form-label">Select category :-</label><select
                                class="form-select category-select" aria-label="Default select example">
                                <?php foreach ($category->result() as $row) { ?>
                                    <option id="" value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Answers :-</label>
                            <br>
                            <button type="btn" class="btn btn-success add-answer" onclick="add_answer_input()">+answer
                                input</button>
                            <div class="answers mb-3"></div>
                        </div>
                    </div>
                    ​
                    <button type="btn" class="btn btn-primary" onclick="submit_question()">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
    <div class="success-msg">
        <h5>Success</h5>
    </div>
    <div class="error-msg">
        <h5>Error</h5>
    </div>
    <!--  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
    function submit_question() {
        const question_input = document.querySelector(".question .question-input");
        const answer_groups = document.querySelectorAll(".question .answers .answer-group");
        const category = document.querySelector(".category-select");
        const sort_order = document.querySelector(".sort-number");
        const body = {
            answers: []
        };
        body.question = question_input.value;
        body.category = category.value;
        body.sort_order = sort_order.value;

        for (const answer_group of answer_groups) {
            const answer = answer_group.querySelector(".answer").value;
            const checkbox = answer_group.querySelector(".checkbox").checked;

            body.answers.push({
                answer: answer,
                is_correct: checkbox
            });
        }

        const id_ = "<?php echo $id ?>";

        if (answer_groups.length > 0) {
            $.ajax({
                url: "<?php echo base_url(); ?>admin/update_q/" + id_,
                type: "POST",
                data: body,
                success: function() {
                    $('.success-msg').css('display','block');
                }, 
                error: function() {
                    $('.error-msg').css('display','block');
                },
            });
        } else {
            alert("Please add atleast 1 answer!")
        }
    }

    function add_answer_input(answer, checked = false) {
        const question_element = document.querySelector(".question .answers");
        const div = document.createElement("div");
        div.className = "answer-group";

        const checkbox = document.createElement("input");
        checkbox.type = "checkbox";
        checkbox.className = "checkbox  form-check-input";
        checkbox.checked = checked;


        const input = document.createElement("input");
        input.type = "text";
        input.value = answer || null;
        input.className = "answer form-control mt-3";

        div.appendChild(input);
        div.appendChild(checkbox);
        question_element.appendChild(div);
    }

    function init_question(question, answers) {
        if (question.id) {
            $.ajax({
                url: '<?php echo base_url() ?>/admin/questions/edit/get/' + question.id,
                method: 'post',
                data: {
                    id: question.id
                },
                success: function(response) {
                    const res = JSON.parse(response).get_question;
                    console.log(JSON.parse(res));
                    // get question from the database
                    const dataset = JSON.parse(res);

                    const question_element = document.querySelector('.question .question-input');
                    question_element.value = dataset.question;

                    const sort_number = document.querySelector('.question .sort-number');
                    sort_number.value = dataset.sort_order;

                    // const selected_category = document.querySelector('.selected-category');
                    // selected_category.innerHTML = dataset.category;

                    for (const item of dataset.answers) {
                        add_answer_input(item.answer, item.is_correct);
                    }
                },
                error: function() {
                    alert('error');
                }
            });

        } else {
            add_answer_input();
        }
    }
    const id = null; // get id from query params
    init_question({
        id: "<?php echo $id ?>"
    });
    </script>
</body>

</html>