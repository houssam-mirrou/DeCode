CREATE TABLE class (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    school_year VARCHAR(50) NOT NULL
);

CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    role VARCHAR(20) DEFAULT 'student' NOT NULL CHECK (role IN ('student','teacher','admin')),
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    class_id INT, 
    CONSTRAINT fk_user_class FOREIGN KEY (class_id) REFERENCES class(id) ON DELETE SET NULL
);

CREATE TABLE teachers_in_class (
    id SERIAL PRIMARY KEY,
    class_id INT NOT NULL,
    teacher_id INT NOT NULL,
    CONSTRAINT fk_teachers_in_class_class_id FOREIGN KEY (class_id) REFERENCES class(id) ON DELETE CASCADE,
    CONSTRAINT fk_teachers_in_class_teacher_id FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE sprint (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    class_id INT NOT NULL,
    CONSTRAINT fk_sprint_class FOREIGN KEY (class_id) REFERENCES class(id) ON DELETE CASCADE
);

CREATE TABLE brief_teacher(
    id SERIAL PRIMARY KEY,
    teacher_id int,
    brief_id int,
    CONSTRAINT fk_brief_teacher_teacher_id FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE CASCADE
    CONSTRAINT fk_brief_teacher_brief_id FOREIGN KEY (brief_id) REFERENCES brief(id) ON DELETE CASCADE

);

CREATE TABLE brief (
    id SERIAL PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    date_remise TIMESTAMP, 
    type VARCHAR(20) DEFAULT 'individuel' NOT NULL CHECK (type IN ('individuel','collectif')),
    sprint_id INT NOT NULL,
    CONSTRAINT fk_brief_sprint FOREIGN KEY (sprint_id) REFERENCES sprint(id) ON DELETE CASCADE
);

CREATE TABLE competence (
    id SERIAL PRIMARY KEY,
    code VARCHAR(10) NOT NULL,
    libelle VARCHAR(100) NOT NULL, 
    description TEXT
);

CREATE TABLE brief_competence (
    id SERIAL PRIMARY KEY,
    brief_id INT NOT NULL,
    competence_id INT NOT NULL,
    level VARCHAR(20) NOT NULL CHECK (level IN ('IMITER', 'S_ADAPTER', 'TRANSPOSER')),
    CONSTRAINT fk_brief_competence_brief_id FOREIGN KEY (brief_id) REFERENCES brief(id) ON DELETE CASCADE,
    CONSTRAINT fk_brief_competence_competence_id FOREIGN KEY (competence_id) REFERENCES competence(id) ON DELETE CASCADE
);

CREATE TABLE evaluation (
    id SERIAL PRIMARY KEY,
    student_id INT NOT NULL,
    brief_id INT NOT NULL,
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    level VARCHAR(20) NOT NULL CHECK (level IN ('IMITER', 'S_ADAPTER', 'TRANSPOSER')),
    review VARCHAR(20) NOT NULL CHECK (review IN ('bad', 'good', 'excellent')), -- Fixed logic here
    
    CONSTRAINT fk_eval_student FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_eval_brief FOREIGN KEY (brief_id) REFERENCES brief(id) ON DELETE CASCADE
);

CREATE TABLE evaluation_competences (
    id SERIAL PRIMARY KEY,
    evaluation_id INT NOT NULL,
    competence_id INT NOT NULL,
    level VARCHAR(20) NOT NULL CHECK (level IN ('IMITER', 'S_ADAPTER', 'TRANSPOSER')),
    
    CONSTRAINT fk_eval_comp_eval FOREIGN KEY (evaluation_id) REFERENCES evaluation(id) ON DELETE CASCADE,
    CONSTRAINT fk_eval_competence FOREIGN KEY (competence_id) REFERENCES competence(id) ON DELETE CASCADE
);

CREATE TABLE livrable (
    id SERIAL PRIMARY KEY,
    url VARCHAR(255) NOT NULL, 
    comment VARCHAR(255),
    date_submitted TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    student_id INT NOT NULL,
    brief_id INT NOT NULL,
    
    CONSTRAINT fk_livrable_student FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_livrable_brief FOREIGN KEY (brief_id) REFERENCES brief(id) ON DELETE CASCADE
);