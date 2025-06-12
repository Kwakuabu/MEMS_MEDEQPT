<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Departments</title>
    @include('layouts.head')
</head>
<body>
    <div class="dashboard-container">
        @include('layouts.sidebar')

        <div class="main-content">
            <div class="header">
                <h2>Manage Departments</h2>
            </div>

            <hr>

            <div class="card">
                <h2>Department List</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departments as $department)
                            <tr>
                                <td>{{ $department->name }}</td>
                                <td>
                                    <a href="{{ route('edit.department', $department->id) }}">Edit</a>
                                    <a href="{{ route('delete.department', $department->id) }}" 
                                       onclick="return confirm('Are you sure you want to delete this department?');">
                                       Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card">
                <h2>Assign User to Department</h2>
                <form action="{{ route('incharge.assign_department') }}" method="POST">
                    @csrf
                    <label for="user_id">User:</label>
                    <select name="user_id" id="user_id">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>

                    <label for="department_id">Department:</label>
                    <select name="department_id" id="department_id">
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>

                    <button type="submit">Assign</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
