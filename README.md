# Laravel-microservices-demo

This repository contains the code for a simple microservice system. It comprises of two services built with Laravel and RabbitMQ as the message bus. The services are containerized with their files in the user and notification folders respectively.  
RabbitMQ cluster from [CloudAMQP] (https://customer.cloudamqp.com/) is used for the message queuing system with the necessary configuration for the cluster included in the users and notifications services .env files.

# How to install  
1 a. Clone the repository  
The database data size may  cause some issues cloning the project so run:  
```
git config --global http.version HTTP/1.1
git config --global http.postBuffer 157286400
git clone https://github.com/Hallykola/laravel-microservices-demo.git
```
b. Create a new file with name .env in users  folder and copy the contents of the .env.example file in the same folder to it.  
 Create a new file with name .env in notifications  folder and copy the contents of the .env.example file in the same folder to it.

2. Ensure you have docker running on your device. Then,  
cd into the folder and  
 run
``` docker-compose up```

3. You should have 6 containers running  
 a. The user service container  
 b. The user service queue container  
 c. The notifications service container  
 d. The notifications service queue container   
 e. The mysql service container for database  
 f. The php-myAdmin service container for managing the database

4. For problems with database initialization run   
``` docker exec -it <container-id> sh ```  
in the user and/or notifications container. Then run  
``` php artisan migrate```  
to migrate the database. 

5.  To check the functionality of the system. Use Postman or any other software to send a post request to "localhost/api/user" with json object body similar to   
```{firstName:"John",lastName:"Doe",email:"jdoe@mail.com"}```.  
A json object is sent in response to the request and a message is sent to the RabbitMQ cluster which is picked up by the notification service which saves the data in the database and log file.
# Testing
Test files can be found in the test foldrs of the users and notification folders respectively. 
To run the tests,run   
```
docker exec -it <container-id> sh 
php artisan test
```
