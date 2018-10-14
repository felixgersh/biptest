<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Members analytics</title>

    <style type="text/css">
    body {
        background-color: #fff;
        margin: 20px;
        font: 13px/20px normal Helvetica, Arial, sans-serif;
        color: #4F5155;
    }

    a {
        color: #003399;
        background-color: transparent;
        font-weight: normal;
    }

    h1 {
        color: #444;
        background-color: transparent;
        border-bottom: 1px solid #D0D0D0;
        font-size: 19px;
        font-weight: normal;
        margin: 0 0 14px 0;
        padding: 14px 15px 10px 15px;
    }

    #body {
        margin: 0 15px 0 15px;
    }

    #container {
        margin: 10px;
        border: 1px solid #D0D0D0;
        box-shadow: 0 0 8px #D0D0D0;
    }
    </style>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" charset="utf8" src="scripts/main.js"></script>
</head>
<body>

<div id="container">
    <h1>Welcome to Members analytics!</h1>

    <div id="body">
        <table>
            <tr>
                <td><div id="pie_chart" style="width: 550px; height: 400px;"></div>
                </td>
                <td><div id="column_chart" style="width: 500px; height: 400px;"></div>
                </td>
            </tr>
        </table>
        <p></p>
        <table id="members_table" class="display" style="visibility: hidden">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>First name</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Joined date</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>First name</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
</body>
</html>
