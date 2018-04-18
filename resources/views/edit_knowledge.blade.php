<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.bootcss.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet">
    @include('vendor.ueditor.assets')
    <title>创建知识点</title>
    <style>
        form label {
            display: block;
        }
    </style>
</head>
<body>
<form action="{{route('edit_knowledge')}}" method="post" enctype="application/x-www-form-urlencoded" class="form-group">
    <input type="hidden" name="id" value="{{$knowledge->id}}">
    <label for="">
        知识点标题:
        <input type="text" name="title" value="{{$knowledge->title}}" required class="form-control">
    </label>
    <label for="">
        知识分类:
        <select name="type" value="{{$knowledge->type}}" class="form-control">
            <option value="0">普通知识</option>
            <option value="1">高阶知识</option>
        </select>
    </label>
    <label for="">
        这个知识点是第几页 ( 根节点随便填 ):
        <input type="number" name="page" value="{{$knowledge->page}}" required class="form-control">
    </label>
    <label for="">
        父级知识点:
        <select name="parent" value="{{$knowledge->parent}}" class="form-control">
            <option value="0">根知识</option>
            @foreach($root_knowledges as $item)
                <option value="{{$item->id}}">{{$item->title}}</option>
            @endforeach
        </select>
    </label>
    {{csrf_field()}}
    <script id="container" name="content" type="text/html"></script>
    <input type="submit" class="btn btn-primary" value="提交">
</form>
<!-- 编辑器容器 -->
</body>
<script type="text/javascript">"use strict";

  var ue = UE.getEditor('container');
  ue.ready(function () {
    ue.setContent('{!! $knowledge->content !!}')
  })
</script>
</html>
