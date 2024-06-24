<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Player</title>
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cutive&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Preahvihear&family=Roboto+Slab:wght@300&family=Vollkorn:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <!-- end google font -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        html, body, .h-100 {
            height: 100%;
            overflow-x: hidden;
        }
        body {
            padding-top: 80px;
        }
        .logo {
            background: blue;
        }
        .sidebar {
            background-color: #5a96bf;
            position: fixed;
            top: 80px;
            bottom: 0;
            width: 16.66667%;
            padding-top: 20px;
            transition: width 0.4s;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .sidebar.onoff {
            width: 9%;
        }
        .list-group-item {
            background-color: #5a96bf;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .sidebarlogo {
            margin-right: 10px;
        }
        .navbarColor {
            background-color: #365a72;
        }
        .navbtnColor {
            background-color: #203644;
        }
        .lonoff {
            display: none;
        }
        .sidebar.onoff .lonoff {
            display: inline;
        }
        .sidebar.onoff .side-list label {
            display: none;
        }
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }
        .switch input { 
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }
        input:checked + .slider {
            background-color: #2196F3;
        }
        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }
        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }
        .slider.round {
            border-radius: 34px;
        }
        .slider.round:before {
            border-radius: 50%;
        }
        .dark-mode {
            background-color: #2e2e2e;
            color: white;
        }
        .dark-mode .navbar {
            background-color: #1c1c1c;
        }
        .dark-mode .sidebar {
            background-color: #3a3a3a;
        }
        .dark-mode .list-group-item {
            background-color: #1c1c1c;
        }
        .dark-mode .dkcolor{
            background-color: #2e2e2e;
            color: #ccc;
        }
        .dark-mode .dktable{
            background-color: #2e2e2e;
        }
        .dark-mode .dktable th,
        .dark-mode .dktable td{
            background-color: #2e2e2e;
            color: white;
        }
        .content {
            transition: margin-left 0.4s;
        }
        .content.shifted {
            margin-left: 9%;
        }
        .dark-mode .list-group-item {
            background-color: #1c1c1c;
        }
    </style>
</head>

<body class="h-100">
    <div class="col-md-12">
        <nav class="navbar fixed-top navbarColor" style="height: 80px;">
            <div class="container-fluid">
                <a class="navbar-brand fs-2 text-white"><i class="bi bi-music-note-list me-3"></i>Music Player</a>
                <!-- <form class="d-flex" role="search" onsubmit="search(event)">
                    <i class="bi bi-search me-2 fs-2 text-white"></i>
                    <input class="form-control mx-2" type="search" placeholder="Search" aria-label="Search" id="searchInput">
                    <button class="btn btn-outline-success text-white navbtnColor" type="submit">Search</button>
                </form> -->
                <form class="d-flex justify-content-center align-items-center" role="search">
                    <label for="darkModeSwitch" class="daynight"><i id="darkModeIcon" class="fa-solid fa-sun fs-3"></i></label>
                    <label class="switch">
                        <input type="checkbox" onclick="darkmode()" id="darkModeSwitch">
                        <span class="slider round"></span>
                    </label>
                </form>
            </div>
        </nav>
    </div>

    <div class="row h-100">        
        <div class="col-md-2 d-flex flex-column sidebar" id="sidebar">
            <div class="max-w-0 h-100">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item list-group-item-action p-3 side-list">
                        <a class="text-white px-3" onclick="toggle()">
                            <i class="fa fa-bars sidebarlogo" aria-hidden="true"></i>
                            <label class="sidebar-logo" for="" id="">Menu</label>
                        </a>
                    </li>
                    <li class="list-group-item list-group-item-action p-3 side-list">
                        <a href="../admin/artists.php" class="text-white px-3">
                            <i class="fa-solid fa-microphone sidebarlogo"></i>
                            <label class="sidebar-logo" for="" id="">Artists</label>
                        </a>
                    </li>
                    <li class="list-group-item list-group-item-action p-3 side-list">
                        <a href="../admin/albums.php" class="text-white px-3">
                            <i class="fa fa-folder sidebarlogo" aria-hidden="true"></i>
                            <label class="sidebar-logo" for="" id="">Albums</label>
                        </a>
                    </li>
                    <li class="list-group-item list-group-item-action p-3 side-list">
                        <a href="../admin/tracks.php" class="text-white px-3 ">
                            <i class="fa-solid fa-compact-disc sidebarlogo"></i>
                            <label class="sidebar-logo" for="" id="">Tracks</label>
                        </a>
                    </li>
                    <li class="list-group-item list-group-item-action p-3 side-list">
                        <a href="../admin/types.php" class="text-white px-3">
                            <i class="fa-solid fa-icons sidebarlogo"></i>
                            <label class="sidebar-logo" for="" id="">Type</label>
                        </a>
                    </li>
                    <div class="d-grid gap-2 col-6 mx-auto"></div>
                </ul>
            </div>
        </div>
        <div class="content col-md-10 offset-md-2" id="content">
            <div class="col-md-12">