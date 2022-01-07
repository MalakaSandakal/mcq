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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- custom style sheets -->
    <link rel="stylesheet" href="<?php echo base_url()?>style/style.css"/>       
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-XWC685PDJY');
    </script>
    <title>MCQ Hero - Home</title>
</head>

<body>
    <div class="top-bar-sec sticky-top">
        <h3 class="top-head">MCQ Hero</h3>
        <!-- <img src="<?php echo base_url()?>images/cey-logo.png" class="logo-img" alt=""> -->
    </div>
    <div class="container-fluid page-cont">
        <div class="container">
            <div class="row">
                <div class="col-md-4 man-img-col">
                <img src="<?php echo base_url()?>images/man.png" class="w-100 man-img" style="-webkit-transform: scaleX(-1);transform: scaleX(-1);" alt="">
                </div>
                <div class="col-md-6 carousel-sec">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" >
                                <h1 class="carousel-text">Learning is never done without errors & defeat.</h1>
                                <hr class="head-hr">
                                <span class="quote-by">" Vladimir Lenin "</span>
                            </div>
                            <div class="carousel-item" >
                                <h1 class="carousel-text">An investment in knowledge pays the best interest.</h1>
                                <hr class="head-hr">
                                <span class="quote-by">" Benjamin Franklin "</span>
                            </div>
                            <div class="carousel-item" >
                                <h1 class="carousel-text">Anyone who keeps learning stays young.</h1>
                                <hr class="head-hr">
                                <span class="quote-by">" Henry Ford "</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    <div class="container-fluid body"></div>
    <section class="cat-sec">
        <div class="container px-4">
            <div class="row gx-5">
                <div class="col pt-4" id="categories">
                    <div class="categories-sec">
                        <div class="categories-intro">
                            <h1 class="categories-head">Select your category...</h1>
                            <i class="far fa-hand-point-up"></i>                            
                            <input type="text" class="" id="search-cat" placeholder="Search">
                        </div>  
                        <div class="row mt-5 gx-3 cat-col-row">
                            <?php foreach($category as $row) : ?>
                                <div class="col-4 mt-3 cat-col">
                                    <a href="<?php echo base_url('category/').$row->id ?>"><button type="button" class="category-grp text-pop-up-top">   
                                    <div class="right-btn-sec">
                                        <i class="fas fa-record-vinyl"></i>
                                    </div>
                                    <div class="category-name">
                                        <?php echo $row->name;?>
                                    </div> </button></a>
                                </div>
                            <?php endforeach; ?>
                            
                        </div>
                    </div>
                </div>
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
    <script src="<?php echo base_url()?>js/main.js"></script>
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XWC685PDJY"></script>
    <script>
        $( "#search-cat" ).keyup(function() {
            const term = this.value.toLowerCase();
            const cat_list = document.querySelectorAll('.cat-col');
            for(var i = 0; i<cat_list.length; i++){
                const cat_name = cat_list[i].querySelector('a button .category-name').innerText.toLowerCase();
                if(cat_name.indexOf(term) != -1){
                    cat_list[i].style.display = "";
                }else{
                    cat_list[i].style.display = "none";
                }
            }
        });
    </script>
</body>

</html>