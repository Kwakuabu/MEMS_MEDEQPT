<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rotations</title>
    <style>
        :root {
            --mainBG: #f0f4f8; /* Light gray background */
            --text200: #333333; /* Dark text */
            --gray200: #e0e0e0; /* Light gray for hr */
            --primary200: #4299e1; /* Blue */
            --darkGray: #2d3748; /* Dark gray for sidebar */
            --sidebarHover: #4a5568; /* Darker gray for sidebar hover */
            --color1: #FF6F61; /* Coral */
            --color2: #6B5B93; /* Purple */
            --color3: #88B04B; /* Green */
            --color4: #F7CAC9; /* Light Pink */
            --color5: #92A8D1; /* Light Blue */
            --white: #ffffff; /* White */
            --cardShadow: rgba(0, 0, 0, 0.1); /* Card shadow */
        }

        html {
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen,
                Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-size: 14px;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
            margin: 0;
            padding: 0;
        }

        body {
            background: var(--mainBG);
            min-height: calc(100vh - 100px);
            width: 100%;
            color: var(--text200);
            display: flex;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: var(--text200);
        }

        hr {
            background: var(--gray200);
            border: none;
            height: 1px;
            margin: 2rem 0;
        }

        a {
            text-decoration: none;
            color: var(--white);
        }

        ul {
            list-style: none;
        }

        /* Sidebar Styles */
        .sidebar {
    background: linear-gradient(135deg, var(--color1), var(--color2));
    color: white;
    width: 250px;
    height: 100vh;
    padding: 1rem;
    position: fixed; /* Make the sidebar fixed */
    top: 0;
    left: 0;
    display: flex;
    flex-direction: column;
    z-index: 1000; /* Ensures the sidebar stays on top */
}

        .sidebar h1 {
            font-size: 1.5rem;
            margin-bottom: 2rem;
        }

        .sidebar a {
            display: block;
            padding: 0.75rem 1rem;
            margin: 0.5rem 0;
            border-radius: 0.5rem;
            transition: background 0.3s, color 0.3s;
            background: var(--color3);
        }

        .sidebar a:hover {
            background: var(--sidebarHover);
            color: var(--white);
        }

        /* Main Content Styles */
        .main-content {
    flex: 1;
    padding: 2rem;
    margin-left: 250px; /* Ensure the main content doesn't overlap the sidebar */
    display: flex;
    flex-direction: column;
}

        /* Card Styles */
        .card {
            background: var(--white);
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 20px var(--cardShadow);
            transition: transform 0.2s, box-shadow 0.2s;
            margin: 1rem 0;
            margin-top: -60px; /* Move card upwards */
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px var(--cardShadow);
        }

        /* Card Title and Content Styles */
        .card h2 {
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        /* Flex Container for Header */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
        }

        /* Position the welcome message */
        .welcome-message {
            margin-left: 20px; /* Space between sidebar and welcome message */
        }

        /* Flex Container for Dashboard */
        .dashboard-container {
            display: flex; /* Ensure flexbox layout */
            height: 100vh; /* Full height of the viewport */
            width: 100%; /* Full width of the viewport */
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
            margin: 0;
            padding: 0;
        }

        body {
            background: var(--mainBG);
            min-height: 100vh;
            display: flex;
            color: var(--text200);
        }

        h2 {
            color: var(--text200);
            margin-bottom: 2rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }

        th, td {
            padding: 1rem;
            border: 1px solid var(--gray200);
            text-align: left;
        }

        th {
            background-color: var(--primary200);
            color: white;
        }

        td {
            background-color: var(--white);
        }

        button {
            padding: 0.5rem 1rem;
            background-color: var(--primary200);
            color: white;
            border: none;
            border-radius: 0.3rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #357ABD;
        }

        .sidebar {
            background: linear-gradient(135deg, var(--color1), var(--color2));
            color: white;
            width: 250px;
            height: 100vh;
            padding: 1rem;
            display: flex;
            flex-direction: column;
        }

        .sidebar h1 {
            font-size: 1.5rem;
            margin-bottom: 2rem;
        }

        .sidebar a {
            display: block;
            padding: 0.75rem 1rem;
            margin: 0.5rem 0;
            border-radius: 0.5rem;
            transition: background 0.3s, color 0.3s;
            background: var(--color3);
        }

        .sidebar a:hover {
            background: var(--sidebarHover);
            color: var(--white);
        }

        .main-content {
            flex: 1;
            padding: 2rem;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            padding-top: 50px;
        }

        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 2rem;
            border-radius: 0.5rem;
            width: 60%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h5 {
            margin: 0;
        }

        .modal-close {
            background-color: transparent;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .form-label {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .form-select {
            width: 100%;
            padding: 0.5rem;
            border-radius: 0.3rem;
            border: 1px solid var(--gray200);
            margin-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
        }

        .modal-footer button {
            padding: 0.75rem 2rem;
            background-color: var(--primary200);
            color: white;
            border: none;
            border-radius: 0.3rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .modal-footer button:hover {
            background-color: #357ABD;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <nav class="sidebar">
        <h1>In-charge Dashboard</h1>
        <ul>
            <li><a href="{{ route('incharge.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('incharge.departments') }}">Manage Departments</a></li>
            <li><a href="{{ route('incharge.manage-rotations') }}">Manage Rotations</a></li>
            <li>
                <a href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); 
                            document.getElementById('logout-form').submit();">
                   Logout
                </a>
            </li>
        </ul>

        <!-- CSRF token for logout -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <h2>Manage Rotations</h2>

        <table>
            <thead>
                <tr>
                    <th>Department Name</th>
                    <th>Members</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through departments -->
                @foreach($departments as $department)
                    <tr>
                        <td>{{ $department->name }}</td>
                        <td>
                            <ul>
                                @foreach($department->users as $user)
                                    <li>{{ $user->name }}</li> <!-- Only displaying the name -->
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <!-- Trigger Modal Button -->
                            <button onclick="openModal('rotationModal{{ $department->id }}')">
                                Update Rotation
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal for each department -->
        @foreach($departments as $department)
            <div id="rotationModal{{ $department->id }}" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Update Rotation for {{ $department->name }}</h5>
                        <button class="modal-close" onclick="closeModal('rotationModal{{ $department->id }}')">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('incharge.update-rotation', $department->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="user" class="form-label">Select Member to Rotate</label>
                                <select class="form-select" id="user" name="user_id">
                                    @foreach($department->users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option> <!-- Only displaying the name -->
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="new_department" class="form-label">Select New Department</label>
                                <select class="form-select" id="new_department" name="new_department_id">
                                    @foreach($departments as $dep)
                                        @if($dep->id != $department->id)
                                            <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="submit">Submit Rotation</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }
    </script>
</body>
</html>
