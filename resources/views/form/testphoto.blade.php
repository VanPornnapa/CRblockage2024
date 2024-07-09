<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>Upload Multiple Images</h4>
                            </div>
             
                            <div class="panel-body">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        Please correct following errors:
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="file" name="image[]" class="form-control-file" multiple="true">
                                    </div>
             
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
             
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</body>
</html>
