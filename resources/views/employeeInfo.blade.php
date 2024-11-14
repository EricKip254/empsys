<!-- resources/views/employees/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
</head>
<body>
    <div class="card">
        <h1>Employee Details</h1>
        <p><strong>First Name:</strong> {{ $employee->first_name }}</p>
        <p><strong>Last Name:</strong> {{ $employee->last_name }}</p>
        <p><strong>Email:</strong> {{ $employee->email }}</p>
        <!-- Add other fields as needed -->
        <a href="{{ route('employees.index') }}">Back to Employee List</a>
    </div>
</body>
</html>
