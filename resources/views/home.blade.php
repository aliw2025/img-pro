<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">


</head>
<style>
    .img-prop{
        max-width: 100%;
        max-height: 100%;
        display: block; /* remove extra space below image */
    }
    .box{
        width: 450px;        
        border: 1px solid black;
    }  
</style>
<body>
    <div class="container">
        <div class="row">

            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Please attach a perform calculation</h4>
                    <form method="POST" enctype="multipart/form-data" action="{{route('upload-file')}}">
                        @csrf
                        <div class="row d-flex align-items-center">
                            <div class="col-6">
                                <label for="" class="form-label"></label>
                                <input name="file_name" type="file" class="form-control">
                            </div>
                            <div class="col-6 mt-4">
                                <button class="btn btn-primary" >Upload Image</button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
        <div class="row mt-4">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Source Image</h4>
                    </div>
                    <form method="POST" enctype="multipart/form-data" action="{{route('perform-cal')}}">
                        <div class=" box card-body">
                            @if(isset($file))
                            <img  class="img-prop" src="{{$file->file_path}}" alt="source file">
                            <input  name="file_name"  value="{{$file->name}}" >
                            @endif
                            

                        </div>
                    
                        @if(isset($file))
                    
                            <div class="col-6 mt-4">
                                @csrf
                                <button class="btn btn-primary" >Calculate</button>
                            </div>
                        
                        @endif
                    </form>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Result Image</h4>
                    </div>

                    <div class=" box card-body">
                        @if(isset($result))
                        <img  class="img-prop" src="{{$result}}" alt="source file">
                        
                        @endif
                    </div>
                    {{-- action="{{route('perform-cal')}} --}}
                   
                </div>
                
            </div>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>

</html>
