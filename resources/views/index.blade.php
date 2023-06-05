<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-vue/2.21.2/bootstrap-vue.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-vue/2.21.2/bootstrap-vue.min.css">
    {{-- tif --}}
    
    <script src="https://cdn.rawgit.com/seikichi/tiff.js/master/tiff.min.js"></script>
    <script src="https://cdn.rawgit.com/rfvallina/Misc/master/pdf.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    
    {{-- sosmed open graph --}}

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{$meta['url']}}">
    <meta property="og:title" content="{{$meta['title']}}">
    <meta property="og:description" content="{{$meta['description']}}">
    <meta property="og:image" content="{{$meta['image']}}">
{{-- sweet alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.10/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.10/dist/sweetalert2.min.css">
</head>

<body>
    {{-- <h1 class="text-center">{{$meta['url']}}</h1>
    <h1 class="text-center">{{$meta['title']}}</h1>
    <img class="text-center" src="{{$meta['image']}}" width="50" alt=""> --}}
    <div id="app">
         <app></app>
    </div>
    
    <script src="/js/app.js"></script>
</body>
</html>

