<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>CodeIgniter Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
        <style>
            .answer-rows {
                display: inline-flex;
                vertical-align: middle;
                align-items: center;
                width: 100%;
            }
            .answer-input {
                width: 95%;
            }
            .remove-answer {
                width: 3%;
                margin-left: 5px;
            }
        </style>
    </head>
    <body>
        <div class="main">
            <div class="question">
                <label for="">Question</label>
                <select class="form-select category-select" aria-label="Default select example">
                    <?php foreach ($category->result() as $row) { ?>
                        <option id="<?php echo $row->id;?>" value="<?php echo $row->name;?>"><?php echo $row->name;?></option>
                    <?php } ?>
                </select>
                <input name="question" type="text" class="question-input" />
                <div class="answers"></div>
            </div>
            ​
            <button onclick="submit_question()">Submit</button>
            <button onclick="add_answer_input()">+</button>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script>
            function submit_question() {
                const question_input = document.querySelector(".question .question-input");
                const answer_inputs = document.querySelectorAll(".question .answers .answer");
                const category = document.querySelector(".category-select");
                const body = { answers: [] };
                body.question = question_input.value;
                // body.category = category.value;
                for (const answer of answer_inputs) {
                    body.answers.push({ answer: answer.value });
                }
                $.ajax({
                    url: "<?php echo base_url(); ?>admin/add_q",
                    type: "POST",
                    data: body,
                    success: function () {}, //up to you
                    error: function () {
                        alert("error");
                    }, // up to you
                });
            }

            function add_answer_input(value = null) {
                const question_element = document.querySelector(".question .answers");
                const input = document.createElement("input");
                input.type = "text";
                input.value = value;
                input.className = "answer";
                question_element.appendChild(input);
            }
        </script>
    </body>
</html>
