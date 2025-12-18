-- your code goes here

CREATE TABLE students (student_id INT PRIMARY KEY,name VARCHAR(20),grade INT);
-- -----------
INSERT INTO students(student_id,name,grade) VALUES
(1, 'Alice', 89),
(3, 'Bob', 100),
(5, 'Charlie', 92),
(4, 'Luice', 50);

-- -----------
SELECT * FROM students WHERE grade >= 90 AND grade <= 100;