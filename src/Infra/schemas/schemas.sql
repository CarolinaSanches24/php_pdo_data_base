CREATE TABLE IF NOT EXISTS students (
    id INTEGER PRIMARY KEY AUTOINCREMENT, 
    name TEXT NOT NULL, 
    birth_date TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS telefones (
    id INTEGER PRIMARY KEY AUTOINCREMENT, 
    area_code TEXT NOT NULL, 
    number_phone TEXT NOT NULL, 
    student_id INTEGER NOT NULL, 
    FOREIGN KEY(student_id) REFERENCES students(id)
);