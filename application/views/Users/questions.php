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
    <!-- custom style sheets -->
    <title>MCQ</title>
    <style>
    .correct{
        display:none;
    }
    </style>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>
    <section>
        <div class="color-sectn">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-4">
                        <img src="img\ceydigital.png" class="img-batch">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-8">
                        <p class="mission">Various versions have evolved over the years, sometimes by accident,
                            sometimes on
                            purpose</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <h4 class="inner" id=""></h4>
            <div class="row justify-content-around">
                <div class="col-8 crd-responsive">
                    <div class="qna-sec">

                        <?php foreach ($questions as $question):
                              $decode_q = json_decode($question);
                              for($x = 0;$x<count($decode_q); $x++):
                        ?>

                        <div class="card mt-3 ">                            
                            <div class="card-body question-card"  id="">                                 
                                <!-- question -->
                                <h6>
                                    <?php echo ($decode_q[$x]->question);?>
                                </h6>  

                                <!-- answers -->
                                <?php for($a = 0;$a<count($decode_q[$x]->answers);$a++):

                                    $answers = $decode_q[$x]->answers[$a];?>

                                    <div class="form-check" id="<?php echo $a ?>">
                                        <input class="form-check-input" onclick="check(id)" type="radio" value="<?php echo($answers->is_correct)?>" name="flexRadioDefault1" id=""/>
                                        <label class="form-check-label" for="flexRadioDefault1"><?php echo($answers->answer)?></label>
                                    </div>    

                                <?php endfor ?>
                                <button class="btn btn-primary border-primary" onclick="check_answer()">Check my answer</button>
                            </div>
                        </div>                        
                        <?php endfor ?>
                        <?php  endforeach ?>
                    </div>
                    <hr>
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


        function check_answer(){
            console.log('value');
        }

        function check(id){
            const parent = document.querySelector('#'+id).parentNode.parentNode.id;
            const rad_buttons = document.querySelectorAll('#'+parent);
            for(var i=0; i<rad_buttons.length; i++){
                console.log(rad_buttons[i].id);
            }
        }

        function set_id_for_radio_buttons(){

            const radio_buttons = document.querySelectorAll('.card .card-body .form-check .form-check-input');
            for(var i=0; i<radio_buttons.length; i++){
                radio_buttons[i].id = 'rb-id-'+ i;
            }

            const question_cards = document.querySelectorAll('.question-card');
            for(var i=0; i<question_cards.length; i++ ){
                question_cards[i].id = 'qc-id-'+i;
            }

        }

        set_id_for_radio_buttons();

    </script>
</body>

</html>
