<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulário - Assembleia</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" rel="stylesheet" />

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background-color: #1d352c;
            color: #fff;
        }

        .form-control,
        .form-select {
            background-color: #fff;
            color: #000;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-warning {
            color: #000;
        }

        .title {
            font-size: 1.5rem;
            text-align: center;
            font-weight: bold;
            margin: 20px 0;
        }
    </style>
    
</head>

<body>

    <div class="container py-4">

        @yield('content')
        <script src="../js/jquery.min.js"></script>
        <script src="../js/popper.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/jquery.validate.min.js"></script>
        <script src="../js/jquery-mask.min.js"></script>
        <script src="../js/sweetalert-2.min.js"></script>
        <script src="../js/main.js"></script>
	</body>
</html>