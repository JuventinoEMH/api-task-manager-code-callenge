<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

<header class="header">
    <div class="container">
        <h1 class="header-title">Dashboard</h1>
        <div class="header-links">
            <a href="/create" id="createProject" class="button create-project">
                Create Project
            </a>
            <a href="#" id="logout" class="button logout">
                Logout
            </a>
        </div>
    </div>
</header>

<div class="container">
    <h2 class="projects-title">Projects:</h2>

    <div id="projectsList" class="card-container">
    </div>
</div>

<script>
    const token = localStorage.getItem('token');

    if (!token) {
       window.location.href = '/';
    } else {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
        axios.defaults.headers.common['Accept'] = 'application/json';
        axios.defaults.headers.common['Content-Type'] = 'application/json';

        axios.get('/api/projects')
            .then(response => {
                const projects = response.data;
                const projectsList = document.getElementById('projectsList');
                projectsList.innerHTML = '';

                projects.forEach(project => {
                    const user = project.users ? project.users[0] : null;
                    const projectCard = document.createElement('div');
                    projectCard.classList.add('card');

                    const projectInfo = `
                <h2>${project.title}</h2>
                <p><strong>Project ID:</strong> ${project.id}</p>
                <p><strong>Description:</strong> ${project.description}</p>
                <p><strong>Deadline:</strong> ${project.deadline}</p>
                <p><strong>User ID:</strong> ${project.user_id}</p>
                <div class="card-footer">
                    <a href="/crud" class="card-footer-link">  Task report </a>
                </div>
                    `;
                    projectCard.innerHTML = projectInfo;
                    projectsList.appendChild(projectCard);
                });
            })
            .catch(error => {
                console.error('Error fetching projects:', error);
                alert('There was a problem retrieving the projects.');
            });
    }

    document.getElementById('logout').addEventListener('click', function (event) {
        event.preventDefault();
        axios.post('/api/logout')
            .then(response => {

                localStorage.removeItem('token');
               window.location.href = '/';
            })
            .catch(error => {
                console.error('Error logging out:', error);
                alert('There was an error logging out.');
            });
    });
</script>

</body>
</html>
