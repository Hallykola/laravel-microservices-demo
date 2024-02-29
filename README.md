# laravel-microservices-demo
Laravel microservices demo
This repository contains the code for a simple microservice system. It comprises of two services built with Laravel and RabbiMQ as the message bus. The services are containerized with their files in the user and notification folders respectively. RabbitMQ cluster from [CloudAMQP] (https://customer.cloudamqp.com/) is used for the message queuing system with the necessary configuration for the cluster included in the users and notifications services .env files.
#How to install
1.Clone the repository
```git clone https://github.com/Hallykola/laravel-microservices-demo.git```
2. Ensure you have docker running on your device. Then, 
cd into the folder and 
run docker-compose up

3. You should have 6 containers running
 a. The user service container
 b. The user service queue container
 c. The notifications service container
 d. The noifications service queue container
 e. The mysql service container for database
 f. The php-myAdmin service container for managing the database

4. For problems with database initialization run "docker exec -it sh" in the user and/or notifications container. Then run "php artisan migrate"
to migrate the database. 

5.To check the functionality of the system. Use Postman or any other software to send a post request to "localhost/api/user" with json object body similar to "{firstName:"John",lastName:"Doe",email:"jdoe@mail.com"}".
A json object is sent in response to the request and a message is sent to the RabbitMQ cluster which is picked up by the notification service which saves the data in thee database and log file.
