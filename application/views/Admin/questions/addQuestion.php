<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>CodeIgniter Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    </head>
    <body>
        <div class="main">
            <div class="question">
                <label for="">Question</label>                
                <input name="question" type="text" class="question-input" />
                <p>Answers</p>                
                <button onclick="add_answer_input()">+</button>
                <br>
                <div class="answers"></div>
                <br>
                <label for="sort-number">Sort Number</label>
                <input name="sort-number" type="number" class="sort-number" />
                <br>
                <br>
                <label for="category-select">Select category</label>
                <select class="form-select category-select" aria-label="Default select example">
                    <?php foreach ($category->result() as $row) { ?>
                        <option id="" value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                    <?php } ?>
                </select>
            </div>
            ​
            <button onclick="submit_question()">Submit</button>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script>
            function submit_question() {
                const question_input = document.querySelector(".question .question-input");
                const answer_groups = document.querySelectorAll(".question .answers .answer-group");
                const category = document.querySelector(".category-select");
                const sort_order = document.querySelector(".sort-number");
                const body = { answers: [] };
                body.question = question_input.value;
                body.category = category.value;
                body.sort_order = sort_order.value;

                for (const answer_group of answer_groups) {
                    const answer = answer_group.querySelector(".answer").value;
                    const checkbox = answer_group.querySelector(".checkbox").checked;

                    body.answers.push({ answer: answer, is_correct: checkbox });
                }

                if(answer_groups.length>0){
                    $.ajax({
                        url: "<?php echo base_url(); ?>admin/add_q",
                        type: "POST",
                        data: body,
                        success: function () {
                            alert("sucess");
                        }, //up to you
                        error: function () {
                            alert("error");
                        }, // up to you
                    });
                }else{
                    alert("Please add atleast 1 answer!")
                }
            }

            function add_answer_input(answer, checked = false) {
                const question_element = document.querySelector(".question .answers");

                const div = document.createElement("div");
                div.className = "answer-group";

                const checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.className = "checkbox";
                checkbox.checked = checked;


                const input = document.createElement("input");
                input.type = "text";
                input.value = answer||null;
                input.className = "answer";

                div.appendChild(input);
                div.appendChild(checkbox);
                question_element.appendChild(div);
            }

            function init_question(question, answers) {
                if (question.id) {
                    // edit
                    // get question from the database
                    const dataset = { id: 1, question: 'q1', answers: [{ answer: 'a1' }] };
                    const question_element = document.querySelector('.question .question-input');
                    question_element.value = dataset.question;
                    for (const item of dataset.answers) {
                        add_answer_input(item.answer,item.is_correct);
                    }
                } else {
                    add_answer_input();
                }
		    }
            const id = null; // get id from query params
		    init_question({ id });
        </script>
    </body>
</html>
