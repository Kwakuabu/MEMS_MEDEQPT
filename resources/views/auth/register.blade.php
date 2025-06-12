<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(to right, #1a1a2e, #162447);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background: #121212; /* Dark background */
            padding: 40px;
            border-radius: 15px;
            width: 400px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        .form-container h2 {
            color: #ffffff;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #e0e0e0;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            background: #222;
            border: 2px solid #3a506b;
            border-radius: 8px;
            color: #ffffff;
            font-size: 14px;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #007bff;
            outline: none;
        }

        .form-actions {
            text-align: center;
            margin-top: 20px;
        }

        .form-actions a {
            color: #e0e0e0;
            text-decoration: none;
            font-size: 14px;
            margin-right: 15px;
        }

        .form-actions a:hover {
            color: #007bff;
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: #ff4c4c;
            font-size: 0.9rem;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Register</h2>
        <form method="POST" action="{{ route('register') }}">
            <!-- CSRF Token -->
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" required autofocus>
                <div class="error-message">@error('name') {{ $message }} @enderror</div>
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" required>
                <div class="error-message">@error('email') {{ $message }} @enderror</div>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
                <div class="error-message">@error('password') {{ $message }} @enderror</div>
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
                <div class="error-message">@error('password_confirmation') {{ $message }} @enderror</div>
            </div>

            <!-- Department -->
            <div class="form-group">
                <label for="department_id">Department</label>
                <select id="department_id" name="department_id" required>
                    <option value="">Select a Department</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
                <div class="error-message">@error('department_id') {{ $message }} @enderror</div>
            </div>

            <!-- Role -->
            <div class="form-group">
                <label for="role_id">Role</label>
                <select id="role_id" name="role_id" required>
                    <option value="">Select a Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                <div class="error-message">@error('role_id') {{ $message }} @enderror</div>
            </div>

            <!-- Already Registered Link -->
            <div class="form-actions">
                <a href="{{ route('login') }}">Already registered?</a>
                <button type="submit" class="btn">Register</button>
            </div>
        </form>
    </div>
</body>
</html>
