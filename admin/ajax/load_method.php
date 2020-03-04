<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">

    <title>AJAX</title>
</head>
    <body>
        <div class="container">
            <div id="load_data"><h2>This is going to be change</h2></div>
            <button class="btn btn-success" id="btn_click">Click on it</button>
        </div>

        <script type="text/javascript">

            $(document).ready(function(){
                $('#btn_click').click(function(){
                    $('#load_data').load('load.html', function(){
                        alert("data loadded from server");
                    });
                })
            });

        </script>
    </body>
</html>
