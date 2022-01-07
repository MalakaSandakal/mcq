<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- bootstrap css cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <!-- fontawsome icons css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <!-- custom style sheets -->
    <link rel="stylesheet" href="<?php echo base_url()?>style/style.css"/>

    <!-- custom style sheets -->
    <title>MCQ Hero - <?php echo $category->name?></title>
    <style>
    .correct{
        display:none;
        color:#28da28;
    }
    .wrong{
        display:none;
        color:#ea4646;
    }
    body{
        padding-bottom: 30px;
    }
    .fa-arrow-left,.top-head{
        display:inline;
    }
    .fa-arrow-left{
        position: absolute;
    }
    </style>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
</head>

<body>
    <div class="top-bar-sec sticky-top">
        <i class="fas fa-arrow-left"></i>
        <h3 class="top-head"><?php echo $category->name?></h3>
    </div>
    <div class="test-img-sec">
        <img src="<?php echo base_url()?>images/grad-rem.png" class="questions-btm-img" alt="">
    </div>
    <div class="test-img-sec-2">
        <img src="<?php echo base_url()?>images/book.jpg" class="questions-btm-img-2" alt="">
    </div>
    <section>
        <div class="container mt-5">
            <div class="row justify-content-around">
                <div class="col-8 crd-responsive">
                    <div class="qna-sec gx-5">
                        <?php foreach ($questions as $question):
                              $decode_q = json_decode($question);
                              for($x = 0;$x<count($decode_q); $x++):
                        ?>

                        <div class="card question-card-def mt-3 mb-3 col-md-8">                            
                            <div class="card-body question-card"  id="">                                 
                                <!-- question -->
                                <h6 class="question mt-3">
                                    <i class="fas fa-question-circle"></i>
                                    <?php echo ($decode_q[$x]->question);?>
                                </h6>  

                                <!-- answers -->
                                <?php for($a = 0;$a<count($decode_q[$x]->answers);$a++):

                                    $answers = $decode_q[$x]->answers[$a];?>

                                    <div class="form-check mt-2" id="<?php echo $a ?>">
                                        <input class="form-check-input" type="radio" value="<?php echo($answers->is_correct)?>" onclick="enable_show_btn(id)" name="flexRadioDefault1" id=""/>
                                        <label class="form-check-label" for="flexRadioDefault1"><?php echo($answers->answer)?></label>
                                        <i class="far fa-check-circle correct"></i>
                                        <i class="far fa-times-circle wrong"></i>
                                    </div>    

                                <?php endfor ?>
                                <button class="btn btn-success answer-check mt-3" onclick="check_answer(id)">Check answer</button>
                            </div>
                            <hr class="questions-divider">   
                        </div>               
                        <?php endfor ?>
                        <?php  endforeach ?>
                    </div>
                    <button class="btn" id="loadmore" onclick="loadMore();">Load More <i class="far fa-arrow-alt-circle-down"></i></button>
                </div>
            </div>
        </div>
    </section>
    <!-- bootstrap js cdn -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <!-- jquery cdn -->
    <!-- custom js -->
    <script>      

        function check_answer(id){

            const parent = document.querySelector('#'+id).parentNode.id;
            const all_radio_btns = document.querySelectorAll('#'+parent+' .form-check .form-check-input');
            const correct_answer = document.querySelectorAll('#'+parent+' .form-check .correct');
            const wrong_answer = document.querySelectorAll('#'+parent+' .form-check .wrong');
            const check_answer_btn = document.querySelector('#'+parent+' .answer-check');

            for(var i=0; i<all_radio_btns.length; i++){

                if(all_radio_btns[i].id == id){
                    all_radio_btns[i].disabled = false;
                }else{
                    all_radio_btns[i].disabled = true;
                }

                if(all_radio_btns[i].value == '1'){
                    correct_answer[i].style.display = "inline-flex";
                    // all_radio_btns[i].disabled = false;
                }else{
                    wrong_answer[i].style.display = "inline-flex";
                }

                if(all_radio_btns[i].checked){
                    all_radio_btns[i].style.backgroundColor = "black";
                }else{
                    all_radio_btns[i].style.backgroundColor = "";
                }
            }
        }

        function set_id_for_radio_buttons(){

            const radio_buttons = document.querySelectorAll('.card .card-body .form-check .form-check-input');
            for(var i=0; i<radio_buttons.length; i++){
                radio_buttons[i].id = 'rb-id-'+ i;
            }

            const question_cards = document.querySelectorAll('.question-card');
            const check_answer_buttons = document.querySelectorAll('.answer-check');
            for(var i=0; i<question_cards.length; i++ ){
                question_cards[i].id = 'qc-id-'+i;
            }
            for(var i=0; i<check_answer_buttons.length; i++ ){
                check_answer_buttons[i].id = 'ca-id-'+i;
            }

        }

        set_id_for_radio_buttons();

        function enable_show_btn(id){
            const parent = document.querySelector('#'+id).parentNode.parentNode.id;
            const check_answer_btn = document.querySelector('#'+parent+' .answer-check');
            
            check_answer_btn.classList.add("enable-btn");            
        }

        var display_count = 20;
        var q_crds = document.querySelectorAll('.question-card-def');

        function loadMore(){
            display_count = display_count+20;
            display_init();
        }
        
        function display_init(){       
            for(var i=0; i<q_crds.length; i++){
                if(i>display_count){
                    q_crds[i].style.display = "none";
                } else{
                    q_crds[i].style.display = "";
                }
            }
            if(display_count>=q_crds.length){                
                document.querySelector('#loadmore').style.display = "none"; 
            }
        }

        display_init();

    </script>
</body>

</html>
