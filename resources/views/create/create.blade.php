<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a New Task</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
</head>
<body>

<header class="header">
    <div class="header-container">
        <a href="/dashboard" class="back-button">← Back</a>
        <h1 class="header-title">Create a New Project</h1>
    </div>
</header>

<div class="container">
    <form id="createTaskForm" class="form-container">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" placeholder="Enter project title" required maxlength="255">

        <label for="description">Description</label>
        <textarea id="description" name="description" placeholder="Describe the project" required maxlength="500"></textarea>

        <label for="deadline">Deadline</label>
        <input type="text" id="deadline" name="deadline" pattern="\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}" placeholder="YYYY-MM-DD HH:MM:SS" required>


        <button type="submit" class="button create-task">Create Task</button>
    </form>
</div>

<script>
    const token = localStorage.getItem('token');
    //console.log('Token:', token);
    if (!token) {
        alert('You are not authenticated. Redirecting to login...');
        window.location.href = '/login';
    }
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
    axios.defaults.headers.common['Accept'] = 'application/json';
    axios.defaults.headers.common['Content-Type'] = 'application/json';

    document.getElementById('createTaskForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const title = document.getElementById('title').value.trim();
        const description = document.getElementById('description').value.trim();
        let deadline = document.getElementById('deadline').value;




        if (title.length === 0 || description.length === 0) {
            alert("Title and Description cannot be empty.");
            return;
        }

        axios.post('/api/projects', {
            title: title,
            description: description,
            deadline: deadline
        })
            .then(response => {
                window.location.href = '/dashboard';
            })
            .catch(error => {
                console.error('Error creating task:', error);
                alert('There was a problem creating the task. Please check the fields.');
            });
    });
</script>

</body>
</html>
