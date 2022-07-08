**How to install**

**MacOS**
====================
1. Make sure that you have git installed locally on your machine.
2. Open Terminal
3. git clone https://github.com/PGGrigorov/Exchange.git
4. cd into the project
5. Install composer: composer install
6. Install Node.js: npm install
7. Copy the .env file: cp .env.example .env
8. Generate encryption key: php artisan key:generate
9. Create an empty data base for the project. I used MySQLWorkbench
10. In the .env file fill in the DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD
11. Migrate the database: php artisan migrate
12. Start the php server: php artisan serve
13. Go to localhost:8000


**Windows**
====================
1. Clone the project
2. Go to the folder application using cd command on your cmd or terminal
3. Run composer install on your cmd or terminal
4. Copy .env.example file to .env on the root folder:
5. In the .env file fill in the DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD
By default, the username is root and you can leave the password field empty. (This is for Xampp)
By default, the username is root and password is also root. (This is for Lamp)
6. Run php artisan key:generate
7. Run php artisan migrate
8. Run php artisan serve
9. Go to localhost:8000



**Changes**
<p>Добавени са ajax, създаване на потребител от админския панел, блокиране на потребител от админския панел</p> 

**Welcome page**
<img width="1440" alt="welcome page" src="https://user-images.githubusercontent.com/104323896/164997282-9f68d86a-0aaf-4680-8f1f-53e2508ab55b.png">
**Login page**
<img width="1440" alt="login page" src="https://user-images.githubusercontent.com/104323896/164997287-e482626d-0211-44a2-9de7-aa32d6c6ddd9.png">
**Register page**
<img width="1440" alt="register page" src="https://user-images.githubusercontent.com/104323896/164997288-c2422b29-b271-4aed-9630-10788bba0214.png">
**Home page**
<img width="1440" alt="home page" src="https://user-images.githubusercontent.com/104323896/164997297-c0b4d506-8d57-4ce0-b2a0-d7d4948a13f7.png">
**Home page with filter ON**
<img width="1440" alt="home page with filter on" src="https://user-images.githubusercontent.com/104323896/164997320-cabb05c5-338b-4345-a65b-a13713e3d3e5.png">
**Home page with sort ON**
<img width="1440" alt="home page with sort on" src="https://user-images.githubusercontent.com/104323896/164997325-c7694888-8536-4313-9c0c-4306284eefa4.png">
**User page if NOT an admin**
<img width="1440" alt="user page if not admin" src="https://user-images.githubusercontent.com/104323896/164997330-76fbf100-f561-468a-adfb-bd0598a23e1d.png">
**User page if user IS an admin**
<img width="1440" alt="user page if admin" src="https://user-images.githubusercontent.com/104323896/164997331-7f765461-617e-4df8-a3e1-ff7df07824c7.png">
**Admin panel page**
<img width="1440" alt="admin panel page" src="https://user-images.githubusercontent.com/104323896/164997334-bce1867a-d273-4da0-a687-27264c194dbf.png">







