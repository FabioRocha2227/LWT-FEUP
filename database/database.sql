DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Department;
DROP TABLE IF EXISTS Ticket;
DROP TABLE IF EXISTS Agent;
DROP TABLE IF EXISTS Client;
DROP TABLE IF EXISTS Admin;
DROP TABLE IF EXISTS Comments;
DROP TABLE IF EXISTS DepAgent;
DROP TABLE IF EXISTS FAQ;


.headers on
.mode columns

CREATE TABLE User (
    userID INTEGER PRIMARY KEY,
    username TEXT NOT NULL UNIQUE,
    email TEXT CHECK (email LIKE '%_@_%._%') NOT NULL UNIQUE,
    password TEXT NOT NULL,
    name TEXT,
    surname TEXT,
    age INTEGER,
    isAgent INTEGER,
    isAdmin INTEGER,
    gender TEXT CHECK (gender IN ('Not Specified', 'Male', 'Female', 'Other'))
);

INSERT INTO User VALUES(1,'user1','user1@boas.com', '$2y$10$r5t.plmdGrU/088kTR5r6.3FQU5x4HXDAjklRBMC7FpfKlgrQ52TO', 'boas', 'boas', 20, 0, 0,'Male');
--pass:user1
INSERT INTO User VALUES(2,'admin','admin@admin.com', '$2y$10$BqBF/WRXbIPFIiy7ZJnQru55wq0ZrV.s5McC7h8ONTeOwV3lgRSFu', 'Mr.', 'Admin', 20, 1, 1,'Male');
--pass:123
INSERT INTO User VALUES(3,'agent1','agent1@admin.com', '$2y$10$F.dAaVMTIiY0BOBtDl6PS.RKcN/6GxySFZg993kQu7u0SjNG3Fx06', 'Mr.', 'Agent', 20, 1, 0,'Male');
--pass:123
INSERT INTO User VALUES(4,'agent2','agent2@admin.com', '$2y$10$OX4yDZ69T7ZJck9UcOf4z.qEpkQtfD/V5UoG72WEZkF2p5s9r3ZM.', 'Mr.', 'Agent2', 20, 1, 0,'Male');
--pass:123
INSERT INTO User VALUES(5,'user2','user2@boas.com', '$2y$10$kXZJ.LUeE.ZwQZmNGQuRW.GLgQRv0Jzi2p1r/v1jnmDbiaB1Kp4p2', 'boas', 'boas', 20, 0, 0,'Male');
--pass:user2

CREATE TABLE Agent (
    agentID INTEGER PRIMARY KEY,
    FOREIGN KEY (agentID) REFERENCES User(userID) 
);

INSERT INTO Agent VALUES (2);
INSERT INTO Agent VALUES (3);

CREATE TABLE Client (
    clientID INTEGER PRIMARY KEY,
    FOREIGN KEY (clientID) REFERENCES User(userID) 
);

INSERT INTO Client VALUES (1);

CREATE TABLE Admin (
    adminID INTEGER PRIMARY KEY,
    FOREIGN KEY (adminID) REFERENCES User(userID)
);

INSERT INTO Admin VALUES (2);

CREATE TABLE Ticket (
    ticket_id INTEGER PRIMARY KEY,
    title TEXT,
    userID INTEGER,
    agentID INTEGER,
    date TEXT,
    status TEXT CHECK (status IN ('NEW', 'ANSWERED', 'OPEN', 'POSTPONED', 'RESOLVED')) NOT NULL,
    description TEXT,
    department TEXT,
    FOREIGN KEY (userID) REFERENCES User(userID),
    FOREIGN KEY (agentID) REFERENCES User(userID),
    FOREIGN KEY (department) REFERENCES Department(department)
);
INSERT INTO Ticket VALUES(1,'Ticket1',1, 3, '2023-05-20 17:14:30', 'NEW', 'Ticket Description 1', 'Desenho de Algoritmos');
INSERT INTO Ticket VALUES(2,'Ticket2',1, 4, '2023-05-20 17:14:29', 'NEW', 'Ticket Description 2', 'Linguagens e Tecnologias Web' );
INSERT INTO Ticket VALUES(3,'Ticket3',5, 4, '2023-05-20 17:14:31', 'NEW', 'Ticket Description 3', 'Métodos Estatísticos');
INSERT INTO Ticket VALUES(4,'Ticket4',5, 3, '2023-05-20 17:14:25', 'NEW', 'Ticket Description 4', 'Engenharia de Software');

CREATE TABLE Comments (
    comment_id INTEGER PRIMARY KEY,
    comment_date TEXT,
    content TEXT,
    ticket_id INTEGER,
    user_id INTEGER,
    FOREIGN KEY (ticket_id) REFERENCES Ticket(ticket_id),
    FOREIGN KEY (user_id) REFERENCES Ticket(user_id)
);

CREATE TABLE Department (
    department TEXT PRIMARY KEY
);

INSERT INTO Department VALUES('Desenho de Algoritmos');
INSERT INTO Department VALUES('Laboratório de Computadores');
INSERT INTO Department VALUES('Linguagens e Tecnologias Web');
INSERT INTO Department VALUES('Engenharia de Software');
INSERT INTO Department VALUES('Métodos Estatísticos');

CREATE TABLE DepAgent (
    depAgent_id INTEGER PRIMARY KEY,
    department TEXT,
    userID INTEGER,
    FOREIGN KEY (department) REFERENCES Department(department),
    FOREIGN KEY (userID) REFERENCES User(userID)
);

INSERT INTO DepAgent VALUES(1, 'Desenho de Algoritmos', 3);
INSERT INTO DepAgent VALUES(2, 'Métodos Estatísticos', 4);
INSERT INTO DepAgent VALUES(3, 'Métodos Estatísticos', 2);

CREATE TABLE FAQ (
    faq_id INTEGER PRIMARY KEY,
    question TEXT,
    answer TEXT
);

INSERT INTO FAQ VALUES(1,"How long does it take to receive a response to my ticket?","Our team typically responds within 24 to 48 hours, excluding weekends and holidays. However, during busy periods or high-volume ticket submissions, it may take slightly longer. Rest assured that we prioritize each ticket and will get back to you as soon as possible.");
INSERT INTO FAQ VALUES(2,"Can I check the status of my ticket?","Absolutely! You can check the status of your ticket by logging into your account and navigating to the My Tickets section. Here, you will find a list of all the tickets you have submitted, along with their current status");
INSERT INTO FAQ VALUES(3,"Is there a limit to the number of tickets I can submit?","There is no strict limit on the number of tickets you can submit. However, we encourage you to consolidate related questions or concerns into a single ticket whenever possible. This helps streamline the support process and allows our experts to provide comprehensive assistance efficiently.");
