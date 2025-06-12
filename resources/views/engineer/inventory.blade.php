<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Global Styles */
        :root {
            --mainBG: #f0f4f8;
            --text200: #333333;
            --gray200: #e0e0e0;
            --primary200: #4299e1;
            --darkGray: #2d3748;
            --sidebarHover: #4a5568;
            --color1: #FF6F61;
            --color2: #6B5B93;
            --color3: #88B04B;
            --color4: #F7CAC9;
            --color5: #92A8D1;
            --white: #ffffff;
            --cardShadow: rgba(0, 0, 0, 0.1);
        }

        html {
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen,
                Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-size: 14px;
        }

        * {
            box-sizing: inherit;
            margin: 0;
            padding: 0;
        }

        body {
            background: var(--mainBG);
            min-height: 100vh;
            width: 100%;
            color: var(--text200);
            display: flex;
        }

        h1, h2, h3, h4, h5, h6 {
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
            position: fixed;
            background: linear-gradient(135deg, var(--color1), var(--color2));
            color: white;
            width: 250px;
            height: 100vh;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            top: 0;
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
            background: var(--color3);
            transition: background 0.3s, color 0.3s;
        }

        .sidebar a:hover {
            background: var(--sidebarHover);
            color: var(--white);
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 2rem;
            padding-left: 270px;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            max-height: 100vh;
        }

        .card {
            background: var(--white);
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 20px var(--cardShadow);
            margin-top: -60px;
            margin-bottom: 10px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
        }

        .welcome-message {
            margin-left: 20px;
        }

        .dashboard-container {
            display: flex;
            width: 100%;
        }

        .add-button {
            background: var(--primary200);
            color: var(--white);
            border: none;
            border-radius: 0.25rem;
            padding: 0.75rem 1.5rem;
            cursor: pointer;
            margin-bottom: 1rem;
            transition: background 0.3s;
            display: block;
            width: 100%;
        }

        .add-button:hover {
            background: #3182ce;
        }

        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 0.25rem;
            color: #fff;
        }

        .alert-danger {
            background-color: #e53e3e;
        }

        .alert-success {
            background-color: #38a169;
        }

        .dropdown {
            display: none;
            padding: 1rem;
            border: 1px solid var(--gray200);
            border-radius: 0.5rem;
            background-color: var(--white);
            box-shadow: 0 4px 10px var(--cardShadow);
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid var(--gray200);
            border-radius: 0.25rem;
            font-size: 14px;
        }

        .form-group input:focus {
            border-color: var(--primary200);
            outline: none;
            box-shadow: 0 0 5px rgba(66, 153, 225, 0.5);
        }

        table {
            width: 100%;
            margin-top: 1rem;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid var(--gray200);
            padding: 0.5rem;
            text-align: left;
        }

        th {
            background: var(--primary200);
            color: var(--white);
        }

        td {
            background: var(--white);
        }

        .remove-btn {
    padding: 8px 16px;
    font-size: 14px;
    background-color: #ff4d4d;
    color: white;
    border: none;
    border-radius: 0.5rem;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.3s;
    text-align: center;
}

.remove-btn:hover {
    background-color: #e60000;
    transform: scale(1.05);
}

.remove-btn:active {
    background-color: #b30000;
    transform: scale(0.95);
}

        
    </style>
    <title>Engineer Inventory</title>
</head>
<body>

    <div class="dashboard-container">
        <nav class="sidebar">
            <h1>Engineer's Dashboard</h1>
            <ul>
                <li><a href="{{ route('engineer.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('engineer.inventory') }}">Inventory</a></li>
                <li><a href="{{ route('engineer.work_orders') }}">Work Orders</a></li>
                <li><a href="{{ route('engineer.reports') }}">Reports</a></li>
                <li>
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); 
                                document.getElementById('logout-form').submit();">
                       Logout
                    </a>
                </li>
            </ul>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>

        <div class="main-content">
            <div class="header">
                <h2 class="welcome-message">Welcome, {{ Auth::user()->name }}</h2>
            </div>

            <hr>

            <div class="card">
                <button class="add-button" id="toggle-form">Add New Equipment</button>
                <h2>Equipment in Your Department</h2>

                <!-- Dropdown Form -->
                <div class="dropdown" id="equipment-form" style="display: none;">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('engineer.add_equipment') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="machine_description">Machine Description</label>
                            <input type="text" id="machine_description" name="machine_description" required>
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" id="quantity" name="quantity" required>
                        </div>

                        <div class="form-group">
                            <label for="brand_name">Brand Name</label>
                            <input type="text" id="brand_name" name="brand_name" required>
                        </div>

                        <div class="form-group">
                            <label for="model">Model</label>
                            <input type="text" id="model" name="model" required>
                        </div>

                        <div class="form-group">
                            <label for="serial_number">Serial Number</label>
                            <input type="text" id="serial_number" name="serial_number" required>
                        </div>

                        <button type="submit" class="add-button">Add Equipment</button>
                    </form>
                </div>

                <!-- Equipment List as a Table -->
                <table>
                    <thead>
                        <tr>
                            <th>Machine Description</th>
                            <th>Quantity</th>
                            <th>Brand Name</th>
                            <th>Model</th>
                            <th>Serial Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($equipment as $item)
                            <tr>
                                <td>{{ $item->machine_description }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->brand_name }}</td>
                                <td>{{ $item->model }}</td>
                                <td>{{ $item->serial_number }}</td>
                                <td>
                                    <form action="{{ route('engineer.delete_equipment', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="remove-btn">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Toggle equipment form visibility
        document.getElementById('toggle-form').addEventListener('click', function() {
            const form = document.getElementById('equipment-form');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        });
    </script>
</body>
</html>
