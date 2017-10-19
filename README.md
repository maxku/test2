https://maxku-test2.000webhostapp.com

Part 1 (required)
Create a web page that displays employee hierarchy in a tree form.

● Employee data should be stored in a database, following information about each
employee is required:

○ Full name;

○ Position;

○ Employment start date;

○ Salary;

● Every employee has exactly 1 boss;

● Database should be filled in with data of at least 50,000 employees and there should
be at least 5 levels of hierarchy;

● Don’t forget to display employee position.

Part 2 (optional)

1. Create database using Laravel / Symfony migrations.
2. Use Laravel / Symfony seeder to fill database with data.
3. Use Twitter Bootstrap to apply basic styles to your page.
4. Create another web page with a list of all employees with all employee record fields
from the database and implement possibility to order by any field.
5. Add possibility to search by any field to the page you created in task 4.
6. Add possibility to order (and search if task 5 is implemented) by any field without
reloading the whole page (i.e. using ajax).
7. Using standard Laravel / Symfony functionality implement login/password restricted
area of the website.
8. Move functionality implemented in tasks 4, 5 and 6 (including ajax endpoints) to
login/password restricted area.
9. In the login/password restricted area implement the rest of CRUD functionality for
employee record. Please note that all employee fields should be editable including
possibility to change employee’s boss.
10. Implement possibility to upload employee photo and display it on the employee edit
page and add additional column with small resized employee photo to the
employee list page.
11. Implement logic to re-assign employee’s subordinates to employee’s boss in case if
employee is being deleted (additional bonus points if you implement it using Laravel
/ Symfony ORM features).
12. Implement lazy loading for employee tree, i.e. by default show first 2 levels of
hierarchy and load tree branch (full or 2 more levels of hierarchy) by clicking on the
employee from the 2nd level.
13. Implement possibility to change employee’s boss using drag-n-drop directly in the
employee tree.
14. Create database structure first using MySQL Workbench (do not forget to commit
MySQL Workbench project file to git) and generate migration files for Laravel /
Symfony from existing MySQL database or directly from MySQL Workbench project
file.



Использовано: Composer, PHP, MySQL, Laravel.
