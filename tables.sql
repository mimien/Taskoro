--MYSQL TABLES

CREATE TABLE Users (
   userID INT NOT NULL AUTO_INCREMENT,
   name VARCHAR(50) NOT NULL,
   email VARCHAR(50) NOT NULL,
   passwrd VARCHAR(50) NOT NULL,
   PRIMARY KEY (userID)
);

CREATE TABLE Tasks (
   taskID INT NOT NULL AUTO_INCREMENT,
   userID INT,
   projectID INT,
   name VARCHAR(30) NOT NULL,
   notes VARCHAR(255),
   currentInterval INT NOT NULL,
   dueDate VARCHAR(50) NOT NULL,
   isComplete BOOL NOT NULL,
   PRIMARY KEY (taskID),
   FOREIGN KEY (userID) REFERENCES Users(userID),
   FOREIGN KEY (projectID) REFERENCES Projects(projectID)
);

CREATE TABLE Projects (
   projectID INT NOT NULL AUTO_INCREMENT,
   userID INT NOT NULL,
   name VARCHAR(30) NOT NULL,
   notes VARCHAR(255) NOT NULL,
   dueDate VARCHAR(50) NOT NULL,
   PRIMARY KEY (projectID),
   FOREIGN KEY (userID) REFERENCES Users(userID)
);
