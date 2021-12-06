<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>CodeIgniter Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
        <style>
            .answer-rows{
                display:inline-flex;
                vertical-align:middle;
                align-items:center;
                width:100%;
            }
            .answer-input{
                width:95%;
            }
            .remove-answer{
                width:3%;
                margin-left:5px;
            }
        </style>
    </head>
    <body>
    <div class="main">
        <div id="content">
        <h2 id="form_head">Codelgniter Ajax Post</h2><br/>
        <hr>
        <form id="submit">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <hr>
        <div class="container">
            <button type="button" class="btn btn-info" onclick="addField()">Add new answer field</button>
            <div id="fields">
                <form id="answers">
                    <div class="mb-3" id="answ">

                    </div>
                    <input type="button" class="btn btn-success submit-answers" onclick="addid()" value="Submit answers">
                </form>
            </div>
        </div>        
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<script>
            function addField() {
                const div = document.createElement('div');
                div.className = 'answer-rows';
                div.innerHTML = `                
                    <input type="text" class="form-control mt-3 answer-input" id="answer-id" placeholder="Answer" name="answer" value=""/>
                    <input type="button" class="btn btn-danger mt-3 remove-answer" value="-" onclick="removeRow(this)"/>                
                `;
                document.getElementById('answ').appendChild(div);           
            }
            function removeRow(input) {
                document.getElementById('answ').removeChild(input.parentNode);
            }
            function addid(){                
                var c = document.getElementsByClassName("answer-input").length;
                for(let i=1;i<c;i++){
                   
                }
            }
           </script>

        </script>
        
        <script>
            // Ajax post
            $(document).ready(function() {
            $("#submit").submit(function(event) {
                event.preventDefault();
                var user_name = $("#exampleInputEmail1").val();
                var password = $("#exampleInputPassword1").val();
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "admin/ajax_",
                    dataType: 'json',
                    data: {name: user_name, pwd: password},
                    });
                });
            });
		</script>
	</body>
</html>
