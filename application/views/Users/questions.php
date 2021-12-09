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
</head>

<body>
    <?php
        foreach($encode as $d){
            echo($d);
        }
    ?>
    <section>
        <div class="color-sectn">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-4">
                        <!-- <img src="img\ceydigital.png" class="img-batch"> -->
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
                <div class="col-9 crd-responsive">
                    <div class="qna-sec">
                        <div class="card border-primary">
                            <div class="card-body">
                                <h6>01.<span style="color: rgb(119, 119, 119);">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa iusto mollitia
                                        facere
                                        vel, voluptatum architecto ullam delectus dolor a suscipit, voluptatem fuga
                                        ipsum
                                        obcaecati iste est vero reiciendis
                                        illum illo.</span>
                                </h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault1"
                                        id="flexRadioDefault1" />
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault1"
                                        id="flexRadioDefault2" />
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        It has survived not only five centuries, but also the leap into
                                        electronic
                                        typesetting, remaining essentially unchanged.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault1"
                                        id="flexRadioDefault3" />
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        There are many variations of passages of Lorem Ipsum available, but the
                                        majority have suffered alteration in some form, by injected humour, or
                                        randomised words which don't look even slightly believable.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault1"
                                        id="flexRadioDefault4" />
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        All the Lorem Ipsum generators on the Internet tend to repeat predefined
                                        chunks as necessary, making this the first true generator on the
                                        Internet.
                                    </label>
                                </div>
                                <center>
                                    <button class="btn border-info" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">Show answer</button>
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ...
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </center>
                            </div>
                        </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- custom js -->
    <script>
        // function get_questions(){        
        //     const id ='<?php echo $id?>';
        //     const question = document.querySelector('.inner');
        //     $.ajax({
        //     url: '<?php echo base_url();?>category/get/'+id,
        //     data : {
        //         id: id,
        //     },
        //     method: 'post',
        //     success :function(response){

        //         const parsed = JSON.parse(response);
        //         question.id = parsed.message;

        //         console.log(parsed.message);
        //         alert('success');             
        //     },
        //     error :function(){
        //         alert('error');
        //     }
        // })  
        // }  
        // get_questions();
    </script>
</body>
</html>