<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>MCQ Hero - Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
        <style>
            .login-panel {
                padding-left: 20px;
                padding-right: 20px;
                padding-top: 70px;
				padding-bottom: 70px;
                border: 2px solid #ededed;
                border-radius: 5px;
                top: 50%;
				background-color:white;
            }
			.login-btn{
				padding-top:5px;
				padding-bottom:5px;
				font-size:17px;
				width:100%;
			}
			.panel-title{
				text-align:center;
				font-weight:550;
				color: #000000a3;
			}
			.form-control{
				font-size:15px;
			}
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-4 col-sm-offset-4 align-self-center">
                    <div class="login-panel panel panel-primary">
                        <div class="panel-heading">
                            <h4 class="panel-title pt-3 pb-3">Login</h4>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="<?php echo base_url(); ?>admin/login">
                                <fieldset>
                                    <div class="form-group pt-2">
                                        <input class="form-control" placeholder="Username" type="text" name="username" required />
                                    </div>
                                    <div class="form-group pt-2">
                                        <input class="form-control" placeholder="Password" type="password" name="password" required />
                                    </div>
                                    <button type="submit" class="btn btn-lg btn-primary btn-block mt-3 mb-3 login-btn">Login</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <?php
				if($this->session->flashdata('error')){ ?>
                    <div class="alert alert-danger text-center" style="margin-top: 20px;"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php
				}
			?>
                </div>
            </div>
        </div>
        <!-- bootstrap js cdn -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <!-- jquery cdn -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<script>
			const page_height = $(window).height();
			$('.row').css('height',page_height);
		</script>
	</body>
</html>
