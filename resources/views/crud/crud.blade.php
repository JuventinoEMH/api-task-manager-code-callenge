<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects and Tasks</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>

<header class="header">
    <div class="container">
        <h1 class="header-title">Projects and Tasks</h1>
        <div class="header-links">
            <a href="/projects" class="button">Back to Dashboard</a>
        </div>
    </div>
</header>

<div class="container">
    <h2>Project Stats</h2>

    <div id="projectStats">
    </div>
</div>

<script>
    const token = localStorage.getItem('token');

    if (!token) {
        alert('You are not authenticated. Redirecting to login...');
        window.location.href = '/login';
    } else {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
        axios.defaults.headers.common['Accept'] = 'application/json';
        axios.defaults.headers.common['Content-Type'] = 'application/json';

        axios.get(`/api/projects/1/stats`)
            .then(response => {
                if (response.data) {
                    const stats = response.data;

                    let projectStats = `
                        <p><strong>Total Tasks:</strong> ${stats.total_tasks}</p>
                        <p><strong>Completed Tasks:</strong> ${stats.completed_tasks}</p>
                        <p><strong>Overdue Tasks:</strong> ${stats.overdue_tasks}</p>
                    `;

                    document.getElementById('projectStats').innerHTML = projectStats;
                } else {
                    console.error('Error: Invalid response format', response.data);
                    alert('There was an issue with the API response. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error fetching project stats:', error);
                alert('There was an error retrieving the project stats.');
            });
    }
</script>

</body>
</html>
