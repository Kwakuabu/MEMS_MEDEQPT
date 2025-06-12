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

        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 2rem;
            display: flex;
            flex-direction: column;
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
            margin-left: 20px;
        }

        /* Flex Container for Dashboard */
        .dashboard-container {
            display: flex;
            height: 100vh;
            width: 100%;
        }

        /* Form Group Styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: var(--text200);
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--gray200);
            border-radius: 0.25rem;
            font-size: 1rem;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-group button {
            background: var(--primary200);
            color: var(--white);
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.25rem;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
        }

        .form-group button:hover {
            background: var(--color3);
        }
    </style>
    <title>Report Fault - Clinician Dashboard</title>
</head>
<body>

    <!-- Dashboard Layout -->
    <div class="dashboard-container">
        <nav class="sidebar">
            <h1>Clinician's Dashboard</h1>
            <ul>
                <li><a href="{{ route('clinician.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('clinician.inventory') }}">Inventory</a></li>
                <li><a href="{{ route('clinician.faultreporting') }}">Report Fault</a></li>
                <li><a href="{{ route('clinician.faulthistory') }}">Fault History</a></li>
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

        <div class="main-content">
            <div class="header">
                <h2 class="welcome-message">Welcome, {{ Auth::user()->name }}</h2>
            </div>

            <hr>

            <!-- Fault Reporting Form -->
            <div class="card">
                <h2>Report Fault</h2>
                <form action="{{ route('clinician.faultreporting.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="equipment_id">Select Equipment</label>
                        <select id="equipment_id" name="equipment_id" required>
                            <option value="" disabled selected>Select equipment</option>
                            @foreach($equipment as $item)
                                <option value="{{ $item->id }}">{{ $item->machine_description }} ({{ $item->serial_number }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fault_description">Fault Description</label>
                        <textarea id="fault_description" name="fault_description" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="notes">Additional Notes</label>
                        <textarea id="notes" name="notes"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit">Submit Fault Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
