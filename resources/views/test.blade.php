<!-- resources/views/test.blade.php -->

<html>  
<head>  
    <title>Motivational — Your daily source of motivation!</title>
<!--    <link href="/css/style.css" rel="stylesheet" type="text/css"/>
    <link href='http://fonts.googleapis.com/css?family=Alegreya:400,700|Roboto+Condensed' rel='stylesheet' type='text/css'>-->
</head>  

<body>
<div class="container">  
    <div class="quote-container">
        <p class="text">Test Page</p>
        <p class="text">{{$attendee->name}}</p>
<!--        <p>
            {{ Form::open(['method' => 'DELETE', 'route' => 'items.destroy', $item->id]) }}
                {{ Form::hidden('id', $item->id) }}
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
        </p>-->
    </div>
</div>  
</body>  
</html> 