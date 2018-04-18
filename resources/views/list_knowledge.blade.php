<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://cdn.bootcss.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<ul>
    @foreach(\App\Knowledge::where('parent', null)->get() as $item)
        <li><a href="/knowledge/edit?id={{$item->id}}">{{$item->title}}</a>
        <ul>
            @foreach(\App\Knowledge::where('parent', $item->id)->orderBy('page')->get() as $child)
                <li><a href="/knowledge/edit?id={{$child->id}}">{{$child->page}} . {{$child->title}}</a>
            @endforeach
        </ul>
        </li>
    @endforeach
</ul>
</body>
</html>
