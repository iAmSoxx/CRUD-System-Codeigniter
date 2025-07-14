<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="card shadow">
            <div class="card-header text-center bg-primary text-white">
                <h4>Login</h4>
            </div>
            <div class="card-body">
                <form method="post" action="<?php echo base_url('auth/login'); ?>">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required />
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>

                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger mt-3 mb-0">
                            <?= $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>