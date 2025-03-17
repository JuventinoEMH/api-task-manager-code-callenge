<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/projects.css') }}">
</head>
<body class="bg-gray-100 font-sans">

<header class="bg-blue-600 text-white p-6 mb-12">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-bold">Project Management</h1>

        <nav class="space-x-6">
            <a href="/resgister" class="inline-block px-8 py-3 bg-white text-blue-600 font-semibold rounded-full shadow-lg border-2 border-blue-600 hover:bg-blue-600 hover:text-white hover:border-blue-600 transform transition-all duration-300 ease-in-out hover:scale-105">
                Register
            </a>

            <a href="/login" class="inline-block px-8 py-3 bg-white text-blue-600 font-semibold rounded-full shadow-lg border-2 border-blue-600 hover:bg-blue-600 hover:text-white hover:border-blue-600 transform transition-all duration-300 ease-in-out hover:scale-105">
                Login
            </a>
        </nav>
    </div>
</header>

<div class="container mx-auto p-8">
    <h2 class="text-4xl font-extrabold text-center text-blue-600 mb-12">Project List</h2>

    <div id="projects-list" class="card-container">
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    axios.get('/api/projects')
        .then(function (response) {
            let projectsList = document.getElementById('projects-list');
            let projects = response.data;

            if (projects.length > 0) {
                let html = '';
                projects.forEach(project => {
                    html += `
                        <div class="card">
                            <h2>Project: ${project.title}</h2>
                            <p><strong>Project ID:</strong> ${project.id}</p>
                            <p><strong>Description:</strong> ${project.description}</p>
                            <p><strong>Deadline:</strong> ${project.deadline}</p>
                            <p><strong>User ID:</strong> ${project.user_id}</p>
                            <div class="card-footer">

                            </div>
                        </div>
                    `;
                });
                projectsList.innerHTML = html;
            } else {
                projectsList.innerHTML = '<p class="text-gray-500 text-center">No available projects.</p>';
            }
        })
        .catch(function (error) {
            console.error('Error fetching projects:', error);
        });
</script>

</body>
</html>
