<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
       /* Global Styles */
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
            position: fixed; /* Fixed position */
            background: linear-gradient(135deg, var(--color1), var(--color2));
            color: white;
            width: 250px;
            height: 100vh;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            top: 0; /* Align to the top */
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
            padding-left: 270px; /* Adjusted for sidebar width */
            display: flex;
            flex-direction: column;
            overflow-y: auto; /* Enable vertical scrolling */
            max-height: 100vh; /* Ensure it doesn't exceed viewport height */
        }

        /* Card Styles */
        .card {
            background: var(--white);
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 20px var(--cardShadow);
            margin-top: -60px;
            margin-bottom: 10px; /* Added margin to space out from the bottom */
        }

        /* Flex Container for Header */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
        }

        .welcome-message {
            margin-left: 20px; /* Space between sidebar and welcome message */
        }

        /* Flex Container for Dashboard */
        .dashboard-container {
            display: flex; /* Ensure flexbox layout */
            width: 100%; /* Full width of the viewport */
        }

        /* Button Style */
        .add-button {
            background: var(--primary200);
            color: var(--white);
            border: none;
            border-radius: 0.25rem;
            padding: 0.75rem 1.5rem;
            cursor: pointer;
            margin-bottom: 1rem;
            transition: background 0.3s;
            display: block; /* Ensures it's a block element */
            width: 100%; /* Full width for button */
        }

        .add-button:hover {
            background: #3182ce; /* A slightly darker shade for hover */
        }

        /* Alert Styles */
        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 0.25rem;
            color: #fff;
        }

        .alert-danger {
            background-color: #e53e3e; /* Red for errors */
        }

        .alert-success {
            background-color: #38a169; /* Green for success */
        }

        /* Dropdown Form Styles */
        .dropdown {
            display: none; /* Initially hidden */
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
            outline: none; /* Remove default outline */
            box-shadow: 0 0 5px rgba(66, 153, 225, 0.5); /* Subtle shadow for focus */
        }

        /* Table Styles */
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
        /* Button Styles */
        .action-button,
.deny-button {
    background: var(--primary200);
    color: var(--white);
    border: none;
    border-radius: 0.5rem; /* Rounded corners for buttons */
    padding: 0.5rem 1rem; /* Same padding for both buttons */
    cursor: pointer;
    transition: background 0.3s;
    margin: 0 0.5rem;
    font-size: 0.9rem; /* Slightly smaller font for buttons */
    width: 120px; /* Set a fixed width for both buttons */
}

/* Hover effects for both buttons */
.action-button:hover {
    background: #3182ce;
}

.deny-button {
    background: #e53e3e; /* Red for deny */
}

.deny-button:hover {
    background: #c53030; /* Darker red for hover */
}


    </style>
    <title>Engineer Work Orders</title>
</head>
<body>

    <!-- Dashboard Layout -->
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
                <h2>Work Orders in Your Department</h2>

                <!-- Alert Messages -->
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

                <!-- Work Orders Table -->
                <table>
                    <thead>
                        <tr>
                            <th>Fault Report ID</th>
                            <th>Serial Number</th> <!-- New Column for Serial Number -->
                            <th>Status</th> <!-- Status Column -->
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($workOrders->isEmpty())
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 1rem;">No work orders found in your department.</td>
                            </tr>
                        @else
                            @foreach($workOrders as $order)
                                <tr>
                                    <td>{{ $order->fault_report_id }}</td>
                                    <td>{{ $order->equipment ? $order->equipment->serial_number : 'N/A' }}</td> <!-- Display Serial Number -->
                                    <td>
                                        @if($order->status === 'approved') 
                                            {{ ucfirst($order->status) }} 
                                        @else
                                            <span>Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('engineer.work_orders.approve', $order->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="action-button">Approve</button>
                                        </form>
                                        <form action="{{ route('engineer.work_orders.deny', $order->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="deny-button">Deny</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
