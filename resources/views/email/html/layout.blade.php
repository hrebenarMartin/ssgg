<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Email from SSGG</title>

    <style>
        h1{
            text-align: center;
        }

        .head_img{
            text-align: center;
        }

    </style>
</head>
<body>
<main>
    <div class="head_img">
        <img src="{!! $message->embed(url('images/logo.png')) !!}">
    </div>
    {{--<hr>
    <p>Data: {{array_key_exists('testData', $content) ? $content["testData"] : "null"}}</p>
    <p>Contribution author: {{array_key_exists("contribution_author",$content) ? $content["contribution_author"] : "null"}}</p>
    <p>Reviewer: {{array_key_exists("reviewer",$content) ? $content["reviewer"] : "null"}}</p>
    <p>Review assined by: {{array_key_exists("review_assigned_by",$content) ? $content["review_assigned_by"] : "null"}}</p>
    <hr>--}}
    @yield('content')
    <br>
    <p>Tím SSGG</p>
</main>
<footer>
    <small class="footer_text">Copyright 2019 - Martin Hrebeňár/SSGG</small>
</footer>
</body>
</html>
