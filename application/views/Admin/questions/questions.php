<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>MCQ Hero - Questions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <style>
    .button-admin {
        padding-top: 0px;
        padding-bottom: 0px;

    }

    table {
        --bs-table-bg: #f8f8f8 !important;
    }

    .l-width {
        width: 85%;
    }

    .btn-edit {
        color: #27ca27;
        text-decoration: none;
    }

    .btn-delete {
        color: red;
        text-decoration: none;
        float: right;
    }

    tbody,
    td,
    tfoot,
    th,
    thead,
    tr {
        border-style: dotted;
    }
    #cat-input{
        border: 1px solid #80808069;
        border-radius: 5px;
        margin-bottom: 10px;
        padding-left: 10px;
        padding-top:10px;
        padding-bottom:10px;
        width: 100%;
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
        <div class="col-md-10 mt-5" style="text-align: right;">
            <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/addQuestion">Add Question</a>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 mt-3">
            <input type="text" id="cat-input" onkeyup="search()" placeholder="Search for question" title="Type in a name">
                <table class="table table-bordered table-secondary" id="table-cat">
                    <thead class="table-dark">
                        <tr>
                            <th class="l-width">Question</th>
                            <th class="l-width" style="text-align:center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($question as $row) : ?>
                        <tr>
                            <td class="l-width"><?php echo $row->question;?></td>
                            <td>
                                <a href="<?php echo base_url('admin/questions/edit/').$row->id ?>"
                                    class="button-admin btn-edit">edit</a>
                                <a href="<?php echo base_url('admin/questions/delete/').$row->id ?>"
                                    class="button-admin btn-delete" style="float:right">delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script>
            function search() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("cat-input");
                filter = input.value.toUpperCase();
                table = document.getElementById("table-cat");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[0];
                    if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                    }       
                }
            }
        </script>
</body>

</html>