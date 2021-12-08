<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>CodeIgniter Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <style>
    .main {
        background-color: #d7d8da38;
        padding: 50px;
        border: 1px dotted grey;
    }
    h5{
        text-align:center;
        margin-top:50px;
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
                        <a class="nav-link " aria-current="page"
                            href="<?php echo base_url(); ?>admin/questions">Questions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo base_url(); ?>admin/categories">Categories</a>
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
        <h5>Add new category</h5>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 mt-5">
                <div class="main">
                    <form method="post">
                        <div class="form-group">
                            <label for="name" class="form-label">Enter Category Name</label>
                            <input type="text" class="form-control" name="name" required />
                        </div>
                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-success" name="save" value="Save Data" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- bootstrap js cdn -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <!-- jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</body>

</html>