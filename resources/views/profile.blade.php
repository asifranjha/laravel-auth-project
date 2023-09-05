<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <style>
        body{
            overflow-x:hidden;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    
    <div class="container pt-5">
        <h2>
            Welcome {{ Auth::user()->first_name }}
        </h2>
        <br><br>
        <a href="{{route('logout')}}" class="btn btn-danger btn-sm">Logout</a>
    </div>
    <br>

    <div class="d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-end">
                        <div class="col-md-4">
                            <input type="text" class="form-control" onkeyUp="searchUsers(this.value)" />
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover" id="usersTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Email Verified?</th>
                                <th>Registered On</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($users) > 0)
                            @foreach($users as $obj)
                                <tr>
                                    <td>
                                        {{$obj->first_name}} {{$obj->last_name}}
                                    </td>
                                    <td>{{ $obj->email }}</td>
                                    <td>
                                        @if($obj->email_verified_at == null)
                                            No
                                        @else
                                            Yes
                                        @endif
                                    </td>
                                    <td>
                                        {{ $obj->created_at }}
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody> 
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
    function searchUsers(value)
    {
       $.ajax({
            url: '/users/search',
            type: 'POST',
            data: {
                _token: '{{csrf_token()}}',
                value: value
            },
            success: function(res)
            {
                if(res.length > 0)
                {
                    var html = "";
                    res.forEach(obj => {
                        html += "<tr>";
                        html += "<td>"+obj.first_name+" "+obj.last_name+"</td>";
                        html += "<td>"+obj.email+"</td>";
                        if(obj.email_verified_at == null)
                        {
                            html += "<td>No</td>";
                        }else{
                            html += "<td>Yes</td>";
                        }

                        html += "<td>"+obj.created_at+"</td>";
                        html += "</tr>";
                    });
                  
                    $("#usersTable tbody").html(html);
                }
            }
       });
    }
</script>

</body>
</html>