<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Here</title>
    <style>
        body{
            overflow-x:hidden;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    
    <div class="col-md-12">
        <div class="row d-flex justify-content-center pt-5">
            <div class="col-md-5">
                @if(count($errors) > 0)
                @if($errors->first() == 'success')
                    <div class="alert alert-success">
                        Account created successfully!
                    </div>
                @endif
                @endif

                <form action="{{route('register')}}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3>SignUp</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label for="">First Name</label>
                                <input type="text" name="first_name" class="form-control" />
                                @error('first_name')
                                <p class="text-danger" style="font-size:14px">
                                    *{{$message}}
                                </p>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Last Name</label>
                                <input type="text" name="last_name" class="form-control" />
                                @error('last_name')
                                <p class="text-danger" style="font-size:14px">
                                    *{{$message}}
                                </p>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="">Email Address</label>
                                <input type="email" name="email" class="form-control" />
                                @error('email')
                                <p class="text-danger" style="font-size:14px">
                                    *{{$message}}
                                </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" />
                                @error('password')
                                <p class="text-danger" style="font-size:14px">
                                    *{{$message}}
                                </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>