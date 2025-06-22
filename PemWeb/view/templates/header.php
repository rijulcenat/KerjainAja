<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            padding-top: 10px;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar fixed-top navbar-light bg-white border-bottom">
        

        <div class="container d-flex justify-content-around">
                <!-- Navigasi Tab -->
                <div class="d-flex justify-content-center">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="add-tab" data-bs-toggle="tab" data-bs-target="#add-tab-pane" type="button" role="tab" aria-controls="add-tab-pane" aria-selected="true">New Post</button>
                        </li>                  
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="add-tab-pane" role="tabpanel" aria-labelledby="add-tab" tabindex="0"></div>
                        </div>
                </div>
            </div>

    </nav>
