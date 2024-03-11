<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome Page</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <style>
            body {
                background-color: #f8f9fa;
            }
            
            .container {
                margin-top: 100px;
            }
            
            .card {
                border: 1px solid #dcdcdc;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            
            .card-header {
                background-color: #007bff;
                color: white;
            font-weight: bold;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            font-weight: bold;
        }
        
        input.form-control {
            border-radius: 5px;
        }
        
        button.btn-primary {
            background-color: #007bff;
            border: 1px solid #007bff;
        }
        
        button.btn-primary:hover {
            background-color: #0056b3;
            border: 1px solid #0056b3;
        }
        
        .invalid-feedback {
            display: block;
            margin-top: 5px;
            color: #dc3545;
        }
        
        .welcome-message {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #28a745;
        }
        </style>
</head>
<body>

@if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Welcome') }}</div>

                <div class="card-body">
                    @if(session()->has('token'))
                        <p class="welcome-message">Welcome User: {{ $user->name }}</p>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
