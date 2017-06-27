CREATE TABLE Users (
   userID INT NOT NULL AUTO_INCREMENT,
   name VARCHAR(50) NOT NULL,
   email VARCHAR(50) NOT NULL,
   passwrd VARCHAR(50) NOT NULL,
   PRIMARY KEY (userID)
);

CREATE TABLE Obligations (
   obligationID INT NOT NULL AUTO_INCREMENT,
   userID INT NOT NULL,
   name VARCHAR(30) NOT NULL,
   notes VARCHAR(255),
   currentInterval INT NOT NULL,
   dueDate VARCHAR(50) NOT NULL,
   isComplete BOOL NOT NULL,
   PRIMARY KEY (obligationID),
   FOREIGN KEY (userID) REFERENCES Users(userID)
);


CREATE TABLE Productive (
   productiveID INT NOT NULL AUTO_INCREMENT,
   userID INT NOT NULL,
   name VARCHAR(30) NOT NULL,
   notes VARCHAR(255),
   currentInterval INT NOT NULL,
   totalIntervals INT NOT NULL,
   PRIMARY KEY (productiveID),
   FOREIGN KEY (userID) REFERENCES Users(userID)
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


CREATE TABLE ProjectTasks (
   pTaskID INT NOT NULL AUTO_INCREMENT,
   projectID INT NOT NULL,
   name VARCHAR(30) NOT NULL,
   notes VARCHAR(255),
   isComplete BOOL NOT NULL,
   dueDate VARCHAR(50),
   PRIMARY KEY (pTaskID),
   FOREIGN KEY (projectID) REFERENCES Projects(projectID)
);

INSERT INTO Users(username, name, email, passwrd) VALUES('root','root','root','root');