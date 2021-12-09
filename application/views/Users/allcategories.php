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
    <link rel="stylesheet" href="style/css/css/all.css" />
    <!-- custom style sheets -->
    <link rel="stylesheet" href="style/style.css" />
    <title>All categories</title>
</head>

<body>
    <section>
        <div class="container px-4">
            <div class="row gx-5">
                <div class="col pt-4" id="categories">
                    <div class="p-3 border bg-light">
                        <div class="header">Title Name</div>
                        <hr>
                        <div class="row">
                            <?php foreach($category as $row) : ?>
                                <div class="col-4">
                                    <a href="<?php echo base_url('category/').$row->id ?>"><button type="button" class="btn category-grp"><?php echo $row->name;?></button></a>
                                </div>
                            <!-- <tr>
                                <td class="l-width"><?php echo $row->name;?></td>
                                <td>
                                    <a href="<?php echo base_url('admin/categories/edit/').$row->id ?>"
                                        class="button-admin btn-edit">edit</a>
                                    <a href="<?php echo base_url('admin/categories/delete/').$row->id ?>"
                                        class="button-admin btn-delete" style="float:right">delete</a>
                                </td>
                            </tr> -->
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
    <script src="style/main.js"></script>

</body>

</html>