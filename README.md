>[!IMPORTANT]
> # How to set up this project.
> 
> Clone the repository in your folder with this command.
> 
> **git clone** https://github.com/JuventinoEMH/api-task-manager-code-callenge.git
 
 inside your folder run **composer install** 
 
 copy the .env.example and paste it by changing the name to **.env**

 to generate the APP_KEY run **php artisan key:generate** 
 
 make the migrations with **php artisan migrate** and the run **php artisan db::seed** to seed the database
 
in the output console you have the credentials.

>[!IMPORTANT]
> 
> Credentials:
> 
> User created with the following credentials:
>Email: admin@example.com
>Passwodr: password123

Run the server with **php artisan serve** and click on
### http://localhost:8000


# ENDPOINTS 


POST	/api/register	Register a user

POST	/api/login	Log in

GET	/api/projects	List projects

POST	/api/projects	Create a project

PUT	/api/projects/{id}	Update a project

DELETE	/api/projects/{id}	Delete a project

GET	/api/projects/{id}/tasks	List tasks in a project

POST	/api/projects/{id}/tasks	Create a task in a project

PUT	/api/tasks/{id}	Update a task

DELETE	/api/tasks/{id}	Delete a task

GET	/api/projects/{id}/stats	Get project statistics



>[!TIP]
> I decided to separate the logic from the controllers a bit to work with different Laravel functionalities 
> and make the code sections more modular. 
> I created some policies to allow creating or deleting projects 
> and implemented methods like FormRequest for the update and destroy methods  think this was a good 
> decision since it ensures that the user making the request has the proper permissions to perform the action.
> I used database relationships to maintain consistency between tables. 
> I structured the project according to the client’s needs, ensuring its integrity and security.
> I learned many things, and it was a great experience to improve my skills.

