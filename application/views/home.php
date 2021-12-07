<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>CodeIgniter Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
                        <a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>admin/questions">Questions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>admin/categories">Categories</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger" href="<?php echo base_url(); ?>admin/logout" >Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
		<div class="col-md-10 pt-3" style="text-align: right;">
			<a class="btn btn-primary" href="<?php echo base_url(); ?>admin/addQuestion">Add Question</a>
		</div>   
        <div class="col-md-8 mt-3">
                    <table class="table table-bordered table-secondary">
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
                                    <a href="<?php echo base_url('admin/questions/edit/').$row->id ?>" class="button-admin btn-edit">edit</a>
                                    <a href="<?php echo base_url('admin/questions/delete/').$row->id ?>" class="button-admin btn-delete" style="float:right">delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>            
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>